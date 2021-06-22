<div id="edit_leave_define_modal">
    <div class="modal fade" id="leave_define_edit">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ __('common.Update') }}
                        {{ __('leave.Leave Define') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="leave_define_edit_form">
                        <input type="hidden" name="id" id="item_id">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('role.Role') }}</label>
                                    <select class="primary_select mb-25" name="role_id" id="role_id" required>
                                        @foreach ($RoleList as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="role_id_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Leave Type') }}</label>
                                    <select class="primary_select mb-25" name="leave_type_id" id="leave_type_id"  required>
                                        @foreach ($LeaveTypeList as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="leave_type_id_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input ">
                                    <label id='details' class="primary_input_label" for="">{{ __('leave.Total Days') }}</label>
                                    <input name="total_days" class="primary_input_field total_days"  id="total_days_id"  placeholder="{{ __('leave.Total Days') }}" type="number" min="0" step="1">
                                    <span id="total_days_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Balance Forward') }}</label>
                                    <ul id="theme_nav" class="permission_list sms_list ">
                                        <li>
                                            <label data-id="bg_option"
                                                   class="primary_checkbox d-flex mr-12">
                                                <input name="balance_forward" id="status_active" onchange="setMaxForward(this)" value="1" class="active"
                                                       type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>{{ __('leave.Balance Forward') }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-xl-12 max_forward displayNone">
                                <div class="primary_input">
                                    <label id='details' class="primary_input_label" for="">{{ __('leave.Max Forward Balance') }} *</label>
                                    <input name="max_forward" oninput="checkForwardBalance(this)" class="primary_input_field max_forward_balance" placeholder="{{ __('leave.Total Days') }}" type="number">
                                    <span id="max_forward_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" id="leave_define_create_form_button" class="primary-btn semi_large2 fix-gr-bg"><i class="ti-check"></i>
                                        {{ __('common.Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
