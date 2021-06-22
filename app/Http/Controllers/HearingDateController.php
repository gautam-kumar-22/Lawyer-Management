<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Client;
use App\Models\HearingDate;
use App\Models\Stage;
use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Jobs\CaseDateUpdateMailJob;

class HearingDateController extends Controller {
    use ImageStore;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		abort(404);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		if (!$request->case) {
			abort(404);
		}
		$case = $request->case;

		$case_model = Cases::findOrFail($case);
		$stages = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');

		return view('date.create', compact('case', 'case_model', 'stages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (!$request->json()) {
			abort(404);
		}


        $validate_rules =  [
            'hearing_date' => 'required|date',
            'stage_id' => 'required|integer',
            'description' => 'sometimes|nullable|string',
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
		$case = Cases::find($request->case);
		if (!$case) {
			throw ValidationException::withMessages(['hearing_date' => __('case.Case Not Found')]);
		}
		if (strtotime($case->hearing_date) > strtotime($request->hearing_date)) {
			throw ValidationException::withMessages(['hearing_date' => __('case.New Hearing Date Must be after ' . $case->hearing_date)]);
		}

		$case->hearing_date = getFormatedDate($request->hearing_date);
		$case->stage_id = $request->stage_id;
		$case->save();

		$model = new HearingDate();
		$model->cases_id = $request->case;
		$model->stage_id = $request->stage_id;
		$model->date = getFormatedDate($request->hearing_date);
		$model->description = $request->description;
		$model->save();

        if ($request->file){
            foreach($request->file as $file){
                $this->storeFile($file, $model->cases_id, $model->id);
            }
        }

		if($model->client == 'Plaintiff'){
			$client = Client::findOrFail($case->plaintiff);
		}else{
			$client = Client::findOrFail($case->opposite);
		}


		if ($client->email) {
			dispatch(new CaseDateUpdateMailJob($client, $case, $model));
		}

		$response = [
			'goto' => route('case.show', $model->cases_id),
			'model' => $model,
			'message' => __('case.Date Added Successfully'),
		];

		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		if (!$request->case) {
			abort(404);
		}
		$case = $request->case;

		$model = HearingDate::where(['cases_id' => $case, 'id' => $id])->firstOrFail();
		$case_model = Cases::findOrFail($case);
		$stages = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');

		return view('date.edit', compact('case', 'model', 'case_model', 'stages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}
        $validate_rules =  [
            'hearing_date' => 'required|date',
            'stage_id' => 'required|integer',
            'description' => 'sometimes|nullable|string'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$case = Cases::find($request->case);
		$model = HearingDate::find($id);
		if (!$case) {
			throw ValidationException::withMessages(['hearing_date' => __('case.Case Not Found')]);
		}

		if ($case->hearing_date === $model->date) {
			if (strtotime($case->hearing_date) > strtotime($request->hearing_date)) {
				throw ValidationException::withMessages(['hearing_date' => __('case.New Hearing Date Must be after') . $case->hearing_date]);
			}
			$case->hearing_date = getFormatedDate($request->hearing_date);
			$case->stage_id = $request->stage_id;
			$case->save();
		}

		$model->cases_id = $request->case;
		$model->stage_id = $request->stage_id;
		$model->date = getFormatedDate($request->hearing_date);
		$model->description = $request->description;
		$model->save();

		if($model->client == 'Plaintiff'){

			$client = Client::findOrFail($case->plaintiff);
		}else{
			$client = Client::findOrFail($case->opposite);
		}

		if ($client->email) {
			dispatch(new CaseDateUpdateMailJob($client, $case, $model));
		}

		$response = [
			'goto' => route('case.show', $model->cases_id),
			'message' => __('case.Date Updated Successfully'),
		];

		return response()->json($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}
		$hearing_date = HearingDate::latest();
		if ($hearing_date->first()->id == $id) {
			$case = Cases::find($hearing_date->first()->cases_id);
			$case->hearing_date = $hearing_date->skip(1)->first()->date;
			$case->save();
		}

		$model = HearingDate::find($id);

		if (!$model) {
			throw ValidationException::withMessages(['message' => __('case.Case Not Found')]);
		}

		//Check Case

		$model->delete();

		return response()->json(['message' => __('case.Date Deleted Successfully'), 'goto' => route('case.show', $model->cases_id)]);
	}
}
