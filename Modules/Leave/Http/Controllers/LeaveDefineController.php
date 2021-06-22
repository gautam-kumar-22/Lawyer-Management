<?php

namespace Modules\Leave\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Leave\Repositories\LeaveDefineRepository;
use Modules\Leave\Repositories\LeaveDefineRepositoryInterface;
use Modules\Leave\Repositories\LeaveTypeRepository;
use Modules\Leave\Repositories\LeaveTypeRepositoryInterface;
use Modules\RolePermission\Repositories\RoleRepository;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class LeaveDefineController extends Controller
{
    protected $leaveDefineRepository,$roleRepo,$leaveTypeRpo;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->leaveDefineRepository = new LeaveDefineRepository();
        $this->roleRepo = new RoleRepository();
        $this->leaveTypeRpo = new LeaveTypeRepository();
    }

    public function index()
    {
        try {
            $data['LeaveDefineList'] = $this->leaveDefineRepository->all();
            $data['RoleList'] = $this->roleRepo->regularRoles();
            $data['LeaveTypeList'] = $this->leaveTypeRpo->all();

            return view('leave::leave_defines.index', $data);

        } catch (\Exception $e) {
            Toastr::error('Operation failed');
            return back();
        }
    }

    public function store(Request $request)
    {
        $validate_rules = [
            'role_id' => 'required',
            'leave_type_id' => 'required',
            'total_days' => 'required',
            'max_forward' => 'required_if:balance_forward,==,1',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {
            $this->leaveDefineRepository->create([
                'role_id' => $request['role_id'],
                'user_id' => $request['user_id'] ?? null,
                'leave_type_id' => $request['leave_type_id'],
                'total_days' => $request['total_days'],
                'balance_forward' => $request['balance_forward'] ? 1 : 0,
                'max_forward' => $request['max_forward'] ? $request['max_forward'] : 0,
            ]);
            $LeaveDefineList = $this->leaveDefineRepository->all();
            return response()->json([
                'TableData' => (string)view('leave::page-components.leave_define_list', compact('LeaveDefineList'))
            ]);

        } catch (\Exception $e) {
            return response()->json(trans('common.Something Went Wrong'));
        }
    }

    public function update(Request $request)
    {
        $validate_rules = [
            'role_id' => 'required',
            'leave_type_id' => 'required',
            'total_days' => 'required',
            'max_forward' => 'required_if:balance_forward,==,1',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {
            $this->leaveDefineRepository->update([
                'role_id' => $request['role_id'],
                'user_id' => $request['user_id'] ?? null,
                'leave_type_id' => $request['leave_type_id'],
                'total_days' => $request['total_days'],
                'balance_forward' => $request['balance_forward'] ? 1 : 0,
                'max_forward' => $request['max_forward'] ? $request['max_forward'] : 0,
            ], $request['id']);

            $LeaveDefineList = $this->leaveDefineRepository->all();
            return response()->json([
                'TableData' => (string)view('leave::page-components.leave_define_list', compact('LeaveDefineList'))
            ]);

        } catch (\Exception $e) {
            return response()->json(trans('common.Something Went Wrong'));
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {
            $this->leaveDefineRepository->delete($request['id']);
            $LeaveDefineList = $this->leaveDefineRepository->all();
            return response()->json([
                'TableData' => (string)view('leave::page-components.leave_define_list', compact('LeaveDefineList'))
            ]);

        } catch (\Exception $e) {
            return response()->json(trans('common.Something Went Wrong'));
        }
    }
}
