<?php

namespace App\Http\Controllers;

use App\Traits\Notification;
use Illuminate\Http\Request;
use App\StaffDocument;
use Brian2694\Toastr\Facades\Toastr;
use App\Repositories\UserRepositoryInterface;
use Modules\Leave\Repositories\LeaveRepository;
use Modules\Payroll\Repositories\PayrollRepositoryInterface;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\StaffUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\RolePermission\Entities\Role;

class StaffController extends Controller
{
    use Notification;

    protected $userRepository, $leaveRepository, $payrollRepository, $applyLoanRepository;

    public function __construct(UserRepositoryInterface $userRepository, LeaveRepository $leaveRepository, PayrollRepositoryInterface $payrollRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->userRepository = $userRepository;
        $this->leaveRepository = $leaveRepository;
        $this->payrollRepository = $payrollRepository;
    }

    public function index(Request $request)
    {
        try {

            $staffs = $this->userRepository->all(['user']);

            return view('backEnd.staffs.index', [
                "staffs" => $staffs,
            ]);
        } catch (\Exception $e) {
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }

    }

    public function create()
    {
        return view('backEnd.staffs.create');
    }

    public function store(StaffRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->password) {
                try {
                    $staff = $this->userRepository->store($request->except("_token"));

                    DB::commit();
                    Toastr::success(__('common.Staff has been added Successfully'));
                    return redirect()->route('staffs.index');
                } catch (\Exception $e) {

                    DB::rollBack();
                    Toastr::error(__('common.Something Went Wrong'));
                    return back();
                }
            } else {
                DB::rollBack();
                Toastr::error(__('common.Something Went Wrong'));
                return back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function show(Request $request)
    {
        try {
            $staffDetails = $this->userRepository->find($request->id);
            $leaveDetails = $this->leaveRepository->user_leave_history($staffDetails->user->id);
            $total_leave = $this->leaveRepository->total_leave($staffDetails->user->id);
            $apply_leave_histories = $this->leaveRepository->user_leave_history($staffDetails->user->id);
            $payrollDetails = $this->payrollRepository->userPayrollDetails($request->id);
            return view('backEnd.staffs.viewStaff', [
                "staffDetails" => $staffDetails,
                "leaveDetails" => $leaveDetails,
                "total_leave" => $total_leave,
                "payrollDetails" => $payrollDetails,
                'apply_leave_histories' => $apply_leave_histories,
            ]);
        } catch (\Exception $e) {

            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function report_print(Request $request)
    {
        try {
            $staffDetails = $this->userRepository->find($request->id);
            return view('backEnd.staffs.print_view', [
                "staffDetails" => $staffDetails,
            ]);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function edit($id)
    {

        try {
            $staff = $this->userRepository->find($id);
            $roles = Role::where('type',$staff->user->role->type)->get();
            return view('backEnd.staffs.edit', [
                "staff" => $staff,
                "roles" => $roles,
            ]);
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function update(StaffUpdateRequest $request, $id)
    {
        if($this->demoCheck() == true){
            Toastr::warning('This Features is disabled for demo.');
            return back();
        }
        DB::beginTransaction();
        try {
            $staff = $this->userRepository->update($request->except("_token"), $id);

            DB::commit();

            Toastr::success(__('common.Staff info has been updated Successfully'));
            return redirect()->route('staffs.index');
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $staff = $this->userRepository->delete($id);

            Toastr::success(__('common.Staff has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function status_update(Request $request)
    {
        try {
            $staff = $this->userRepository->statusUpdate($request->except("_token"));

            return response()->json([
                'success' => trans('leave.Status has been updated Successfully')
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'error' => trans('common.Something Went Wrong')
            ]);
        }
    }

    public function document_store(Request $request)
    {
        try {
            if ($request->file('file') != "" && $request->name != "") {
                $file = $request->file('file');
                $document = 'staff-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('uploads/staff/document/', $document);
                $document = 'uploads/staff/document/' . $document;
                $staffDocument = new StaffDocument();
                $staffDocument->name = $request->name;
                $staffDocument->staff_id = $request->staff_id;
                $staffDocument->documents = $document;
                $staffDocument->save();
            }
            Toastr::success(__('common.Staff Document has been uploaded Successfully'));
            return redirect()->back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function document_destroy($id)
    {
        try {
            $staff = $this->userRepository->deleteStaffDoc($id);

            Toastr::success(__('common.Staff Document has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function profile_view()
    {
        try {
            $staffDetails = $this->userRepository->find(Auth::user()->staff->id);
            $leaveDetails = $this->leaveRepository->user_leave_history(Auth::user()->id);
            $total_leave = $this->leaveRepository->total_leave(Auth::user()->id);
            $apply_leave_histories = $this->leaveRepository->user_leave_history(Auth::user()->id);
            $payrollDetails = $this->payrollRepository->userPayrollDetails(Auth::user()->staff->id);

            return view('backEnd.profiles.profile', [
                "staffDetails" => $staffDetails,
                "leaveDetails" => $leaveDetails,
                "total_leave" => $total_leave,
                "payrollDetails" => $payrollDetails,
                'apply_leave_histories' => $apply_leave_histories,
            ]);
        } catch (\Exception $e) {
            Toastr::error(__('common.Something Went Wrong'));

            return back();
        }
    }

    public function profile_edit(Request $request)
    {
        try {
            $user = $this->userRepository->findUser($request->id);

            return view('backEnd.profiles.editProfile', [
                "user" => $user
            ]);
        } catch (\Exception $e) {

         Toastr::error(__('common.Something Went Wrong'));

            return back();
        }
    }

    public function profile_update(Request $request, $id)
    {
        if($this->demoCheck() == true){
            Toastr::warning('This Features is disabled for demo.');
            return back();
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::id(),
            'username' => 'nullable|sometimes|unique:users,username,'.Auth::id(),
            'phone' => 'nullable|sometimes|unique:staffs,phone,'.Auth::user()->staff->id,
        ]);
        if (Auth::user()->role_id != 1)
        {
            $request->validate([
                'bank_name' => 'nullable|sometimes',
                'bank_branch_name' => 'nullable|sometimes',
                'bank_account_name' => 'nullable|sometimes',
                'bank_account_no' => 'nullable|sometimes',
                'current_address' => 'nullable|sometimes',
                'permanent_address' => 'nullable|sometimes',
            ]);
        }
        try {
            $this->userRepository->updateProfile($request->except("_token"), $id);

            Toastr::success(__('common.Staff info has been updated Successfully'));
            return back();

        } catch (\Exception $e) {


            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

}
