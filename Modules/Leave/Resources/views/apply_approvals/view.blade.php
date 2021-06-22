<div class="modal fade admin-query" id="Apply_Leave_Edit">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('leave.Apply Leave Details') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('leave.Type') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Staff') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Joining Date') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Email') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.From') }}:</label>
                            @if( $apply_leave->end_date != "0000-00-00")
                            <label class="primary_input_label" for="">{{ __('leave.To') }}:</label>
                            @endif
                            <label class="primary_input_label" for="">{{ __('leave.Apply Date') }}:</label>
                            <label class="primary_input_label" for="">{{ __('common.Status') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Reason') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Attachment') }}:</label>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ $apply_leave->leave_type->name }}.</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->name }}.</label>
                            <label class="primary_input_label"
                                   for="">{{ formatDate($apply_leave->user->created_at) }}</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->email }}.</label>
                            <label class="primary_input_label"
                                   for="">{{ formatDate($apply_leave->start_date) }}</label>
                                   @if($apply_leave->end_date != "0000-00-00")
                            <label class="primary_input_label"
                                   for="">{{ formatDate($apply_leave->end_date)  }}</label>
                                   @endif
                            <label class="primary_input_label"
                                   for="">{{ formatDate($apply_leave->apply_date) }}</label>
                            @if ($apply_leave->status == 0)
                                <span class="badge_3">{{__('leave.Pending')}}</span>
                            @elseif ($apply_leave->status == 1)
                                <span class="badge_1">{{__('leave.Approved')}}</span>
                            @else
                                <span class="badge_4">{{__('leave.Cancelled')}}</span>
                            @endif
                            <label class="primary_input_label" for="">{{ $apply_leave->reason }}</label>
                            <label class="primary_input_label" for=""><a href="{{ asset($apply_leave->attachment) }}"
                                                                         download
                                                                         target="_blank">@if ($apply_leave->attachment != Null) {{ __('leave.See Attachment') }} @else {{ __('leave.Not Available') }} @endif</a>.</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('leave.Date of Joining') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Employment Type') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Last Date Of Provisional Period') }}
                                :</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="">{{ formatDate($apply_leave->user->staff->date_of_joining) }}
                                .</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->staff->employment_type }}
                                .</label>
                            <label class="primary_input_label"
                                   for="">{{ formatDate(\Carbon\Carbon::now()->addMonths($apply_leave->user->staff->provisional_months)) }}
                                .</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('leave.Total Leave') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Remaining Total Leave') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Extra Taken Leave') }}:</label>
                        </div>
                    </div>
                    @php
                        $remaining_leave_days = 0;
                        $extra_leave_days =  0;
                        if ($total_leave->sum('total_days') > $apply_leave_histories->sum('total_days')) {
                            $remaining_leave_days = $total_leave->sum('total_days') - $apply_leave_histories->sum('total_days');
                        }else {
                            $extra_leave_days =  $apply_leave_histories->sum('total_days') - $total_leave->sum('total_days');
                        }
                    @endphp
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="">{{ $total_leave->sum('total_days') }} {{__('leave.Days')}}</label>
                            <label class="primary_input_label" for="">{{ $remaining_leave_days }} {{__('leave.Days')}}
                                .</label>
                            <label class="primary_input_label" for="">{{ $extra_leave_days }} {{__('leave.Days')}}
                                .</label>
                        </div>
                    </div>
                </div>
                @if ($apply_leave->status != 1)
                    <hr>
                    <div class="row">
                        <input type="hidden" name="apply_leave_id" id="apply_leave_id" value="{{ $apply_leave->id }}">
                        <div class="col-xl-9 mt-2">
                            <button type="submit" class="primary-btn btn-sm fix-gr-bg" data-dismiss="modal"><i
                                    class="ti-close"></i>{{ __('leave.Cancel') }}</button>
                        </div>
                        <div class="col-xl-3">
                            <div class="primary_input mb-15">
                                <select class="primary_select mb-15" name="status" id="status" required>
                                    <option>Select one</option>
                                    <option value="1"
                                            @if ($apply_leave->status == 1) selected @endif>{{ __('leave.Approve') }}</option>
                                    <option value="0"
                                            @if ($apply_leave->status == 0) selected @endif>{{ __('leave.Pending') }}</option>
                                    <option value="2"
                                            @if ($apply_leave->status == 2) selected @endif>{{ __('leave.Cancel') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#status").change(function () {
            var apply_leave_id = $('#apply_leave_id').val();
            var status = $('#status').val();
            $.post('{{ route('set_approval_leave') }}', {
                _token: '{{ csrf_token() }}',
                id: apply_leave_id,
                status: status
            }, function (data) {
                if (data.success) {
                    toastr.success(data.success);
                    location.reload();
                } else {
                    toastr.error(data.error);
                }
            });
        });
    });
</script>
