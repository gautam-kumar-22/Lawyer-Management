<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Entities\Attendance;
use Modules\RolePermission\Entities\Role;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Attendance\Http\Requests\AttendanceReportFormRequest;
use Modules\Attendance\Repositories\AttendanceRepositoryInterface;
use App\User;
use PDF;

class AttendanceReportController extends Controller
{
    protected $attaendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attaendanceRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->attaendanceRepository = $attaendanceRepository;
    }
    public function index()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('attendance::attendance_reports.index', compact('months'));
    }

    public function reports(AttendanceReportFormRequest $request)
    {
        try {
            $reports = $this->attaendanceRepository->report($request->all());
            $users = $this->attaendanceRepository->user($request->all());
            $report_dates = $this->attaendanceRepository->date($request->all());
            $r = $request->role_id;
            $m = $request->month;
            $y = $request->year;
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            return view('attendance::attendance_reports.index',[
                'reports' => $reports,
                'report_dates' => $report_dates,
                'users' => $users,
                'r' => $r,
                'm' => $m,
                'y' => $y,
                'months' => $months
            ]);
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function attendance_report_print($role_id, $month, $year)
    {
        try{
            $users = User::where('role_id', $role_id)->get();
            $report_dates = Attendance::where('month', $month)->where('year', $year)->distinct()->get(['date']);;
            $role = Role::find($role_id);
            $r = $role_id;
            $m = $month;
            $y = $year;
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $customPaper = array(0, 0, 700.00, 1000.80);
            $pdf = PDF::loadView(
                'attendance::attendance_reports.staff_attendance_print',
                [
                    'report_dates' => $report_dates,
                    'users' => $users,
                    'r' => $r,
                    'm' => $m,
                    'y' => $y,
                    'role' => $role,
                    'months' => $months
                ]
            )->setPaper('A4', 'landscape');
            return $pdf->stream('staff_attendance.pdf');

        }catch (\Exception $e) {
            
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
