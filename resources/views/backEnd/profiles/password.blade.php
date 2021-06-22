@extends('backEnd.master')
@section('mainContent')
    <section class="mb-40 student-details">
        @if(session()->has('message-success'))
            <div class="alert alert-success">
                {{ session()->get('message-success') }}
            </div>
        @elseif(session()->has('message-danger'))
            <div class="alert alert-danger">
                {{ session()->get('message-danger') }}
            </div>
        @endif
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.Change Password')}}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::open(['route' => 'change_password']) !!}
                        <div class="row form">
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="current_password">{{ __('common.Current Password') }} * </label>
                                    <input name="current_password" class="primary_input_field name"
                                           placeholder="{{ __('common.Current Password') }}" type="password"  id="current_password" required>
                                    @if ($errors->has('current_password'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Password') }} ({{trans('Minimum 8 Letter')}}) * </label>
                                    <input name="password" class="primary_input_field name"
                                           placeholder="{{ __('common.Password') }}" type="password" minlength="8" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Re-Password') }} ({{trans('Minimum 8 Letter')}}) *</label>
                                    <input name="password_confirmation" class="primary_input_field name"
                                           placeholder="{{ __('common.Re-Password') }}" type="password" minlength="6" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="submit_btn text-center ">
                                    <button class="primary-btn semi_large2 fix-gr-bg" type="submit"><i
                                            class="ti-check"></i>{{__('common.Change Password')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </section>



@endsection

