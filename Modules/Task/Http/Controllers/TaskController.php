<?php

namespace Modules\Task\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Models\Stage;
use App\Models\Cases;
use Modules\Task\Entities\Task;
use App\Jobs\TaskAssigneeMailJob;
use App\Jobs\TaskCompleteMailJob;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $models = Task::where('status', 0)->get();
		return view('task::task.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $cases = Cases::all()->pluck('title', 'id')->prepend(__('Select Case'), '');
        $stages = Stage::all()->pluck('name', 'id')->prepend(__('Select Stage'), '');
        $users = User::all()->pluck('name', 'id')->prepend(__('Select User'), '');

        return view('task::task.create', compact('cases','stages','users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!$request->json()) {
			abort(404);
		}

        $validate_rules = [
            'assignee_id' => 'required|integer',
            'case_id' => 'required|integer',
            'stage_id' => 'sometimes|nullable|integer',
            'name' => 'required|max:191|string',
            'due_date' => 'required',
            'priority' => 'sometimes|nullable',
            'description' => 'sometimes|nullable',
            'progress' => 'sometimes|nullable',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Task();
		$model->assignee_id = $request->assignee_id;
		$model->created_by = auth()->id();
		$model->case_id = $request->case_id;
		$model->stage_id = $request->stage_id;
		$model->name = $request->name;
		$model->due_date = $request->due_date;
		$model->priority = $request->priority;
		$model->description = $request->description;
		$model->progress = $request->progress;
        $model->save();

        if ($model->assignee->email) {
            dispatch(new TaskAssigneeMailJob($model->creator, $model, $model->case, $model->assignee));
        }

		$response = [
			'model' => $model,
      'goto' => route('task.index'),
			'message' => __('Task Added Successfully <br> <a href="' . route('task.index') . '" class="btn btn-link btn-sm">Click here to Task list</a>'),
		];

		return response()->json($response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $model = Task::findOrFail($id);
		return view('task::task.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cases = Cases::all()->pluck('title', 'id')->prepend(__('Select Case'), '');
        $stages = Stage::all()->pluck('name', 'id')->prepend(__('Select Stage'), '');
        $users = User::all()->pluck('name', 'id')->prepend(__('Select User'), '');

        $model = Task::findOrFail($id);
		return view('task::task.edit', compact('model','cases','stages','users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (!$request->json()) {
			abort(404);
		}

        $validate_rules = [
            'assignee_id' => 'required|integer',
            'case_id' => 'required|integer',
            'stage_id' => 'sometimes|nullable|integer',
            'name' => 'required|max:191|string',
            'due_date' => 'required',
            'priority' => 'sometimes|nullable',
            'description' => 'sometimes|nullable',
            'progress' => 'sometimes|nullable',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Task::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Task Not Found')]);
		}

		$model->assignee_id = $request->assignee_id;
		$model->created_by = auth()->id();
		$model->case_id = $request->case_id;
		$model->stage_id = $request->stage_id;
		$model->name = $request->name;
		$model->due_date = $request->due_date;
		$model->priority = $request->priority;
		$model->description = $request->description;
		$model->progress = $request->progress;
		$model->save();

		$response = [
			'message' => __('Task Updated Successfully'),
			'goto' => route('task.index'),
		];

		return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
		$model = Task::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Task Not Found')]);
		}

		//Check Task

		$model->delete();

		return response()->json(['message' => __('Task Deleted Successfully'), 'goto' => route('task.index')]);
    }

    public function myTask()
    {
        $models = Task::where('assignee_id', auth()->id())->get();
        return view('task::task.index', compact('models'));
    }

    public function taskMarkcompleted($id)
    {
      $model = Task::findOrFail($id);
      $model->status = 1;
      $model->save();

      if ($model->assignee->email) {
          dispatch(new TaskCompleteMailJob($model->creator, $model, $model->case, $model->assignee));
      }

      return redirect()->back();
    }


    public function completed()
    {
      if(auth()->user()->role->type == 'system_user'){
        $models = Task::where('status', 1)->get();
      }else{
        $models = Task::where('assignee_id', auth()->id())->where('status', 1)->get();
      }


      return view('task::task.index', compact('models'));
    }
}
