@extends('layouts.master', ['title' => __('case.Update Lobbying')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('case.Update Lobbying')}}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                {!! Form::model($model, ['route' => ['lobbying.update', $model->id], 'class' =>
                'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="primary_input col-md-6">
                        {{Form::hidden('case', $case)}}
                        {{Form::label('hearing_date', __('case.Lobbying Date'),['class' => 'required'])}}
                        {{Form::text('hearing_date', $model->date, ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Lobbying Date')])}}
                    </div>
                    <div class="primary_input col-md-6">
                      <label for="">Mark As</label>
                        <select name="status" id="" class="primary_select">
                          <option {{$model->status == 1?'selected':''}} value="1">{{ __('case.Complete') }}</option>
                          <option {{$model->status == NULL?'selected':''}} value="">{{ __('case.Incomplete') }}</option>
                        </select>
                    </div>
                </div>

                <div class="primary_input">
                    {{Form::label('description', __('case.Lobbying Order'),['class' => 'required'])}}
                    {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('case.Lobbying Order'),'required', 'rows' => 5, 'data-parsley-errors-container' =>
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
