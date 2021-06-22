<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use Illuminate\Http\Request;

class LawyerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Lawyer::all();
		return view('lawyer.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('lawyer.create');
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
            'mobile_no' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Lawyer();
		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->description = $request->description;
		$model->save();
		$response = [
			'model' => $model,
			'goto' => route('lawyer.index'),
			'message' => __('lawyer.Lawyer Added Successfully'),
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
		$model = Lawyer::findOrFail($id);
		return view('lawyer.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Lawyer::findOrFail($id);

		return view('lawyer.edit', compact('model'));
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
            'mobile_no' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Lawyer::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('lawyer.Lawyer Not Found')]);
		}

		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('lawyer.Lawyer Updated Successfully'),
			'goto' => route('lawyer.index'),
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

		$model = Lawyer::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('lawyer.Lawyer Not Found')]);
		}


		$model->delete();

		return response()->json(['message' => __('lawyer.Lawyer Deleted Successfully'), 'goto' => route('lawyer.index')]);
	}
}
