@extends('layouts.master')

@section('mainContent')
<div class="container-fluid p-0">
        @if(permissionCheck('dashboard_quick_summery.index'))

            <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-0">{{__('dashboard.Quick Summery')}} </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="{{route('client.index')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Client')}} </h3>
                                <p class="mb-0">{{__('dashboard.Total Client')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Client::all()->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{route('lawyer.index')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Lawyer')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Lawyer')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Lawyer::all()->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{route('contact.index')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Contact')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Contact')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Contact::all()->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{route('case.index')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Running Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Running Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where('status', 'Open')->where('judgement_status', '=', 'Open')->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{route('case.index', ['status' => 'Waiting'])}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Waiting Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Waiting Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where('hearing_date', '<', date('Y-m-d'))->where('status', 'Open')->where('judgement_status', '=', 'Open')->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{route('case.index', ['status' => 'Archieved'])}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Closed Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Closed Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where('judgement_status', 'Close')->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6">
                <a href="{{route('case.index', ['status' => 'Archieved'])}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Staff')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Staff')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Staff::count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-lg-3 col-md-6">
                <a href="{{route('case.index', ['status' => 'Archieved'])}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Pending Task')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Pending task')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{Modules\Task\Entities\Task::where('status', 0)->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        @endif


        <div class="row mt-40">
         @if(permissionCheck('dashboad_calender.index'))
                <div class="col-lg-{{ permissionCheck('dashboad_calender.index') ? 7 : 12 }}">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="main-title">
                            <h3 class="mb-20">{{__('common.Calendar')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="white-box">
                    <div class='common-calendar'>
                    </div>
                </div>
            </div>
            @endif
 @if(permissionCheck('dashboard_todo.index'))
                 <div class="col-{{ permissionCheck('dashboard_todo.index') ? 5 : 6 }}">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <div class="main-title">
                                <h3 class="mb-25">@lang('todo.To Do List')</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 text-right">
                            <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg"
                               data-target="#add_to_do"
                               title="Add To Do" data-modal-size="modal-md">
                                <span class="ti-plus pr-2"></span>
                                @lang('event.Add')
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box school-table">
                                <div class="row to-do-list mb-20">
                                    <div class="col-md-6 col-6">
                                        <button class="primary-btn small fix-gr-bg"
                                                id="toDoList">@lang('todo.Incomplete')</button>
                                    </div>
                                    <div class="col-md-6 col-6 text-right">
                                        <button class="primary-btn small tr-bg"
                                                id="toDoListsCompleted">@lang('todo.Completed')</button>
                                    </div>
                                </div>

                                <input type="hidden" id="url" value="{{url('/')}}">


                                <div class="toDoList">
                                    @if(count(@$toDos->where('status',0)) > 0)

                                        @foreach($toDos->where('status',0) as $toDoList)
                                            <div class="single-to-do d-flex justify-content-between toDoList"
                                                 id="to_do_list_div{{@$toDoList->id}}">
                                                <div>
                                                    <input type="checkbox" id="midterm{{@$toDoList->id}}"
                                                           class="common-checkbox complete_task" name="complete_task"
                                                           value="{{@$toDoList->id}}">

                                                    <label for="midterm{{@$toDoList->id}}">

                                                        <input type="hidden" id="id" value="{{@$toDoList->id}}">
                                                        <input type="hidden" id="url" value="{{url('/')}}">
                                                        <h5 class="d-inline">{{@$toDoList->title}}</h5>
                                                        <p class="ml-35">

                                                            {{$toDoList->date }}

                                                        </p>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="single-to-do d-flex justify-content-between">
                                            @lang('todo.no_do_lists_assigned_yet')
                                        </div>

                                    @endif
                                </div>


                                <div class="toDoListsCompleted">
                                    @if(count(@$toDos->where('status',1))>0)

                                        @foreach($toDos->where('status',1) as $toDoListsCompleted)

                                            <div class="single-to-do d-flex justify-content-between"
                                                 id="to_do_list_div{{@$toDoListsCompleted->id}}">
                                                <div>
                                                    <h5 class="d-inline">{{@$toDoListsCompleted->title}}</h5>
                                                    <p class="">

                                                        {{@$toDoListsCompleted->date }}

                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="single-to-do d-flex justify-content-between">
                                            @lang('todo.no_do_lists_assigned_yet')
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

@endif
        </div>


        <div class="row mt-40">

            @if(permissionCheck('dashboard_appointment.index'))
 <div class="col-lg-6 col-md-6">

                    <div class="white_box_30px mb_30">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('dashboard.Appointment')}}</h3>
                            </div>
                        </div>


                        <div class="QA_section3 QA_section_heading_custom th_padding_l0 ">
                            <div class="QA_table">
                                <!-- table-responsive -->
                                <div class="table-responsive">
                                <table class="table pt-0 shadow_none pb-0 ">
                                        <tbody>
                                            <tr>
                                                <th>{{__('dashboard.Title')}}</th>
                                                <th>{{__('dashboard.Date')}}</th>
                                                <th>{{__('dashboard.Contact')}}</th>
                                            </tr>

                                            @foreach($appointments as $appointment)
                                             <tr>
                                                <td><a href="{{ route('appointment.show', $appointment->id) }}">{{ $appointment->title }}</a></td>
                                                <td>{{ formatDate($appointment->date) }}</td>
                                                <td>{{ $appointment->contact->name }}</td>
                                            </tr>
                                            @endforeach

                                       </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif



@if(permissionCheck('dashboard_appointment.index'))
                <div class="col-lg-6 col-md-6">

                    <div class="white_box_30px mb_30">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('dashboard.Upcomming Date')}}</h3>
                            </div>
                        </div>


                        <div class="QA_section3 QA_section_heading_custom th_padding_l0 ">
                            <div class="QA_table">
                                <!-- table-responsive -->
                                <div class="table-responsive">
                                <table class="table pt-0 shadow_none pb-0 ">
                                        <tbody>
                                        <tr>
                                            <th>{{__('dashboard.Case Name')}}</th>
                                            <th>{{__('dashboard.Date')}}</th>
                                        </tr>
                                        @foreach($upcommingdate as $date)
                                             <tr>
                                                <td><a href="{{ route('case.show', $date->id) }}">{{ $date->title }}</a></td>
                                                <td>{{ formatDate($date->date) }}</td>
                                            </tr>
                                              @endforeach
                                       </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif



        </div>


        @if(permissionCheck('dashboard_upcoming_date.index'))
            <div class="modal fade admin-query" id="add_to_do">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{trans('todo.Add To Do')}}</h4>
                            <button type="button" class="close" data-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'to_dos.store',
                                'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()']) }}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row mt-25">
                                            <div class="col-lg-12" id="sibling_class_div">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                           for="">{{__('common.Title')}}*</label>
                                                    <input type="text" class="primary_input_field"
                                                           placeholder="{{__('common.Title')}}" name="title"
                                                           value="{{ old('title') }}">
                                                    <span class="text-danger">{{$errors->first('title')}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-30">
                                            <div class="col-lg-12" id="">
                                                <label class="primary_input_label" for="">{{ __('common.Date') }} *</label>
                                            <div class="primary_datepicker_input">
                                                <div class="no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="">
                                                            <input placeholder="Date"
                                                                   class="primary_input_field primary-input date form-control"
                                                                   id="startDate" type="text" name="date"
                                                                   value="" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <button class="" type="button">
                                                        <i class="ti-calendar" id="start-date-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 text-center">
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg"
                                                        data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                <input class="primary-btn fix-gr-bg" type="submit" value="save">
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

</div>


@endsection

@push('admin.scripts')
<script type="text/javascript" src="{{asset('public/backEnd/vendors/js/fullcalendar.min.js')}}"></script>
    <script>

        setTimeout(function () {
            $('#yearly').fadeOut(500);
            $('#weekly_profit').fadeOut(500);
            $('#monthly_profit').fadeOut(500);
            $('#yearly_profit').fadeOut(500);
            $('.purchase_table').fadeOut(500);
        }, 1000);

        if ($('.common-calendar').length) {
            $('.common-calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function (event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);

                    $('#image').attr('src', event.url);
                    $('#fullCalModal').modal();
                    return false;
                },
                height: 650,
                events: <?php echo json_encode($calendar_events);?> ,
            });
        }

        $(document).on('click', '.filtering', function () {
            $('.filtering').removeClass('active');
            $(this).addClass('active');
            let type = $(this).data('type');
            $('.gradient-color2').hide();
            $('.demo_wait').show();
            $.ajax({
                method: "POST",
                url: "{{url('dashboard-cards-info')}}" + "/" + type,
                success: function (data) {
                    $('.total_purchase').text(data.purchase_amount);
                    $('.total_sale').text(data.sale_amount);
                    $('.expenses').text(data.expense);
                    $('.purchase_due').text(data.purchase_due);
                    $('.invoice_due').text(data.sale_due);
                    $('.total_bank').text(data.bank);
                    $('.total_cash').text(data.cash);
                    $('.total_income').text(data.income);
                    $('.gradient-color2').show();
                    $('.demo_wait').hide();
                }
            })
        });





