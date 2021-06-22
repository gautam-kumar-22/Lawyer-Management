@extends('layouts.master', ['title' => 'Todo'])


@section('mainContent')
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <div class="main-title">
                                <h3 class="mb-30">@lang('todo.to_do_list')</h3>
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
                                                id="toDoList">@lang('todo.incomplete')</button>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <button class="primary-btn small tr-bg"
                                                id="toDoListsCompleted">@lang('todo.completed')</button>
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

  @stop
  @push('admin.scripts')
  

  <script>



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

    $(document).ready(function() {
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
    });

    $(document).ready(function() {

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
    });


  </script>
  @endpush