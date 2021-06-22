@extends('layouts.master', ['title' => __('setting.Create New State')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('setting.New State') }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">


                        {!! Form::open(['route' => 'setup.state.store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}


                        <div class="row">
                            <div class="primary_input col-md-6">
                                {{Form::label('country_id', __('court.Country'), ['class' => 'required'])}}
                                {{Form::select('country_id', $countries, $country_id, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('court.Select country'),  'data-parsley-errors-container' => '#country_id_error', 'required'])}}
                                <span id="country_id_error"></span>
                            </div>
                            <div class="primary_input col-md-6">
                                {{Form::label('name', __('setting.State Name'),['class' => 'required'])}}
                                {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('setting.State Name')])}}
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
