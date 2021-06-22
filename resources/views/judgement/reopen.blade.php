@extends('layouts.master', ['title' => __('case.Re-open Case')])
@section('mainContent')
<!-- Vertical form options -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('Re-open Case')}}</h3>

                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">


                {!! Form::open(['route' => 'judgement.reopen_store', 'class' => 'form-validate-jquery', 'id' => 'content_form',
                'files' => false, 'method' => 'POST']) !!}
                <div class="row">
                    <div class="primary_input col-md-12">
                        {{Form::hidden('case', $case)}}
                        {{Form::label('judgement_date', __('case.Re-open Date'), ['class' => 'required'])}}
                        {{Form::text('judgement_date', $model->judgement_date, ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Re-open Date')])}}
                    </div>
                </div>
                <div class="primary_input">
                    {{Form::label('judgement',  __('case.Re-open Description'))}}
                    {{Form::textarea('judgement', $model->description, ['class' => 'primary_input_field summernote', 'placeholder' => __('case.Re-open Description'), 'rows' => 5, 'data-parsley-errors-container' => '#judgement_error' ])}}
                    <span id="judgement_error"></span>
                </div>
                        @includeIf('case.file')
                <div class="text-center mt-3">
                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="submit" value="submit">{{ __
                        ('common.Update')
                        }}</button>
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
