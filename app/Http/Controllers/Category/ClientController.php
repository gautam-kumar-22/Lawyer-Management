<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\ClientCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = ClientCategory::all();
		return view('category.client.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('category.client.create');
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
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new ClientCategory();
		$model->name = $request->name;
		$model->description = $request->description;
		$model->plaintiff = $request->plaintiff ? 1 : 0;
		$model->save();

		$response = [
			'model' => $model,
			'message' => __('Client Category Added Successfully <br> <a href="' . route('category.client.index') . '" class="btn btn-link btn-sm">Click here to Client Category list</a>'),
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
		$model = ClientCategory::findOrFail($id);
		return view('category.client.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = ClientCategory::findOrFail($id);
		return view('category.client.edit', compact('model'));
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
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = ClientCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Client Category Not Found')]);
		}

		$model->name = $request->name;
		$model->description = $request->description;
		$model->plaintiff = $request->plaintiff ? 1 : 0;
		$model->save();

		$response = [
			'message' => __('Client Category Updated Successfully'),
			'goto' => route('category.client.index'),
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

		$model = ClientCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Client Category Not Found')]);
		}

		//Check Client

		$model->delete();

		return response()->json(['message' => __('Client Category Deleted Successfully'), 'goto' => route('category.client.index')]);
	}
}
