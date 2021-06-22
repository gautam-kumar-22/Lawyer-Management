@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('leave.Apply Leave') }}</h3>

                                <ul class="d-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="#" data-toggle="modal"
                                           data-target="#ApplyLeave"><i
                                                class="ti-plus"></i>{{ __('leave.Apply New Leave') }}</a></li>
                                </ul>

                        </div>
                    </div>
                </div>
                @php
                    $remaining_leave_days = 0;
                    $extra_leave_days =  0;
                    $total_leave_days =  $total_leave + \Illuminate\Support\Facades\Auth::user()->staff->carry_forward;
                    if ($total_leave_days > $apply_leave_histories->sum('total_days')) {
                        $remaining_leave_days = $total_leave_days - $apply_leave_histories->sum('total_days');
                    }else {
                        $extra_leave_days =  $apply_leave_histories->sum('total_days') - $total_leave_days;
                    }
                @endphp
                <div class="col-lg-12 mb-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Total Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $total_leave_days }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Remaining Total Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $remaining_leave_days }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Extra Taken Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $extra_leave_days }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="apply_leave_list">
                                <table class="table Crm_table_active">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('leave.Type') }}</th>
                                        <th scope="col">{{ __('leave.From') }}</th>
                                        <th scope="col">{{ __('leave.To') }}</th>
                                        <th scope="col">{{ __('leave.Apply Date') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($apply_leaves as $key => $apply_leave)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $apply_leave->leave_type->name }}</td>

                                            <td>{{ formatDate($apply_leave->start_date) }}</td>
                                            <td>{{ $apply_leave->end_date != '0000-00-00' ? formatDate($apply_leave->end_date) : '' }}</td>
                                            <td>{{ formatDate($apply_leave->apply_date) }}</td>
                                            <td>
                                                @if ($apply_leave->status == 0)
                                                    <span class="badge_3">Pending</span>
                                                @elseif ($apply_leave->status == 1)
                                                    <span class="badge_1">Approved</span>
                                                @else
                                                    <span class="badge_4">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        @if (permissionCheck('languages.edit_modal'))
                                                            @if ($apply_leave->status == 0)
                                                                <a href="javascript:void(0)" class="dropdown-item"
                                                                   onclick="edit_apply_leave_modal({{ $apply_leave->id }})">{{__('common.Edit')}}</a>
                                                            @else
                                                                <a href="#"
                                                                   class="dropdown-item">{{__('common.Approved')}}</a>
                                                            @endif
                                                        @endif

                                                        @if ($apply_leave->status == 0)
                                                            <a onclick="confirm_modal('{{route('apply_leave.destroy', $apply_leave->id)}}');"
                                                               class="dropdown-item">{{__('common.Delete')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade admin-query" id="ApplyLeave">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('leave.Apply New Leave') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="#" method="POST" id="apply_leave_Form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if(Auth::user()->role->type == 'system_user')
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('leave.user') }} *</label>
                                        <select class="primary_select mb-25 department_id" name="user"
                                                id="department_id" required>
                                            @foreach ($users as $key => $user)
                                                <option
                                                    value="{{ $user->id }}" {{ $user->id == Auth::id() ? "selected" : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="user_id_error"></span>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="user" value="{{Auth::id()}}">
                            @endif
                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('leave.Apply Date') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="apply_date" type="text" name="apply_date"
                                                           value="{{date('Y-m-d')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Leave Type') }} *</label>
                                    <select class="primary_select mb-25" name="leave_type_id" id="leave_type_id"
                                            required>
                                        @foreach (\Modules\Leave\Entities\LeaveType::Active()->get() as $leave_type)
                                            <option value="{{ $leave_type->id }}">{{ $leave_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{ __('leave.Leave') }} *</label>
                                    <select onchange="leavePurpose(this)" class="primary_select day mb-25" name="day"
                                            id="leave_purpose">
                                        <option value="0">{{ __('leave.Half Day') }}</option>
                                        <option value="1">{{ __('leave.Single Day') }}</option>
                                        <option value="2">{{ __('leave.Multiple Day') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label leave_date">{{ __('leave.Leave Date') }} *</label>
                                    <label class="primary_input_label leave_from"
                                           style="display: none">{{ __('leave.Leave From') }} * </label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="start_date" type="text" name="start_date"
                                                           value="{{date('Y-m-d')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul id="theme_nav" class="permission_list sms_list half_or_full">
                                    <li class="mr-0 pr-2 show_half" style="display: none">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" onclick="showHalfs(this)" value="half" id="half_info"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Half Day') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 half">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="from_day" id="status_to" value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 half">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="from_day" value="2" id="to_status_inactive" class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                                <span class="text-danger" id="from_day_error"></span>
                            </div>
                            <div class="col-xl-6 leave_to displayNone">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label">{{ __('leave.Leave To') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="end_date" type="text" name="end_date"
                                                           value="{{date('Y-m-d')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                            <span class="text-danger" id="end_date_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="theme_nav" class="permission_list sms_list">
                                    <li class="mr-0 pr-2 show_half_to" style="display: none">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" onclick="showHalfsTo(this)" value="half" id="half_info"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Half Day') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 halfto">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" id="status_to" value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 halfto">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" value="2" id="to_status_inactive" class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-2 mt-30">
                                <ul id="theme_nav" class="permission_list sms_list">
                                    <li class="mr-0 pr-2 makeup_option">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_leave" onchange="showMakeup()" value="1"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Make Up Leave') }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4 makeup_date displayNone">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label">{{ __('leave.Make Up Leave Date') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date"
                                                           class="primary_input_field date primary-input form-control"
                                                           type="text" name="makeup_date"
                                                           value="{{\Carbon\Carbon::now()->addDays(1)->format('m/d/y')}}"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                            <span class="text-danger" id="end_date_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="theme_nav" class="permission_list sms_list makeup_half">
                                    <li class="mr-0 pr-2 makeup_half">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_half" id="status_makeup" value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 makeup_half">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_half" value="2" id="to_makeup_inactive"
                                                   class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-6 reason">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Reason') }} *</label>
                                    <input name="reason" class="primary_input_field name"
                                           placeholder="{{ __('leave.Reason') }}" type="text">
                                    <span class="text-danger" id="reason_error"></span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Attachment') }} </label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName"
                                               placeholder="Browse file" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file_1">{{__("common.Browse")}} </label>
                                            <input type="file" class="d-none" name="file" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                            id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="edit_form">

    </div>
    @include('backEnd.partials.delete_modal')
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#apply_leave_Form").on("submit", function (event) {
            event.preventDefault();
            let formData = $(this).serializeArray();
            $.each(formData, function (key, message) {
                $("#" + formData[key].name + "_error").html("");
            });
            $.ajax({
                url: "{{route("apply_leave.store")}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $("#apply_leave_Form").modal("hide");
                    $("#apply_leave_Form").trigger("reset");
                    if (response.success)
                        toastr.success(response.success);
                    else
                        toastr.warning(response.error);

                    location.reload();
                },
                error: function (error) {
                    if (error) {
                        $.each(error.responseJSON.errors, function (key, message) {
                            $("#" + key + "_error").html(message[0]);
                        });
                    }
                }

            });
        });

        function edit_apply_leave_modal(el) {
            $.post('{{ route('apply_leave.edit') }}', {_token: '{{ csrf_token() }}', id: el}, function (data) {
                $('.edit_form').html(data);
                $('#Apply_Leave_Edit').modal('show');
                $('select').niceSelect();
            });
        }

        function leavePurpose(el) {
            let day = $(el).val();
            $('#half_info').prop('checked',false);
            if (day == 2) {
                $('.leave_from').show();
                $('.show_half').show();
                $('.show_half_to').show();
                $('.half_day_from').prop("checked", false);
                $('.half_day_to').prop("checked", false);
                $('.leave_to').show();
                $('.leave_date').hide();
                $('.half_or_full').show();
                $('.half').hide();
                $('.halfto').hide();
                $('.makeup_option').hide();
                $('.reason').addClass('col-xl-12');
            } else if (day == 1) {
                $('.half_or_full').hide();
                $('.leave_date').show();
                $('.leave_from').hide();
                $('.leave_to').hide();
                $('.show_half').hide();
                $('.show_half_to').hide();
                $('.half').show();
                $('.halfto').hide();
                $('.makeup_option').show();
                $('.reason').removeClass('col-xl-12');
                $('.makeup_half').hide();
            } else {
                $('.half_or_full').show();
                $('.leave_date').show();
                $('.leave_from').hide();
                $('.leave_to').hide();
                $('.show_half').hide();
                $('.half').show();
                $('.show_half_to').hide();
                $('.halfto').hide();
                $('.makeup_option').show();
                $('.reason').removeClass('col-xl-12');
                $('.makeup_half').show();
            }
        }

        function showHalfs(el) {
            if ($(el).is(':checked'))
                $('.half').show();
            else
                $('.half').hide();
        }

        function showHalfsTo(el) {
            if ($(el).is(':checked'))
                $('.halfto').show();
            else
                $('.halfto').hide();
        }

        function showMakeup() {
            $('.makeup_date').toggle();

            let day = $('.day').val();

            if (day == 1)
                $('.makeup_half').hide();
            else
                $('.makeup_half').show();
        }


        $(document).on("submit", "#applyLeaveEditForm", function (event) {
            event.preventDefault();
            let id = $(".edit_id").val();
            let formData = $(this).serializeArray();
            $.each(formData, function (key, message) {
                $("#edit_" + formData[key].name + "_error").html("");
            });
            $.ajax({
                url: "{{url('/')}}" + "/leave/" + id + "/update",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $("#Apply_Leave_Edit").modal("hide");
                    $("#Apply_Leave_Edit").trigger("reset");
                    toastr.success(response);
                    location.reload();
                },
                error: function (error) {
                    if (error) {
                        $.each(error.responseJSON.errors, function (key, message) {
                            $("#edit_" + key + "_error").html(message[0]);
                        });
                    }
                }
            });
        });
    </script>
@endpush
