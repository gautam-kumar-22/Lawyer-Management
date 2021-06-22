@extends('layouts.master', ['title' => 'Payroll'])
@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('payroll.Payroll Reports') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">
                        <form class="" action="{{ route('payroll_reports.search') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('payroll.Select Role') }}</label>
                                        <select class="primary_select mb-15" name="role_id" id="role_id">
                                            <option selected disabled>{{__('payroll.Choose One')}}</option>
                                            @foreach (\Modules\RolePermission\Entities\Role::all() as $role)
                                                @isset($r)
                                                    <option value="{{ $role->id }}"@if ($r == $role->id) selected @endif>{{ $role->name }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endisset
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('role_id')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('payroll.Select Month') }}</label>
                                        <select class="primary_select mb-15" name="month" id="month">
                                            @foreach ($months as $month)
                                                @isset($m)
                                                    <option value="{{ $month }}"@if ($m == $month) selected @endif>{{ $month }}</option>
                                                @else
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endisset
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('month')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('payroll.Select Year') }}</label>
                                        <select class="primary_select mb-15" name="year" id="year">
                                            @foreach (range(\carbon\Carbon::now()->year, 2015) as $year)
                                                @isset($y)
                                                    <option value="{{ $year }}"@if ($y == $year) selected @endif>{{ $year }}</option>
                                                @else
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endisset

                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('year')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-2 mt-3 text-right">
                                        <button type="submit" class="primary-btn btn-sm fix-gr-bg"id="save_button_parent"><i class="ti-search"></i>{{ __('payroll.Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @isset($payrolls)
                    <div class="col-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('payroll.Payroll') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-40">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table ">
                                <!-- table-responsive -->
                                <div class="">
                                    <table class="table Crm_table_active3">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('common.SL') }}</th>
                                                <th scope="col">{{ __('staff.Staff') }}</th>
                                                <th scope="col">{{ __('role.Role') }}</th>
                                                <th scope="col">{{ __('payroll.Month') }} - {{ __('payroll.Year') }}</th>
                                                <th scope="col">{{ __('payroll.Basic Salary') }}</th>
                                                <th scope="col">{{ __('payroll.Gross Salary') }}</th>
                                                <th scope="col">{{ __('payroll.Earnings') }}</th>
                                                <th scope="col">{{ __('payroll.Deductions') }}</th>
                                                <th scope="col">{{ __('payroll.Tax') }}</th>
                                                <th scope="col">{{ __('payroll.Paid Date') }}</th>
                                                <th scope="col">{{ __('payroll.Net Salary') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payrolls as $key => $payroll)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if ($payroll->staff && $payroll->staff->user)
                                                            {{ $payroll->staff->user->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($payroll->role)
                                                            {{ $payroll->role->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $payroll->payroll_month }} - {{ $payroll->payroll_year }}</td>
                                                    <td>{{ $payroll->basic_salary }}</td>
                                                    <td>{{ $payroll->gross_salary }}</td>
                                                    <td>{{ $payroll->total_earning }}</td>
                                                    <td>{{ $payroll->total_deduction }}</td>
                                                    <td>{{ $payroll->tax }}</td>
                                                    <td>{{ ($payroll->payment_date != null) ? formatDate($payroll->payment_date) : "X"}}</td>
                                                    <td>{{ $payroll->net_salary }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
@endsection
