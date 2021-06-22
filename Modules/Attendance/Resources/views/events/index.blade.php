@extends('layouts.master', ['title' => 'Event'])
@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('event.Event')</h1>
                <div class="bc-pages">
                    <a href="{{route('home')}}">@lang('common.Dashboard')</a>
                    <a href="#">@lang('common.Human Resource')</a>
                    <a href="#">@lang('event.Event')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($editData))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{route('events.index')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('event.Add')
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-25">@if(isset($editData))
                                        @lang('event.Edit')
                                    @else
                                        @lang('event.Add')
                                    @endif
                                    @lang('event.Event')
                                </h3>
                            </div>
                            @if(isset($editData))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['events.update', $editData], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'events.store',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label required" for="">{{ __('event.Title') }}
                                                    </label>
                                                <input name="title" id="current_address"
                                                       class="primary_input_field"
                                                       value="{{isset($editData) ? $editData->title : old('title') }}"
                                                       placeholder="{{ __('event.Title') }}" type="text" required>
                                                <span class="text-danger">{{$errors->first('title')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label required" for="">{{ __('event.for_whom') }}
                                                    </label>
                                                <select class="primary_select mb-25" name="for_whom"
                                                        id="employment_type">
                                                    <option
                                                        value="all" {{isset($editData) && $editData->for_whom == 'all' ? 'selected' : ''}}>{{__('event.All')}}</option>
                                                    @foreach($roles as $role)
                                                        <option
                                                            value="{{$role->id}}" {{isset($editData) && $editData->for_whom == $role->name ? 'selected' : ''}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->first('for_whom')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label required" for="">{{ __('event.Location') }}
                                                    </label>
                                                <input name="location" id="current_address"
                                                       class="primary_input_field name"
                                                       placeholder="{{ __('event.Location') }}"
                                                       value="{{isset($editData) ? $editData->location : old('location') }}" type="text"
                                                       required>
                                                <span class="text-danger">{{$errors->first('location')}}</span>
                                            </div>
                                        </div>
                                            <div class="col-xl-12 date_of_joining_div">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label required"
                                                           for="">{{ __('event.Start Date') }}
                                                        </label>
                                                    <div class="primary_datepicker_input">
                                                        <div class="no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="">
                                                                    <input placeholder="Date"
                                                                           class="primary_input_field primary-input date form-control"
                                                                           id="date_of_joining" type="text"
                                                                           name="from_date"
                                                                           value="{{isset($editData)? date('Y-m-d', strtotime($editData->from_date)): date('Y-m-d')}}"
                                                                           autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="start-date-icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">{{$errors->first('from_date')}}</span>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 date_of_joining_div">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label required" for="">{{ __('event.To Date') }}
                                                        </label>
                                                    <div class="primary_datepicker_input">
                                                        <div class="no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="">
                                                                    <input placeholder="Date"
                                                                           class="primary_input_field primary-input date form-control"
                                                                           type="text" name="to_date"
                                                                           value="{{isset($editData)? date('Y-m-d', strtotime($editData->to_date)): date('Y-m-d')}}"
                                                                           autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="start-date-icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">{{$errors->first('from_date')}}</span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label required"
                                                           for="">{{ __('event.Description') }}
                                                        </label>
                                                    <input name="description" id="current_address"
                                                           class="primary_input_field"
                                                           value="{{isset($editData) ? $editData->description : old('description') }}"
                                                           placeholder="{{ __('event.Description') }}" type="text"
                                                           required>
                                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                                    <span class="ti-check"></span>
                                                    @if(isset($editData))
                                                        @lang('common.Update')
                                                    @else
                                                        @lang('common.Save')
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        @if(session()->has('message-success-delete'))
                            <div class="alert alert-success">
                                {{ session()->get('message-success-delete') }}
                            </div>
                        @elseif(session()->has('message-danger-delete'))
                            <div class="alert alert-danger">
                                {{ session()->get('message-danger-delete') }}
                            </div>
                        @endif



                        <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                        <h3 class="mb-0">@lang('event.Event List')</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table SplitDivTable">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                            <table class="table Crm_table_active3">

                                                <thead>
                                                <tr>
                                                    <th>@lang('event.Title')</th>
                                                    <th>@lang('event.for_whom')</th>
                                                    <th>@lang('event.Start Date')</th>
                                                    <th>@lang('event.To Date')</th>
                                                    <th>@lang('event.Location')</th>
                                                    <th>@lang('common.Action')</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(isset($events))
                                                    @foreach($events as $event)
                                                        <tr>

                                                            <td>{{ @$event->title}}</td>
                                                            <td>
                                                            @if($event->for_whom == 'all')

                                                                {{ @$event->for_whom}}
                                                            @else

                                                            {{ $event->role->name  }}
                                                            @endif
                                                                </td>

                                                            <td>{{ $event->from_date }}</td>


                                                            <td>{{$event->to_date}}</td>

                                                            <td>{{ @$event->location}}</td>

                                                            <td>

                                                                <div class="dropdown CRM_dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                            type="button"
                                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        {{__('common.Select')}}
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right"
                                                                         aria-labelledby="dropdownMenu2">
                                                                        <a class="dropdown-item"
                                                                           href="{{route('events.edit',$event->id)}}">@lang('event.Edit')</a>
                                                                        <a onclick="confirm_modal('{{route('events.delete', $event->id)}}')"
                                                                           class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                            </div>
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
    @include('backEnd.partials.delete_modal')
@endsection
