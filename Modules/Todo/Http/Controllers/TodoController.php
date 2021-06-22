<?php

namespace Modules\Todo\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Todo\Entities\ToDo;
use Auth;

class TodoController extends Controller
{
    public function index()
    {
        $toDos = ToDo::where('created_by', Auth::id())->get();
        return view('todo::index', compact('toDos'));
    }

    public function create()
    {
        return view('attendance::create');
    }

    public function store(Request $request)
    {
        $validate_rules = [
            'title' => 'required',
            'date' => 'required',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try {
            $todo = new ToDo;
            $todo->title = $request->title;
            $todo->status = 0;
            $todo->date = date('Y-m-d', strtotime($request->date));
            $todo->save();
            Toastr::success(trans('todo.To Do Created Successfully'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }

    }

    public function completeToDo(Request $request)
    {

        try {
            $todo = ToDo::find($request->id);
            $todo->update(['status' => 1]);
            return response()->json(['success' => trans('todo.To Do Has Been Marked as Complete')]);
        } catch (\Exception $e) {
            return response()->json(['success' => trans('common.Something Went Wrong')]);
        }
    }

    public function completeList()
    {
        return ToDo::where('created_by', Auth::id())->where('status',1)->get();
    }

}