$(".complete_task").on("click", function() {
        var url = $("#url").val();
        var id = $(this).val();
        var formData = {
            id: $(this).val(),
        };

        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "complete-to-do",
            success: function(data) {


                setTimeout(function() {
                    toastr.success(
                        "Operation Success!",
                        "Success Alert", {
                            iconClass: "customer-info",
                        }, {
                            timeOut: 2000,
                        }
                    );
                }, 500);

                $("#to_do_list_div" + id + "").remove();

                $("#toDoListsCompleted").children("div").remove();
            },
            error: function(data) {

            },
        });
    });


    $(document).ready(function() {
        $(".toDoListsCompleted").hide();
    });

        $("#toDoList").on("click", function(e) {
            e.preventDefault();

            if ($(this).hasClass("tr-bg")) {
                $(this).removeClass("tr-bg");
                $(this).addClass("fix-gr-bg");
            }

            if ($("#toDoListsCompleted").hasClass("fix-gr-bg")) {
                $("#toDoListsCompleted").removeClass("fix-gr-bg");
                $("#toDoListsCompleted").addClass("tr-bg");
            }

            $(".toDoList").show();
            $(".toDoListsCompleted").hide();
        });


        $("#toDoListsCompleted").on("click", function(e) {
            e.preventDefault();

            if ($(this).hasClass("tr-bg")) {
                $(this).removeClass("tr-bg");
                $(this).addClass("fix-gr-bg");
            }

            if ($("#toDoList").hasClass("fix-gr-bg")) {
                $("#toDoList").removeClass("fix-gr-bg");
                $("#toDoList").addClass("tr-bg");
            }

            $(".toDoList").hide();
            $(".toDoListsCompleted").show();

            var formData = {
                id: 0,
            };

            var url = $("#url").val();

            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: url + "/" + "get-to-do-list",
                success: function(data) {
                    $(".toDoListsCompleted").empty();

                    $.each(data, function(i, value) {
                        var appendRow = "";

                        appendRow +=
                            "<div class='single-to-do d-flex justify-content-between'>";
                        appendRow += "<div>";
                        appendRow += "<h5 class='d-inline'>" + value.title + "</h5>";
                        appendRow += "<p>" + value.date + "</p>";
                        appendRow += "</div>";
                        appendRow += "</div>";

                        $(".toDoListsCompleted").append(appendRow);
                    });
                },
                error: function(data) {

                },
            });
        });

    </script>
@endpush
