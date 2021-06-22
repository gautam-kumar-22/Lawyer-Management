<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactCategory;
use Illuminate\Http\Request;
use App\Jobs\WelcomeMailJob;

class ContactController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Contact::all();
		return view('contact.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$contact_categories = ContactCategory::all()->pluck('name', 'id')->prepend(__('contact.Select Contact Category'), '');
		return view('contact.create', compact('contact_categories'));
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
            'mobile_no' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email',
            'contact_category_id' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Contact();
		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->email = $request->email;
		$model->contact_category_id = $request->contact_category_id;
		$model->description = $request->description;
		$model->save();

		if($model->email){
            dispatch(new WelcomeMailJob(['name' => $model->name, 'email' => $model->email]));
        }

		$response = [
			'model' => $model,
			'message' => __('contact.Contact Added Successfully'),
			'goto' => route('contact.index')
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
		$model = Contact::findOrFail($id);
		return view('contact.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Contact::findOrFail($id);
		$contact_categories = ContactCategory::all()->pluck('name', 'id')->prepend(__('contact.Select Contact Category'), '');
		return view('contact.edit', compact('model', 'contact_categories'));
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
            'mobile_no' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email',
            'contact_category_id' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Contact::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('contact.Contact Not Found')]);
		}

		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->email = $request->email;
		$model->contact_category_id = $request->contact_category_id;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('contact.Contact Updated Successfully'),
			'goto' => route('contact.index'),
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

		$model = Contact::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('contact.Contact Not Found')]);
		}

		//Check Contact

		$model->delete();

		return response()->json(['message' => __('contact.Contact Deleted Successfully'), 'goto' => route('contact.index')]);
	}
}
