@extends('layouts.master', ['title' => __('setting.Create New Country')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('setting.New Country') }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">


                        {!! Form::open(['route' => 'setup.country.store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}


                        <div class="row">
                            <div class="primary_input col-md-4">
                                {{Form::label('name', __('setting.Country Name'),['class' => 'required'])}}
                                {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('setting.Country Name')])}}
                            </div>
                            <div class="primary_input col-md-4">
                                {{Form::label('code', __('setting.Country code'))}}
                                {{Form::text('code', null, ['class' => 'primary_input_field', 'placeholder' => __('setting.Country code')])}}
                            </div>
                            <div class="primary_input col-md-4">
                                {{Form::label('phonecode', __('setting.Country phone code'))}}
                                {{Form::text('phonecode', null, ['class' => 'primary_input_field', 'placeholder' => __('setting.Country phone code')])}}
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button class="primary-btn semi_large2 fix-gr-bg submit" type="submit"><i
                                    class="ti-check"></i>{{ __('common.Create') }}
                            </button>

                            <button class="primary-btn semi_large2 fix-gr-bg submitting" type="submit" disabled
                                    style="display: none;"><i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                            </button>

                        </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </section>



@stop
@push('admin.scripts')
    <script>
        $(document).ready(function () {
            _formValidation();
        });
    </script>
@endpush
