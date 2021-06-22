@extends('layouts.master', ['title' => 'Attendance'])
@section('mainContent')
    @include("backEnd.partials.alertMessage")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('attendance.Attendance') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('attendance.Select Role') }}</label>
                                    <select class="primary_select mb-15 role_type" name="role_id" id="role_id" onchange="get_user()">
                                        <option selected disabled>{{__('attendance.Choose One')}}</option>
                                        @foreach (\Modules\RolePermission\Entities\Role::whereNotIn('type',['normal_user','system_user'])->get() as $role)
                                            @if($role->id !== 1)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('role_type')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Date') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="startDate" type="text" onchange="get_user()" name="date"
                                                           value="{{date('Y-m-d')}}" autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="create_form">

    </div>
@include('backEnd.partials.delete_modal')
@endsection
@push('scripts')
    <script type="text/javascript">
        function get_user()
        {
            var role_id = $('#role_id').val();
            var date = $('#startDate').val();
            if (role_id && date)
            {
                $.post('{{ route('get_user_by_role') }}',{_token:'{{ csrf_token() }}', role_id:role_id,date:date}, function(data){
                    $(".create_form").html(data);
                    $('select').niceSelect();
                });
            }
        }
    </script>
@endpush
