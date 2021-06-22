<?php

namespace App\Http\Controllers;

use App\History;
use App\Models\Cases;
use Illuminate\Http\Request;

class HistoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if (!$request->case) {
			abort(404);
		}
		$case = Cases::findOrFail($request->case);

		$models = History::where('cases_id', $request->case)->get();

		return view('history.show', compact('models', 'case'));
	}
}
