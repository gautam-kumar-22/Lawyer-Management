@extends('backEnd.master')
@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-4 holiday_setup mt-30">
                    <h3 class="mb-0 mr-30  ">{{ __('holiday.Holiday Setup') }}
                        @if(permissionCheck('holiday.add'))
                            <a href="#" data-toggle="modal" data-target="#year_add"
                               class="primary-btn small fix-gr-bg text-uppercase mb-2 bord-rad float-right">
                                {{__('common.Add')}} <span class="ti-plus"></span>
                            </a>
                        @endif

                    </h3>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <!-- table-responsivaae -->
                            <div class="">
                                @include('leave::holiday_setup.components.table')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-30">

                    @if(isset($edit))
                     @if(permissionCheck('year.data'))
                        <div class="white_box">
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label">{{ __('holiday.Holiday Copy From') }}</label>
                                        <select name="year" onchange="lastYearData()" class="primary_select last_year">
                                            @isset($holiday)
                                                @foreach($years->where('year','!=',$holiday->year) as $year)
                                                    <option value="{{$year->year}}">{{$year->year}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <span class="text-danger">{{$errors->first('year')}}</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form class="" action="{{ route('holidays.store') }}" method="POST">@csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for="">{{ __('attendance.Select Year') }}</label>
                                            <input type="text" name="year" class="primary_input_field"
                                                   value="{{isset($holiday) ? $holiday->year : ''}}">

                                            <span class="text-danger">{{$errors->first('year')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-borderless">
                                    <tbody class="holiday_table">
                                    @include('leave::holiday_setup.components.row')
                                    @if (session()->has('holidays'))
                                        @include('leave::holiday_setup.components.session')
                                    @else
                                        @include('leave::holiday_setup.components.edit')
                                    @endif
                                    </tbody>
                                </table>
                                <div class="row justify-content-center mt-2">
                                    <button type="submit"
                                            class="primary-btn btn-sm fix-gr-bg">{{__('holiday.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                        @endif
                    @else
                    @if(permissionCheck('holidays.index'))
                        @if($holiday)
                            @include('leave::holiday_setup.components.view')
                        @endif
                        @endif
                    @endif

                </div>
            </div>

        </div>

        <div class="modal fade admin-query" id="year_add">
            <div class="modal-dialog modal_800px modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('holiday.Add New Year') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" action="{{route('holiday.add')}}" method="post">@csrf
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('holiday.Year') }} *</label>
                                        <input name="year" class="primary_input_field"
                                               placeholder="{{ __('holiday.Year') }}"
                                               type="text" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large2 fix-gr-bg"><i
                                                class="ti-check"></i>
                                            {{ __('common.Save') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backEnd.partials.delete_modal')

@endsection
@push('scripts')
    <script>
        function addRow() {
            $('.holiday_table tr:last').after(`<tr class="add_row">
        <td>
            <div class="primary_input mb-15">
                <label class="primary_input_label"
                       for="">{{__('holiday.Holiday Name')}}</label>
                <input type="text" name="holiday_name[]" class="primary_input_field"
                       placeholder="{{__('holiday.Holiday Name')}}">
            </div>
        </td>
        <td>
            <div class="primary_input mb-15">
                <label class="primary_input_label"
                       for="">{{__('holiday.Select Type')}} *</label>
                <select class="primary_select mb-15 type" name="type[]">
                    <option value="0">{{__('holiday.Single Day')}}</option>
                    <option value="1">{{__('holiday.Multiple Day')}}</option>
                </select>
            </div>
        </td>
        <td>
            <div class="single_date">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="">{{ __('sale.Date') }}
            *</label>
        <div class="primary_datepicker_input">
            <div class="no-gutters input-right-icon">
                <div class="col">
                    <div class="">
                        <input placeholder="Date"
                               class="primary_input_field primary-input date form-control"
                               type="text" name="date[]"
                               value="{{date('Y-m-d')}}" autocomplete="off">
                                </div>
                            </div>
                            <button class="" type="button">
                                <i class="ti-calendar"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="multiple_date" style="display: none">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="">{{ __('holiday.Start Date') }}
            *</label>
        <div class="primary_datepicker_input">
            <div class="no-gutters input-right-icon">
                <div class="col">
                    <div class="">
                        <input placeholder="Date"
                               class="primary_input_field primary-input date form-control"
                               type="text" name="start_date[]"
                               value="{{date('Y-m-d')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <button class="" type="button">
                                <i class="ti-calendar"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="">{{ __('holiday.End Date') }}
            *</label>
        <div class="primary_datepicker_input">
            <div class="no-gutters input-right-icon">
                <div class="col">
                    <div class="">
                        <input placeholder="Date"
                               class="primary_input_field primary-input date form-control"
                               type="text" name="end_date[]"
                               value="{{date('Y-m-d')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <button class="" type="button">
                                <i class="ti-calendar"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <a class="primary-btn primary-circle mt-30 delete_row fix-gr-bg"
               href="javascript:void(0)"> <i
                    class="ti-trash"></i></a>
        </td>
    </tr>`)
            $('select').niceSelect();
            $(".date").datepicker({
                format : 'yyyy-mm-dd',
                todayHighlight : true,
                autoclose : true,
            });

        }

        function changeYear() {
            let year = $('.year').val();

            $.ajax({
                url: "{{route('add.row')}}",
                method: "POST",
                data: {
                    year: year,
                    _token: "{{csrf_token()}}",
                },
                success: function (result) {
                    $(".add_row").each(function (index, element) {
                        element.remove();
                    });
                    $(".holiday_table").append(result);
                    $('select').niceSelect();
                }
            })
        }

        function lastYearData() {
            let year = $('.last_year').val();

            $.ajax({
                url: "{{route('last.year.data')}}",
                method: "POST",
                data: {
                    year: year,
                    _token: "{{csrf_token()}}",
                },
                success: function (result) {
                    $(".holiday_table").append(result);
                    $('select').niceSelect();
                }
            })
        }

        $(document).on('change', '.type', function () {
            let value = $(this).val();
            var whichtr = $(this).closest("tr");
            if (value == 0) {
                whichtr.find($('.single_date')).show();
                whichtr.find($('.multiple_date')).hide();
            } else {
                whichtr.find($('.single_date')).hide();
                whichtr.find($('.multiple_date')).show();
            }
        });

        $(document).on('click', '.delete_row', function () {
            var whichtr = $(this).closest("tr");
            whichtr.remove();
        });
    </script>
@endpush
