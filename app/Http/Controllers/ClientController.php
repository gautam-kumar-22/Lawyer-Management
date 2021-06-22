<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class ClientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Client::all();
		return view('client.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$countries = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
		$states = State::where('country_id', config('configs')->where('key','country_id')->first()->value)->pluck('name', 'id')->prepend(__('client.Select state'), '');
		$client_categories = ClientCategory::all()->pluck('name', 'id')->prepend(__('client.Select Client Category'), '');

		return view('client.create', compact('countries','client_categories','states'));
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
            'client_category_id' => 'sometimes|nullable|integer',
            'email' => 'sometimes|nullable|email|max:191',
            'mobile' => 'sometimes|nullable|string|max:191',
            'gender' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Client();
		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->client_category_id = $request->client_category_id;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->gender = $request->gender;
		$model->mobile = $request->mobile;
		$model->address = $request->address;
		$model->description = $request->description;
		$model->save();
		$response = [
			'model' => $model,
			'goto' => route('client.index'),
			'message' => __('client.Client Added Successfully'),
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
		$model = Client::findOrFail($id);
		return view('client.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Client::findOrFail($id);
		$countries = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
		$states = State::where('country_id', $model->country_id)->pluck('name', 'id')->prepend(__('client.Select state'), '');
		$cities =  City::where('state_id', $model->state_id)->pluck('name', 'id')->prepend(__('client.Select city'), '');
		$client_categories = ClientCategory::all()->pluck('name', 'id')->prepend(__('client.Select Client Category'), '');
		return view('client.edit', compact('model', 'countries', 'states','cities','client_categories'));
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
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'client_category_id' => 'sometimes|nullable|integer',
            'email' => 'sometimes|nullable|email|max:191',
            'mobile' => 'sometimes|nullable|string|max:191',
            'gender' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));


		$model = Client::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('client.Client Not Found')]);
		}

		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->client_category_id = $request->client_category_id;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->gender = $request->gender;
		$model->mobile = $request->mobile;
		$model->address = $request->address;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('client.Client Updated Successfully'),
			'goto' => route('client.index'),
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

		$model = Client::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('client.Client Not Found')]);
		}

		//Check Case

		$model->delete();

		return response()->json(['message' => __('client.Client Deleted Successfully'), 'goto' => route('client.index')]);
	}
}
