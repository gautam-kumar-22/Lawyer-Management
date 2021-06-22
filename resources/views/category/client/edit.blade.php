@extends('layouts.master', ['title' => __('client.Update Client Category')])



@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('client.Update Client Category')}}</h3>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                        {!! Form::model($model, ['route' => ['category.client.update', $model->id], 'class' =>
                        'form-validate-jquery',
                        'id' => 'content_form', 'method' => 'PUT']) !!}
                        <div class="primary_input">
                            {{Form::label('name', __('client.Name'),['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __
                            ('Client Category Name')])}}
                        </div>

                        <div class="primary_input">
                            {{Form::label('description', __('client.Description'))}}
                            {{Form::textarea('description', null, ['class' => 'primary_input_field', 'placeholder' =>
                            __('client.Client Category Description'), 'rows' => 5 ])}}
                        </div>

                        <div class="form-check mt-3">
                            <label class="switch_toggle" for="checkbox">
                                <input type="checkbox" id="checkbox" name="plaintiff" @if($model->plaintiff) checked @endif>
                                <div class="slider round"></div>
                                
                            </label>

                        {{ __('client.On behalf of Plaintiff') }}
                        </div>

                       <div class="text-center ">
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
        $(document).ready(function () {
            _formValidation();
            
        });
    </script>
@endpush

