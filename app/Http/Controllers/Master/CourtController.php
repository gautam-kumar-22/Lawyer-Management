<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\CourtCategory;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourtController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Court::all();
		return view('master.court.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$countries = Country::all()->pluck('name', 'id')->prepend(__('Select country'), '');
		$states = State::where('country_id', config('configs')->where('key','country_id')->first()->value)->pluck('name', 'id')->prepend(__('Select state'), '');
		$court_categories = CourtCategory::all()->pluck('name', 'id')->prepend(__('Select Court Category'), '');
		return view('master.court.create', compact('countries', 'court_categories','states'));
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
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'court_category_id' => 'sometimes|nullable|integer',
            'location' => 'sometimes|nullable|max:191|string',
            'name' => 'required|max:191|string',
            'room_number' => 'sometimes|nullable|max:15|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        $request->validate($validate_rules, validationMessage($validate_rules));

		if ($request->court_category_id) {
			$court_category = CourtCategory::where('id', $request->court_category_id)->first();
			if (!$court_category) {
				throw ValidationException::withMessages(['court_category_id' => __('Court Category Not Found')]);
			}
		}

		$model = new Court();
		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->court_category_id = $request->court_category_id;
		$model->location = $request->location;
		$model->name = $request->name;
		$model->room_number = $request->room_number;
		$model->description = $request->description;
		$model->save();

		$response = [
			'model' => $model,
			'goto' => route('master.court.index'),
			'message' => __('Court Added Successfully <br> <a href="' . route('master.court.index') . '" class="btn btn-link btn-sm">Click here to Court list</a>'),
		];

		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		$model = Court::findOrFail($id);
		return view('master.court.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Court::findOrFail($id);
		$countries = Country::all()->pluck('name', 'id')->prepend(__('Select country'), '');
		$states = State::where('country_id', $model->country_id)->pluck('name', 'id')->prepend(__('Select state'), '');
		$cities =  City::where('state_id', $model->state_id)->pluck('name', 'id')->prepend(__('Select city'), '');
		$court_categories = CourtCategory::all()->pluck('name', 'id')->prepend(__('Select Court Category'), '');

		return view('master.court.edit', compact('model', 'countries', 'states', 'cities','court_categories'));
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

		if (!$request->json()) {
			abort(404);
		}
        $validate_rules = [
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'court_category_id' => 'sometimes|nullable|integer',
            'location' => 'sometimes|nullable|max:191|string',
            'name' => 'required|max:191|string',
            'room_number' => 'sometimes|nullable|max:15|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        $request->validate($validate_rules, validationMessage($validate_rules));


		$court_category = CourtCategory::where('id', $request->court_category_id)->first();
		if (!$court_category) {
			throw ValidationException::withMessages(['court_category_id' => __('Court Category Not Found')]);
		}

		$model = Court::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Court Not Found')]);
		}

		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->court_category_id = $request->court_category_id;
		$model->location = $request->location;
		$model->name = $request->name;
		$model->room_number = $request->room_number;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('Court Updated Successfully'),
			'goto' => route('master.court.index'),
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

		$model = Court::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Court Not Found')]);
		}

		//Check Court

		$model->delete();

		return response()->json(['message' => __('Court Deleted Successfully'), 'goto' => route('master.court.index')]);
	}
}
