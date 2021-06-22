@extends('layouts.master', ['title' => __('contact.Update Contact')])


@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('contact.Edit Contact')}}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    {!! Form::model($model, ['route' => ['contact.update', $model->id], 'class' =>
                      'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT']) !!}
                      <div class="row">
                          <div class="primary_input col-md-12">
                            {{Form::label('contact_category_id', __('contact.Designation'))}}
                            {{Form::select('contact_category_id', $contact_categories, null, ['class' => 'primary_select', 'data-placeholder' => __('contact.Select Designation'),  'data-parsley-errors-container' => '#contact_category_id_error'])}}
                            <span id="contact_category_id_error"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="primary_input col-md-12">

                          {{Form::label('name', __('contact.Name'), ['class' => 'required'])}}
                          {{Form::text('name', null, ['required' => '','class' => 'primary_input_field', 'placeholder' => __('contact.Name')])}}
                          </div>
                          <div class="primary_input col-md-6">
                            {{Form::label('mobile_no', __('contact.Mobile No'))}}
                            {{Form::text('mobile_no', null, ['class' => 'primary_input_field ', 'placeholder' => __('contact.Mobile No')])}}
                          </div>
                          <div class="primary_input col-md-6">
                            {{Form::label('email', __('contact.Email'))}}
                            {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('contact.Email')])}}
                          </div>
                        </div>
                        <div class="primary_input">
                          {{Form::label('description', __('contact.Description'))}}
                          {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('contact.Contact Description'), 'rows' => 5, 'data-parsley-errors-container' =>
                          '#description_error' ])}}
                          <span id="description_error"></span>
                        </div>
                        <div class="text-center mt-3">

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
      _componentAjaxDistrictLoad();
      _formValidation();
  });
  </script>
  @endpush