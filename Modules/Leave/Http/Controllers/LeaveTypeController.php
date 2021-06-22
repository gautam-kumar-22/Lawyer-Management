<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Leave\Repositories\LeaveTypeRepositoryInterface;
use Brian2694\Toastr\Facades\Toastr;
class LeaveTypeController extends Controller
{
    protected $leaveTypeRepositoryInterface;

    public function __construct(LeaveTypeRepositoryInterface $leaveTypeRepositoryInterface)
    {
        $this->middleware(['auth', 'verified']);
        $this->leaveTypeRepositoryInterface = $leaveTypeRepositoryInterface;
    }

    public function index()
    {
        try{
            $data['LeaveTypeList'] = $this->leaveTypeRepositoryInterface->all();
            return view('leave::leave_types.index',$data);

        }catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
    }

    public function store(Request $request)
    {
        $validate_rules = [
            'name' => ['required', 'string' ,'max:191'],
            'status' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try{
            $createdItem = $this->leaveTypeRepositoryInterface->create([
                'name'          => $request->name,
                'status'        => $request->status,
            ]);

        }catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
       return  $this->loadTableData();
    }

    public function update(Request $request)
    {

        $validate_rules = [
            'name' => ['required', 'string' ,'max:191'],
            'status' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try{
            $createdItem = $this->leaveTypeRepositoryInterface->update([
                'name' => $request->name,
                'status' => $request->status,
            ],$request->id);

            return  $this->loadTableData();
        }catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id'       => 'required',
        ]);

        try{
            $this->leaveTypeRepositoryInterface->delete($request['id']);
            return  $this->loadTableData();

        }catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
    }

    private function loadTableData()
    {
        try{
            $LeaveTypeList = $this->leaveTypeRepositoryInterface->all();
            return response()->json([
                'TableData' =>  (string)view('leave::leave_types.components.list',compact('LeaveTypeList') )
            ]);
        }catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
    }
}
