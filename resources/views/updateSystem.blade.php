@extends('layouts.master')
@section('mainContent')


    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">


            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (!Illuminate\Support\Facades\Config::get('app.app_sync'))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'setting.updateSystem.submit1', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                            @endif
                            <div class="white-box sm_mb_20 sm2_mb_20 md_mb_20 ">
                                <div class="main-title">
                                    <h3 class="mb-30">@lang('setting.Upload From Local Directory')</h3>
                                </div>
                                <div class="add-visitor">

                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control {{ $errors->has('content_file') ? ' is-invalid' : '' }}"
                                                    readonly="true" type="text"
                                                    placeholder="{{isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):trans('common.Browse')}} "
                                                    id="placeholderUploadContent" name="content_file">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('content_file'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('content_file') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_content_file">@lang('common.Browse')</label>
                                                <input type="file" class="d-none form-control" name="updateFile"
                                                       required
                                                       id="upload_content_file">
                                            </button>

                                        </div>
                                    </div>
                                    @php
                                        $tooltip = "";

                                if (permissionCheck('setting.updateSystem.submit')){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                if (Illuminate\Support\Facades\Config::get('app.app_sync')){
                                    $tooltip =trans('For the demo version, you cannot change this');
                                }
                                    @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                    title="{{@$tooltip}}">
                                                <span class="ti-check"></span>
                                                @if(isset($session))
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
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class="main-title">
                                    <h3 class="mb-30">{{__('setting.About System')}}</h3>
                                </div>
                                <div class="add-visitor">
                                    <table style="width:100%; box-shadow: none;"
                                           class="display school-table school-table-style">

                                        <tr>
                                            <td>{{__('setting.Software Version')}}</td>
                                            <td>{{ config('configs')->where('key','system_version')->first()->value }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('setting.Check update')}}</td>
                                            <td><a href="https://codecanyon.net/user/codethemes/portfolio"
                                                   target="_blank"> <i
                                                        class="ti-new-window"> </i> {{__('setting.Update')}} </a></td>
                                        </tr>
                                        <tr>
                                            <td> {{__('setting.PHP Version')}}</td>
                                            <td>{{phpversion() }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('setting.Curl Enable')}}</td>
                                            <td>@php
                                                    if  (in_array  ('curl', get_loaded_extensions())) {
                                                        echo 'enable';
                                                    }
                                                    else {
                                                        echo 'disable';
                                                    }
                                                @endphp</td>
                                        </tr>


                                        <tr>
                                            <td>{{__('setting.Purchase code')}}</td>
                                            <td>{{__('Verified')}}

                                                @if(!env('APP_SYNC'))

                                                    @if(auth()->user()->role_id == 1)
                                                        @includeIf('service::license.revoke')
                                                    @endif

                                                @else
                                                    <button data-toggle="tooltip" title="Restricted in demo mode" class="primary-btn small fix-gr-bg ml-2">
                                                        Revoke License
                                                    </button>
                                                @endif

                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__('setting.Install Domain')}}</td>
                                            <td>{{ config('configs')->where('key','system_domain')->first()->value }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('setting.System Activated Date')}}</td>
                                            <td>{{ config('configs')->where('key','system_activated_date')->first()->value }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection




