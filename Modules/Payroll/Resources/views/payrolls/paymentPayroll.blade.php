<div class="modal fade admin-query" id="PaymentForm">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('payroll.Proceed To Pay') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('payroll_payment_store') }}" method="POST" id="division_editForm">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('payroll.Staff Name') }}</label>
                                <input name="amount" readonly class="primary_input_field name read-only-input" type="text" value="{{$payrollDetails->staff->user->name}}" readonly>
                                <input type="hidden" name="payroll_generate_id" value="{{$payrollDetails->id}}">
                                <input type="hidden" name="role_id" value="{{$role_id}}">
                                <input type="hidden" name="payroll_month" value="{{$payrollDetails->payroll_month}}">
                                <input type="hidden" name="payroll_year" value="{{$payrollDetails->payroll_year}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('attendance.Month') }} {{ __('attendance.Year') }}</label>
                                <input name="amount" readonly class="primary_input_field name read-only-input" type="text" value="{{$payrollDetails->payroll_month}} - {{$payrollDetails->payroll_year}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('common.Date') }}</label>
                                <div class="primary_datepicker_input">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="">
                                                <input placeholder="Date" readonly class="primary_input_field primary-input date form-control date" id="startDate" type="text" name="payment_date" value="{{ date('Y-m-d') }}" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('payroll.Payment Amount') }}</label>
                                <input name="pay_amount" readonly class="primary_input_field name read-only-input" type="text" value="{{$payrollDetails->net_salary}}" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label required" for="">{{ __('payroll.Payment Method') }}</label>
                                <select class="primary_select mb-25" name="payment_mode" id="payment_mode" required onchange="getField()">
                                    <option value="cash">{{__('payroll.Cash')}}</option>
                                    <option value="bank">{{__('payroll.Bank')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="sibling_name_div">
                            <div class="input-effect mt-20">
                                <label class="primary_input_label" for="">{{ __('payroll.Note') }}</label>
                                <textarea class="primary_textarea height_112 description" name="note" spellcheck="false"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="bank_section">
                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('payroll.Bank Name') }}</label>
                                <input name="bank_name" id="bank_name" class="primary_input_field" type="text" value="{{ $payrollDetails->staff->bank_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('payroll.Branch Name') }}</label>
                                <input name="bank_branch_name" id="bank_branch_name" class="primary_input_field" type="text" value="{{ $payrollDetails->staff->bank_branch_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('payroll.Account No') }}</label>
                                <input name="account_no" id="account_no" class="primary_input_field" type="text" value="{{ $payrollDetails->staff->bank_account_no }}" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="d-flex justify-content-center pt_20">
                            <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="save_button_parent"><i class="ti-check"></i>{{ __('payroll.Pay Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getField();
    });
    function getField()
    {
        var payment_mode = $('#payment_mode').val();
        if (payment_mode == "bank") {
            $('#bank_section').removeClass('d-none')
            $("#bank_name").removeAttr("disabled");
            $("#bank_branch_name").removeAttr("disabled");
            $("#account_no").removeAttr("disabled");
        }
        else {
            $('#bank_section').addClass('d-none')
            $("#bank_name").attr('disabled', true);
            $("#bank_branch_name").attr('disabled', true);
            $("#account_no").attr('disabled', true);
        }
    }
</script>
