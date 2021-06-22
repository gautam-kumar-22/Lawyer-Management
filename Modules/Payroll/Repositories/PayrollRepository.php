<?php

namespace Modules\Payroll\Repositories;
use Modules\Account\Repositories\JournalRepository;
use Modules\Leave\Entities\ApplyLeave;
use Modules\Attendance\Entities\Attendance;
use Modules\Payroll\Entities\PayrollEarnDeduce;
use Modules\Payroll\Entities\Payroll;
use Modules\Payroll\Entities\PayrollPaymentLog;
use Carbon\Carbon;
use App\User;
use App\Staff;
use DateTime;
use Auth;
use DB;
use Modules\Account\Entities\ChartAccount;


class PayrollRepository implements PayrollRepositoryInterface
{
   
    public function create(array $data)
    {
        $payrollGenerate = new Payroll();
        $payrollGenerate->staff_id = $data['staff_id'];
        $payrollGenerate->role_id = $data['role_id'];
        $payrollGenerate->payroll_month = $data['payroll_month'];
        $payrollGenerate->payroll_year = $data['payroll_year'];
        $payrollGenerate->basic_salary = $data['basic_salary'];
        $payrollGenerate->total_earning = $data['total_earnings'];
        $payrollGenerate->total_deduction = $data['total_deduction'];
        $payrollGenerate->gross_salary = $data['final_gross_salary'];
        $payrollGenerate->tax = $data['tax'];
        $payrollGenerate->net_salary = $data['net_salary'];
        $payrollGenerate->payroll_status = 'G';
        $result = $payrollGenerate->save();
        $payrollGenerate->toArray();
       
        if ($result) {
            $earnings = count($data['earningsType']);
            for ($i = 0; $i < $earnings; $i++) {
                if (!empty($data['earningsType'][$i]) && !empty($data['earningsValue'][$i])) {
                    $payroll_earn_deducs = new PayrollEarnDeduce;
                    $payroll_earn_deducs->payroll_id = $payrollGenerate->id;
                    $payroll_earn_deducs->type_name = $data['earningsType'][$i];
                    $payroll_earn_deducs->amount = $data['earningsValue'][$i];
                    $payroll_earn_deducs->earn_dedc_type = 'E';
                    $result = $payroll_earn_deducs->save();
                }
            }
            if (isset($data['deductionsValue']) and $data['deductionsValue'][0] != null) {
                $deductions = count($data['deductionstype']);
                for ($i = 0; $i < $deductions; $i++) {
                    if (!empty($data['deductionstype'][$i]) && !empty($data['deductionsValue'][$i])) {
                        $payroll_earn_deducs = new PayrollEarnDeduce;
                        $payroll_earn_deducs->payroll_id = $payrollGenerate->id;
                        $payroll_earn_deducs->type_name = $data['deductionstype'][$i];
                        $payroll_earn_deducs->amount = $data['deductionsValue'][$i];
                        $payroll_earn_deducs->earn_dedc_type = 'D';
                        
                        $result = $payroll_earn_deducs->save();
                    }
                }
            }
        }
    }

    public function find($id)
    {
        return Payroll::find($id);
    }

    public function userFind($id)
    {
        return User::find($id);
    }

    public function attendance($id, $payroll_month, $payroll_year)
    {
        return Attendance::where('user_id', $id)->where('month', $payroll_month)->where('year', $payroll_year)->get();
    }

    public function leaveApprove($id)
    {
        return ApplyLeave::where('status', 1)->where('user_id', $id)->get();
    }

    public function user(array $data)
    {
        return User::where('role_id', $data['role_id'])->get();
    }

    public function savePayrollPaymentData(array $data)
    {
        $payments = Payroll::find($data['payroll_generate_id']);
        $payments->payment_date = Carbon::parse($data['payment_date'])->format('Y-m-d');
        $payments->payment_mode = $data['payment_mode'];
        $payments->note = $data['note'];

        if (array_key_exists('bank_name', $data)) {
            $payments->bank_name = $data['bank_name'];
            $payments->bank_branch_name = $data['bank_branch_name'];
            $payments->account_no = $data['account_no'];
        }
        

        $payments->payroll_status = 'P';
        $result = $payments->update();
        $main_amount = $payments->basic_salary;
        $user = Staff::findOrFail($payments->staff_id)->user;

        return $payments;
    }

    public function payrollEarnDetails($id)
    {
        return PayrollEarnDeduce::where('active_status', '=', '1')->where('payroll_id', '=', $id)->where('earn_dedc_type', '=', 'E')->get();
    }

    public function payrollDedcDetails($id)
    {
        return PayrollEarnDeduce::where('active_status', '=', '1')->where('payroll_id', '=', $id)->where('earn_dedc_type', '=', 'D')->get();
    }

    public function payrollReports($role, $month, $year)
    {
        return Payroll::where('payroll_month', $month)->where('payroll_year', $year)->where('role_id', $role)->latest()->get();
    }

    public function userPayrollDetails($id)
    {
        return Payroll::where('staff_id', $id)->latest()->get();
    }

}
