@extends('layouts.master', ['title' => __('case.Judgement')])

@section('mainContent')
<!-- Vertical form options -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('case.Add Judgement')}}</h3>

                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
        {!! Form::open(['route' => 'judgement.store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}
        <div class="row">
          <div class="primary_input col-md-12">
            {{Form::hidden('case', $case)}}
            {{Form::label('judgement_date', __('case.Judgement Date'), ['class' => 'required'])}}
            {{Form::text('judgement_date', date('Y-m-d'), ['class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Judgement Date')])}}
          </div>
        </div>
        <div class="primary_input">
          {{Form::label('judgement', __('case.Judgement'), ['class' => 'required'])}}
          {{Form::textarea('judgement', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('case.Judgement'), 'rows' => 5, 'required', 'data-parsley-errors-container' => '#judgement_error' ])}}
          <span id="judgement_error"></span>
        </div>
                        @includeIf('case.file')
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

</section>
@stop
@push('admin.scripts')

<script>
$(document).ready(function () {
  _formValidation();
});
</script>
@endpush
