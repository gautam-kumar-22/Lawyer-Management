@extends('layouts.master', ['title' => __('case.Court Change')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('case.Court Change') }}</h3>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                {!! Form::open(['route' => 'case.court.store', 'class' => 'form-validate-jquery', 'id' =>
                'content_form',
                'files' => false, 'method' => 'POST']) !!}
                <div class="row">
                    <div class="primary_input col-md-6">
                        {{Form::hidden('id', $model->id)}}
                        {{Form::label('date', __('case.Change Date'))}}

                        {{Form::text('date', date('Y-m-d'), ['class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Change Date')])}}
                    </div>
                    <div class="primary_input col-md-6">
                        {{Form::label('court', __('case.Court'))}}
                        {{Form::select('court', $court, $model->court_id, ['required' => '', 'class' => 'primary_select', 'data-placeholder' => __('case.Select court'), 'data-parsley-errors-container' => '#court_error'])}}
                        <span id="court_error"></span>
                    </div>
                </div>
                        @includeIf('case.file')
                <div class="text-center mt-3">
                <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="submit" value="submit">{{ __('common.Update')}}</button>
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
