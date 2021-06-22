@extends('layouts.master', ['title' => __('case.Update Put Up')])

@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">Edit Put Up</h3>
                      
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
        {!! Form::model($model, ['route' => ['putlist.update', $model->id], 'class' =>
                'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT']) !!}
        <div class="row">
          <div class="primary_input col-md-12">
            {{Form::hidden('case', $case)}}
            {{Form::label('hearing_date', __('case.Put Up Date'),['class' => 'required'])}}
            {{Form::text('hearing_date', $model->date, ['required'=>'','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Put Up Date')])}}
          </div>
        </div>
        <div class="primary_input">
          {{Form::label('description', __('case.Put Up Order'),['class' => 'required'])}}
          {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('case.Put Up Order'),'required', 'rows' => 5, 'data-parsley-errors-container' =>
          '#description_error'])}}
          <span id="description_error"></span>
        </div>
        <div class="text-center mt-3">
        <button class="primary-btn semi_large2 fix-gr-bg submit" type="submit"><i class="ti-check"></i>{{ __('common.Update') }}
          </button>

          <button class="primary-btn semi_large2 fix-gr-bg submitting" type="submit" disabled style="display: none;"><i class="ti-check"></i>{{ __('common.Updating') . '...' }}
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