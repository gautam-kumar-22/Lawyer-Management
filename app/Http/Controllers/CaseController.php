<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\CaseAct;
use App\Models\CaseCategory;
use App\Models\CaseCategoryLog;
use App\Models\CaseCourt;
use App\Models\Cases;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Court;
use App\Models\CourtCategory;
use App\Models\HearingDate;
use App\Models\Lawyer;
use App\Models\Stage;
use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Brian2694\Toastr\Facades\Toastr;

class CaseController extends Controller {
    use ImageStore;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$models = Cases::where('status', 'Open')->whereIn('judgement_status',['Open','Reopen'])->get();
		if ($request->status And $request->status == 'Archieved') {
			$models = Cases::where('judgement_status', 'Judgement')->get();
			return view('case.archieved', compact('models'));
		}else if ($request->status And $request->status == 'Waiting') {
			$models = Cases::where('status', 'Open')->where('hearing_date', '<', date('Y-m-d'))->get();
		}



		return view('case.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$data['clients'] = Client::all()->pluck('name', 'id');
		$data['client_categories'] = ClientCategory::all()->pluck('name', 'id')->prepend(__('case.Select Client Category'), '');
		$data['stages'] = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');
		$data['case_categories'] = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Categories'), '');
		$data['court_categories'] = CourtCategory::all()->pluck('name', 'id')->prepend(__('case.Select Court Categories'), '');
		$data['lawyers'] = Lawyer::all()->pluck('name', 'id')->prepend(__('case.Select Opposit Lawyer'), '');
		$data['acts'] = Act::all()->pluck('name', 'id');
		$data['courts'] = [ '' => __('case.Select Court')];

		return view('case.create', compact('data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return void
	 * @throws ValidationException
	 */
	public function store(Request $request) {
		if (!$request->json()) {
			abort(404);
		}
		$validate_rules = [
			'case_category_id' => 'required|integer',
			'case_no' => 'sometimes|nullable|string',
			'file_no' => 'sometimes|nullable|string|max:20',
			'acts*' => 'required|integer',
			'plaintiff' => 'required|integer',
			'opposite' => 'required|integer',
			'client_category_id' => 'required|integer',
			'court_category_id' => 'required|integer',
			'court_id' => 'required|integer',
			'lawyer_id' => 'sometimes|nullable|integer',
			'stage_id' => 'sometimes|nullable|integer',
			'receiving_date' => 'sometimes|nullable|date',
			'filling_date' => 'sometimes|nullable|date',
			'hearing_date' => 'sometimes|nullable|date',
			'judgement_date' => 'sometimes|nullable|date',
			'description' => 'sometimes|nullable|string',
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
		];
		$request->validate($validate_rules, validationMessage($validate_rules));

		try {

		$hearing_date = Null;
		$filling_date = Null;
		$judgement_date = Null;
		$receiving_date = Null;
		$judgement = Null;

		if ($request->hearing_date_yes) {
			$hearing_date = date_format(date_create($request->hearing_date), 'Y-m-d H:i:s');
		}
		if ($request->filling_date_yes) {
			$filling_date = date_format(date_create($request->filling_date), 'Y-m-d H:i:s');
		}
		if ($request->judgement_date_yes) {
			$judgement_date = date_format(date_create($request->judgement_date), 'Y-m-d H:i:s');
			$judgement = $request->judgement;

			if (!$judgement) {
				Toastr::error(__('case.Judgment field is required '));
				throw ValidationException::withMessages(['judgement' => __('case.Judgment field is required ')]);
			}
		}
		if ($request->plaintiff == $request->opposite) {
			Toastr::error(__('case.Plaintiff can not be opposite'));
			throw ValidationException::withMessages(['plaintiff' => __('case.Plaintiff can not be opposite')]);
		}
		if ($request->receiving_date_yes) {
			$receiving_date = date_format(date_create($request->receiving_date), 'Y-m-d H:i:s');
		}



		$plaintiff = Client::find($request->plaintiff);
		$opposite = Client::find($request->opposite);
		$file_no = $request->file_no;
		$title = $plaintiff->name . ' v/s ' . $opposite->name;
		$client_category = ClientCategory::find($request->client_category_id);
		$client = $client_category->plaintiff ? 'Plaintiff' : 'Opposite';
		$model = new Cases();
		$model->title = $title;
		$model->client = $client;
		$model->status = 'Open';
		$model->case_category_id = $request->case_category_id;
		$model->case_no = $request->case_no;
		$model->file_no = $request->file_no;
		$model->plaintiff = $request->plaintiff;
		$model->opposite = $request->opposite;
		$model->client_category_id = $request->client_category_id;
		$model->court_category_id = $request->court_category_id;
		$model->court_id = $request->court_id;
		$model->lawyer_id = $request->lawyer_id;
		$model->ref_name = $request->ref_name;
		$model->ref_mobile = $request->ref_mobile;
		$model->stage_id = $request->stage_id;
		$model->receiving_date = $receiving_date;
		$model->filling_date = $filling_date;
		$model->hearing_date = $hearing_date;
		$model->judgement_date = $judgement_date;
		$model->judgement = $judgement;
		$model->description = $request->description;
		$model->save();


		if (!$request->file_no) {
			$file_no = str_pad($model->id, 4, '0', STR_PAD_LEFT);
			$model->file_no = $file_no;
			$model->save();
		}

		if ($request->acts AND count($request->acts) > 0) {
			foreach ($request->acts as $value) {
				$act = new CaseAct();
				$act->acts_id = $value;
				$act->cases_id = $model->id;
				$act->save();
			}
		}

		if ($request->hearing_date_yes) {
            $date = new HearingDate();
            $date->cases_id = $model->id;
            $date->stage_id = $request->stage_id;
            $date->date = $hearing_date;
            $date->description = $request->description;
            $date->save();
		}

            if ($request->file){
                foreach($request->file as $file){
                    $this->storeFile($file, $model->id);
                }
            }

		$response = [
			'goto' => route('case.show', $model->id),
			'model' => $model,
			'message' => __('case.Case Added Successfully'),
		];

		return response()->json($response);

		} catch (\Exception $e) {
			throw ValidationException::withMessages(['message' => $e->getMessage()]);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		$model = Cases::with('acts', 'hearing_dates')->findOrFail($id);
		return view('case.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Cases::with('acts')->findOrFail($id);
		$data['clients'] = Client::all()->pluck('name', 'id');
		$data['client_categories'] = ClientCategory::all()->pluck('name', 'id')->prepend(__('case.Select Client Category'), '');
		$data['stages'] = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');
		$data['case_categories'] = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Categories'), '');
		$data['court_categories'] = CourtCategory::all()->pluck('name', 'id')->prepend(__('case.Select Court Categories'), '');
		$data['lawyers'] = Lawyer::all()->pluck('name', 'id')->prepend(__('case.Select Lawyer'), '');
		$data['courts'] = Court::where('court_category_id', $model->court_category_id)->pluck('name', 'id')->prepend(__('case.Select Court'), '');
		$data['acts'] = Act::all()->pluck('name', 'id');
		$data['selected_acts'] = $model->acts()->pluck('acts_id');

		return view('case.edit', compact('model', 'data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 * @throws ValidationException
	 */
	public function update(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}
        $validate_rules = [
            'case_category_id' => 'required|integer',
            'case_no' => 'sometimes|nullable|string',
            'file_no' => 'sometimes|nullable|string|max:20',
            'acts*' => 'required|integer',
            'plaintiff' => 'required|integer',
            'opposite' => 'required|integer',
            'client_category_id' => 'required|integer',
            'court_category_id' => 'required|integer',
            'court_id' => 'required|integer',
            'lawyer_id' => 'sometimes|nullable|integer',
            'stage_id' => 'sometimes|nullable|integer',
            'receiving_date' => 'sometimes|nullable|date',
            'filling_date' => 'sometimes|nullable|date',
            'hearing_date' => 'sometimes|nullable|date',
            'judgement_date' => 'sometimes|nullable|date',
            'description' => 'sometimes|nullable|string',
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$filling_date = Null;
		$receiving_date = Null;


		if ($request->filling_date_yes) {
			$filling_date = date_format(date_create($request->filling_date), 'Y-m-d H:i:s');
		}

		if ($request->plaintiff == $request->opposite) {
			Toastr::error(__('case.Plaintiff can not be opposite'));
			throw ValidationException::withMessages(['plaintiff' => __('case.Plaintiff can not be opposite')]);
		}
		if ($request->receiving_date_yes) {
			$receiving_date = date_format(date_create($request->receiving_date), 'Y-m-d H:i:s');
		}


		$model = Cases::findOrFail($id);
		$plaintiff = Client::find($request->plaintiff);
		$opposite = Client::find($request->opposite);
		$title = $plaintiff->name . ' v/s ' . $opposite->name;
		$client_category = ClientCategory::find($request->client_category_id);
		$client = $client_category->plaintiff ? 'Plaintiff' : 'Opposite';

		$model->title = $title;
		$model->client = $client;
		$model->case_category_id = $request->case_category_id;
		$model->case_no = $request->case_no;
		$model->file_no = $request->file_no;
		$model->plaintiff = $request->plaintiff;
		$model->opposite = $request->opposite;
		$model->client_category_id = $request->client_category_id;
		$model->court_category_id = $request->court_category_id;
		$model->court_id = $request->court_id;
		$model->lawyer_id = $request->lawyer_id;
		$model->ref_name = $request->ref_name;
		$model->ref_mobile = $request->ref_mobile;
		$model->stage_id = $request->stage_id;
		$model->receiving_date = $receiving_date;
		$model->filling_date = $filling_date;
		$model->description = $request->description;
		$model->save();

		if ($request->acts AND count($request->acts) > 0) {
			CaseAct::where('cases_id', $model->id)->delete();
			foreach ($request->acts as $value) {
				$act = new CaseAct();
				$act->acts_id = $value;
				$act->cases_id = $model->id;
				$act->save();
			}
		}

		$response = [
			'message' => __('case.Case Updated Successfully'),
			'goto' => route('case.show', $model->id),
		];

		return response()->json($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return void
	 * @throws ValidationException
	 */
	public function destroy(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}

		$model = Cases::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('case.Case Not Found')]);
		}

		//Check Case

		$model->delete();

		return response()->json(['message' => __('case.Case Deleted Successfully'), 'goto' => route('case.index')]);
	}

	public function causelist(Request $request) {
		$date = Date('Y-m-d');
		if ($request->date) {
			$date = $request->date;
		}

		$models = Cases::where(['status' => 'Open', 'hearing_date' => $date])->get();

		return view('case.causelist', compact('models', 'date'));
	}


	public function category_change($id) {
		$model = Cases::FindOrFail($id);
		$category = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Category'), '');
		return view('case.category-change', compact('model', 'category'));
	}

	public function category_store(Request $request)
	{
		$model = Cases::FindOrFail($request->id);
		$category = CaseCategory::FindOrFail($model->case_category_id);
		$old_category = $category->name;
		$n_category = CaseCategory::FindOrFail($request->category);
		$new_category = $n_category->name;
		$model->case_category_id = $request->category;
		$model->save();

		$user = new CaseCategoryLog();
		$user->date = $request->date;
		$user->case_id = $request->id;
		$user->category_id = $request->category;
		$user->save();

		$description = 'Court Category Change: Form (' . $old_category . ") To (" . $new_category . ")";
		$date = new HearingDate();
		$date->cases_id = $model->id;
		$date->date = $request->date;
		$date->description = $description;
		$date->type = 'court_category_change';
		$date->save();

		$response = [
			'goto' => route('case.show', $model->id),
			'message' => __('case.Case Category Updated'),
		];

		return response()->json($response);
	}


	public function court_change($id) {
		$model = Cases::FindOrFail($id);
		$court = Court::all()->pluck('name', 'id')->prepend(__('case.Select Court'), '');
		return view('case.court-change', compact('model', 'court'));
	}

	public function court_store(Request $request)
	{
        $this->validate($request, [
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ]);

		$model = Cases::FindOrFail($request->id);
		$court = Court::FindOrFail($model->court_id);
		$old_court = $court->name;
		$n_court = Court::FindOrFail($request->court);
		$court_category_id = $n_court->court_category_id;
		$new_court = $n_court->name;
		$model->court_id = $request->court;
		$model->court_category_id = $court_category_id;
		$model->save();

		$user = new CaseCourt();
		$user->date = $request->date;
		$user->case_id = $request->id;
		$user->court_id = $request->court;
		$user->save();

		$description = 'Court Change: Form (' . $old_court.") To (". $new_court.")";
		$date = new HearingDate();
		$date->cases_id = $model->id;
		$date->type = 'court_change';
		$date->date = $request->date;
		$date->description = $description;
		$date->type = 'court_change';
		$date->save();

        if ($request->file){
            foreach($request->file as $file){
                $this->storeFile($file, $model->cases_id, $date->id);
            }
        }

		$response = [
			'goto' => route('case.show', $model->id),
			'message' => __('case.Case Court Updated'),
		];

		return response()->json($response);
	}
}
