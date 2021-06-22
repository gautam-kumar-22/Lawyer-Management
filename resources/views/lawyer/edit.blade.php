@extends('layouts.master', ['title' => __('lawyer.Update Lawyer')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('lawyer.Edit lawyer')}}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::model($model, ['route' => ['lawyer.update', $model->id], 'class' =>
                        'form-validate-jquery',
                        'id' => 'content_form', 'method' => 'PUT']) !!}
                        <div class="primary_input">
                            {{Form::label('name', __('lawyer.Name'),['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __
                            ('Lawyer Name')])}}
                        </div>
                        <div class="primary_input">
                            {{Form::label('mobile_no', __('lawyer.Mobile No'),['class' => 'required'])}}
                            {{Form::number('mobile_no', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('lawyer.Lawyer Mobile No')])}}
                        </div>

                        <div class="primary_input">
                            {{Form::label('description', __('lawyer.Description'))}}
                            {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('lawyer.Case Category Description'), 'rows' => 5 ])}}
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

