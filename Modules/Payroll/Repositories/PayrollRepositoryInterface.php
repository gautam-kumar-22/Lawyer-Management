<?php

namespace Modules\Payroll\Repositories;

interface PayrollRepositoryInterface
{

    public function create(array $data);

    public function find($id);

    public function userFind($id);

    public function attendance($id, $payroll_month, $payroll_year);

    public function leaveApprove($id);

    public function payrollEarnDetails($id);

    public function payrollDedcDetails($id);

    public function user(array $data);

    public function savePayrollPaymentData(array $data);

    public function payrollReports($role, $month, $year);

    public function userPayrollDetails($id);
}
