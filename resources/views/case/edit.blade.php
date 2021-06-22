@extends('layouts.master', ['title' => __('case.Update Case')])

@section('mainContent')
<!-- Vertical form options -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('case.Update Case') }}</h3>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                {!! Form::model($model, ['route' => ['case.update', $model->id], 'class' =>
                'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT']) !!}
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('case_category_id', __('case.Case Category'), ['class' => 'required'])}}
                    {{Form::select('case_category_id', $data['case_categories'], null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Case Category'),  'data-parsley-errors-container' => '#case_category_id_error'])}}
                    <span id="case_category_id_error"></span>
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('case_no', __('case.Case No'))}}
                    {{Form::text('case_no', null, ['class' => 'primary_input_field', 'placeholder' => __('case.Case No')])}}
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('file_no', __('case.Case File No'))}}
                    {{Form::text('file_no', null, ['class' => 'primary_input_field', 'placeholder' => __('case.Case File No')])}}
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('acts', __('case.Case Acts'), ['class' => 'required'])}}
                    {{Form::select('acts[]', $data['acts'], $data['selected_acts'], ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Acts'),  'data-parsley-errors-container' => '#act_error', 'multiple' => '', 'id' => 'acts'])}}
                    <span id="act_error"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    <div class="row">
                      <div class="primary_input col-md-6">
                        {{Form::label('plaintiff', __('case.Plaintiff'), ['class' => 'required'])}}
                        {{Form::select('plaintiff', $data['clients']->prepend(__('case.Select Plaintiff'), ''), null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Plaintiff'), 'data-parsley-errors-container' => '#plaintiff_error'])}}
                        <span id="plaintiff_error"></span>
                      </div>
                      <div class="primary_input col-md-6">
                        {{Form::label('opposite', __('case.Accuesed'), ['class' => 'required'])}}
                        {{Form::select('opposite', $data['clients']->prepend(__('case.Select Accuesed'), ''), null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Accuesed'), 'data-parsley-errors-container' => '#opposite_error'])}}
                        <span id="opposite_error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('client_category_id', __('case.On Behalf Of'),['class' => 'required'])}}
                    {{Form::select('client_category_id', $data['client_categories'], null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select On Behalf Of'), 'data-parsley-errors-container' => '#client_category_id_error'])}}
                    <span id="client_category_id_error"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('court_category_id', __('case.Court Category'), ['class' => 'required'])}}
                    {{Form::select('court_category_id', $data['court_categories'], null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Court Category'),  'data-parsley-errors-container' => '#court_category_id_error'])}}
                    <span id="court_category_id_error"></span>
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('court_id', __('case.Court'), ['class' => 'required'])}}
                    {{Form::select('court_id', $data['courts'], null, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select Court'),  'data-parsley-errors-container' => '#court_id_error'])}}
                    <span id="court_id_error"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('ref_name', __('case.Reference Name'))}}
                    {{Form::text('ref_name', null, ['class' => 'primary_input_field', 'placeholder' => __('case.Reference Name')])}}
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('ref_mobile', __('case.Reference Mobile'))}}
                    {{Form::text('ref_mobile', null, ['class' => 'primary_input_field', 'placeholder' => __('case.Reference Mobile')])}}
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('lawyer_id', __('case.Lawyer'))}}
                    {{Form::select('lawyer_id', $data['lawyers'], null, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Lawyer'),  'data-parsley-errors-container' => '#lawyer_id_error'])}}
                    <span id="lawyer_id_error"></span>
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('stage_id', __('case.Case Stage'))}}
                    {{Form::select('stage_id', $data['stages'], null, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Case Stage'),  'data-parsley-errors-container' => '#stage_id_error'])}}
                    <span id="stage_id_error"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="primary_input col-md-6">
                    {{Form::label('receiving_date', __('case.Receiving Date'))}}
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="receiving_date_yes" id="receiving_date_yes" {{ $model->receiving_date ? 'checked' : '' }}>
                        {{ __('case.Add Receive Date') }}
                      </label>
                    </div>
                    {{Form::text('receiving_date', null, ['style' => (!$model->receiving_date ? 'display:none;' : ''),'class' => 'primary_input_field primary-input date form-control date', "id"=>"receiving_date",'placeholder' => __('case.Date')])}}
                  </div>
                  <div class="primary_input col-md-6">
                    {{Form::label('filling_date', __('case.Filing Date'))}}
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="filling_date_yes" id="filling_date_yes" {{ $model->filling_date ? 'checked' : '' }}>
                        {{ __('case.Add Filing Date') }}
                      </label>
                    </div>
                    {{Form::text('filling_date', null,['style' => (!$model->filling_date ? 'display:none;' : ''),'class' => 'primary_input_field primary-input date form-control date', "id"=>"filling_date",'placeholder' => __('case.Date')])}}
                  </div>
                </div>

                <div class="primary_input">
                  {{Form::label('description', 'Description')}}
                  {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('case.Case Description'), 'rows' => 5, 'data-parsley-errors-container' =>
                  '#description_error' ])}}
                  <span id="description_error"></span>
                </div>

                <div class="text-center mt-5">
                
                <button class="primary_btn_large submit" type="submit"><i class="ti-check"></i>{{ __('common.Update') }}
                    </button>

                    <button class="primary_btn_large submitting" type="submit" disabled style="display: none;"><i class="ti-check"></i>{{ __('common.Updating') . '...' }}
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
$(document).ready(function() {
    _componentAjaxChildLoad('#content_form','#court_category_id','#court_id','court');
    _formValidation();
    $(document).on('click', '#filling_date_yes', function() {
        if (this.checked) {
            $('#filling_date').show();
        } else {
            $('#filling_date').hide();
        }
    });
    $(document).on('click', '#receiving_date_yes', function() {
        if (this.checked) {
            $('#receiving_date').show();
        } else {
            $('#receiving_date').hide();
        }
    });
});
</script>
@endpush