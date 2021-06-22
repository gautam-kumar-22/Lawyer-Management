<div class="modal fade admin-query" id="SlipForm">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('payroll.View Payslip Details') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row mb-25">
                    <div class="col-lg-12 text-center">
                        <h3>{{ app('general_setting')->company_name }}</h3>
                        <h6>{{ app('general_setting')->address }}</h6>
                    </div>
                    <div class="col-lg-12 text-center">
                        <h5>{{ __('payroll.Payslip for the period of') }} {{ $payrollDetails->payroll_month }} - {{ $payrollDetails->payroll_year }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <p>{{ __('payroll.Payslip') }} - {{ $payrollDetails->id }}</p>
                    </div>
                    <div class="col-md-7 text-right">
                        <p>{{ $payrollDetails->payment_date }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('common.Name') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Payment Method') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Basic Salary') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Total Earning') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Total Deduction') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Net Salary') }}:</label>
                            <label class="primary_input_label" for="">{{ __('payroll.Gross Salary') }}:</label>
                        </div>
                    </div>
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{$payrollDetails->staff->user->name}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{strtoupper($payrollDetails->payment_mode)}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{single_price($payrollDetails->basic_salary)}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{single_price($payrollDetails->total_earning)}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{single_price($payrollDetails->total_deduction)}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{single_price($payrollDetails->net_salary)}} @endif.</label>
                        <label class="primary_input_label" for="">@if(isset($payrollDetails)){{single_price($payrollDetails->gross_salary)}} @endif.</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
