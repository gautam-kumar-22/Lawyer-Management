<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\ContactCategory;
use Illuminate\Http\Request;

class ContactController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = ContactCategory::all();
		return view('category.contact.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('category.contact.create');
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

		$model = new ContactCategory();
		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'model' => $model,

			'message' => __('Contact Category Added Successfully <br> <a href="' . route('category.contact.index') . '" class="btn btn-link btn-sm">Click here to Contact Category list</a>'),
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
		$model = ContactCategory::findOrFail($id);
		return view('category.contact.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = ContactCategory::findOrFail($id);
		return view('category.contact.edit', compact('model'));
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

		$model = ContactCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Contact Category Not Found')]);
		}

		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('Contact Category Updated Successfully'),
			'goto' => route('category.contact.index'),
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

		$model = ContactCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Contact Category Not Found')]);
		}

		//Check Contact

		$model->delete();

		return response()->json(['message' => __('Contact Category Deleted Successfully'), 'goto' => route('category.contact.index')]);
	}
}
