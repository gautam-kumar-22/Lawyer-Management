<?php

namespace Modules\Payroll\Http\Controllers;

use App\Traits\Notification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Modules\Payroll\Http\Requests\PayrollReportFormRequest;
use Modules\Payroll\Http\Requests\PayrollFilterFormRequest;
use Modules\Payroll\Repositories\PayrollRepositoryInterface;
use App\Traits\PdfGenerate;
use PDF;

class PayrollController extends Controller
{
    use Notification, PdfGenerate;
    protected $payrollRepository,$userRepository;

    public function __construct(PayrollRepositoryInterface $payrollRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->payrollRepository = $payrollRepository;
    }

    public function index()
    {
    	try{
    		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        	return view('payroll::payrolls.index', compact('months'));
    	}
    	catch(\Exception $e)
    	{
		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
            return redirect()->back();
    	}

    }


    public function search_for_payroll(PayrollFilterFormRequest $request)
    {
        try {
            $users = $this->payrollRepository->user($request->all());
            $r = $request->role_id;
            $m = $request->month;
            $y = $request->year;
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            return view('payroll::payrolls.index',[
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

    public function generatePayroll(Request $request, $id, $payroll_month, $payroll_year)
	{
		try{
			$staffDetails = $this->payrollRepository->userFind($id);
			$month = date('m', strtotime($payroll_month));
			$attendances = $this->payrollRepository->attendance($id,$payroll_month,$payroll_year);

			$p = 0;
			$l = 0;
			$a = 0;
			$f = 0;
			$h = 0;
			foreach ($attendances as $value) {
				if ($value->attendance == 'P') {
					$p++;
				} elseif ($value->attendance == 'L') {
					$l++;
				} elseif ($value->attendance == 'A') {
					$a++;
				} elseif ($value->attendance == 'F') {
					$f++;
				} elseif ($value->attendance == 'H') {
					$h++;
				}
			}

			$approve_leaves = $this->payrollRepository->leaveApprove($id);

			return view('payroll::payrolls.generatePayroll', compact('staffDetails', 'payroll_month', 'payroll_year', 'p', 'l', 'a', 'f', 'h'));
		}catch (\Exception $e) {

		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
	}

    public function savePayrollData(Request $request,UserRepositoryInterface $userRepository)
	{
        $validate_rules = [
            'net_salary' => "required"
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        DB::beginTransaction();
		try{
            $this->payrollRepository->create($request->except("_token"));
            $staff = $userRepository->find($request->staff_id);

            DB::commit();
			Toastr::success('Operation successful', 'Success');
			return redirect()->route('payroll.index');
		}catch (\Exception $e) {
		    DB::rollBack();

		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
	}

	public function paymentPayroll(Request $request)
	{
		try{
			$payrollDetails = $this->payrollRepository->find($request->id);
            $role_id = $request->role_id;
			return view('payroll::payrolls.paymentPayroll', compact('payrollDetails', 'role_id'));
		}catch (\Exception $e) {

		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
	}

    public function savePayrollPaymentData(Request $request)
	{
	    DB::beginTransaction();
		try{
            $payroll = $this->payrollRepository->savePayrollPaymentData($request->except("_token"));
            DB::commit();
            Toastr::success('Payment Has been done Successfully');
			return redirect()->route('payroll.index');
		}catch (\Exception $e) {
			DB::rollBack();
		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
	}

	public function viewPayslip(Request $request)
	{
		try{
			$payrollDetails = $this->payrollRepository->find($request->id);
			$payrollEarnDetails = $this->payrollRepository->payrollEarnDetails($request->id);
			$payrollDedcDetails = $this->payrollRepository->payrollDedcDetails($request->id);

			return view('payroll::payrolls.viewPayslip', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails'));
		}catch (\Exception $e) {
		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
	}


    public function report_index()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('payroll::payroll_reports.payroll', compact('months'));
    }

    public function searchPayrollReport(PayrollReportFormRequest $request)
    {
		try{
            $r = $request->role_id;
            $m = $request->month;
            $y = $request->year;
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $payrolls = $this->payrollRepository->payrollReports($request->role_id, $request->month, $request->year);
			return view('payroll::payroll_reports.payroll', compact('months', 'm', 'y', 'r', 'payrolls'));
		}catch (\Exception $e) {

		   Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
		   return redirect()->back();
		}
    }



    public function getPdf($id)
    {
        try {
            $payrollDetails = $this->payrollRepository->find($id);

            return $this->getPayroll('payroll::payrolls.viewPayslip', $payrollDetails);
        } catch (\Exception $e) {

            Toastr::error(__("common.Something Went Wrong"), 'Error!');
            return back();
        }
    }
}
