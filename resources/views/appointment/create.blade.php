@extends('layouts.master', ['title' => __('appointment.Create New Appointment')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('appointment.Create Appointment')}}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    {!! Form::open(['route' => 'appointment.store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}
                              <div class="row">
                                <div class="primary_input col-md-12">
                                    {{Form::label('title', __('appointment.Title'),['class' => 'required'])}}
                                  {{Form::text('title', null, ['required' => '','class' => 'primary_input_field', 'placeholder' => __('appointment.Title')])}}
                                </div>
                              </div>
                              <div class="row">
                                <div class="primary_input col-md-6">
                                    {{Form::label('contact_id', __('appointment.Contact'), ['class' => 'required'])}}
                                  {{Form::select('contact_id', $contacts, null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#contact_id_error'])}}
                                  <span id="contact_id_error"></span>
                                </div>

                                <div class="primary_input col-md-6">
                                  {{Form::label('date', __('appointment.Appointment Date'),['class' => 'required'])}}
                                  {{Form::text('date', date('Y-m-d'), ['required' => '','class' => 'primary_input_field primary-input date form-control date', "id"=>"fromDate",'placeholder' => __('appointment.Date')])}}
                                 </div>
                              </div>
                              <div class="primary_input">
                                {{Form::label('motive', __('appointment.Motive'),['class' => 'required'])}}
                                {{Form::textarea('motive', null, ['required' => '','class' => 'primary_input_field', 'placeholder' => __('appointment.Appointment Motive'), 'rows' => 5, 'data-parsley-errors-container' =>
                                '#motive_error' ])}}
                                <span id="motive_error"></span>
                              </div>

                              <div class="primary_input">
                                {{Form::label('notes', __('appointment.Notes'))}}
                                {{Form::textarea('notes', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('appointment.Appointment Notes'), 'rows' => 5, 'data-parsley-errors-container' =>
                                '#notes_error' ])}}
                                <span id="notes_error"></span>
                              </div>

                              <div class="text-center mt-3">
                              <button class="primary_btn_large submit" type="submit"><i class="ti-check"></i>{{ __('common.Create') }}
                              </button>

                              <button class="primary_btn_large submitting" type="submit" disabled style="display: none;"><i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                              </button>
                              </div>
                              {!! Form::close() !!}
                       
                    </div>
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