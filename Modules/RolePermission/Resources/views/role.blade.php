@extends('layouts.master', ['title' =>'Role'])
@section('mainContent')


<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                @if(isset($role))
                                    @lang('common.Edit')
                                @else
                                    @lang('common.Add')
                                @endif
                                    @lang('role.Role')
                            </h3>
                        </div>
                        @if(isset($role))
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => route('permission.roles.update',$role->id),'method' => 'PUT']) }}
                        @else
                        {{ Form::open(['class' => 'form-horizontal', 'url' => route('permission.roles.store')]) }}
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success') }}
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger') }}
                                        </div>
                                        @endif
                                        <div class="input-effect">
                                            <label>@lang('role.Name') <span>*</span></label>
                                            <input class="primary_input_field form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($role)? @$role->name: ''}}" required="1">
                                            <input type="hidden" name="id" value="{{isset($role)? @$role->id: ''}}">
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect d-none">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('role.Type') }} *</label>
                                                <select class="primary_select mb-25" name="type" id="type" required>
                                                    @isset($role)
                                                        <option value="system_user"@if ($role->type == "system_user") selected @endif>{{ __('role.System User') }}</option>
                                                        <option value="regular_user"@if ($role->type == "regular_user") selected @endif>{{ __('role.Regular User') }}</option>
                                                    @else
                                                        <option value="system_user">{{ __('role.System User') }}</option>
                                                        <option value="regular_user" selected>{{ __('role.Regular User') }}</option>
                                                    @endisset
                                                </select>
                                                @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $tooltip = "";
                                   
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        @if(permissionCheck('permission.roles.edit') || permissionCheck('permission.roles.store'))
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{@$tooltip}}">
                                            <span class="ti-check"></span>
                                            {{!isset($role)? 'save' : 'update'}}

                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('common.Role') @lang('common.List')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="QA_section QA_section_heading_custom check_box_table SplitDivTable">
                            <div class="QA_table ">
                                <!-- table-responsive -->
                                <div class="mt-30">
                                <table class="table Crm_table_active3">
                                        <thead>
                                           @include('backEnd.partials.alertMessagePageLevelAll')
                                            <tr>
                                                <th width="30%">@lang('role.Role')</th>
                                                <th width="30%">@lang('role.Type')</th>
                                                <th width="40%">@lang('role.Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($RoleList as $role)
                                            <tr>
                                                <td>{{@$role->name}}</td>
                                                <td>{{str_replace('_', ' ', @$role->type)}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <div class="dropdown CRM_dropdown d-inline ml-1">
                                                        <button class="btn btn-secondary dropdown-toggle mb-1" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            @if ($role->id > 2)
                                                                @if(permissionCheck('permission.roles.edit'))
                                                                <a href="{{ route('permission.roles.edit',$role->id) }}" class="dropdown-item" type="button">@lang('common.Edit')</a>
                                                                @endif

                                                                @if(permissionCheck('permission.roles.destroy'))
                                                                <a href="#"  class="dropdown-item"  type="button" data-toggle="modal" href="#" data-id="{{@$role->id}}" data-target="#deleteItem_{{@$role->id}}">@lang('role.Delete')</a>
                                                                @endif
                                                            @else
                                                                <a href="javascript:void(0)" class="dropdown-item"> @lang('role.System Role') </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- shortby  -->
                                                    @if(@$role->id != 1)
                                                        <a href="{{ route('permission.permissions.index', [ 'id' => @$role->id])}}" class="ml-1"   >
                                                            <button type="button" class="primary-btn small fix-gr-bg"> @lang('role.assign_permission') </button>
                                                        </a>
                                                    @endif
                                                    </div>
                                                    
                                                </td>
                                                {{-- Error modal message --}}
                                                @include('backEnd.partials.deleteModalMessage',[
                                                    'item_id' => @$role->id,
                                                    'item_name' => 'Role',
                                                    'route_url' => route('permission.roles.destroy',$role->id)])
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
        </div>
    </div>
</section>
@endsection
