@extends('layouts.master', ['title' => __('task.Update Task')])


@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('task.Edit Task')}}</h3>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    {!! Form::model($model, ['route' => ['task.update', $model->id], 'class' =>
                      'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT']) !!}
                            <div class="row">
                                <div class="primary_input col-md-12">
                                    {{Form::label('name', __('task.Name'), ['class' => 'required'])}}
                                  {{Form::text('name', null, ['required' => '','class' => 'primary_input_field', 'placeholder' => __('task.Name')])}}
                                </div>
                              </div>
                              <div class="row">
                                <div class="primary_input col-md-6">
                                    {{Form::label('case_id', __('task.Case'), ['class' => 'required'])}}
                                  {{Form::select('case_id', $cases, null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#case_id_error'])}}
                                  <span id="case_id_error"></span>
                                </div>

                                <div class="primary_input col-md-6">
                                    {{Form::label('assignee_id', __('task.Assignee'), ['class' => 'required'])}}
                                  {{Form::select('assignee_id', $users, null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#assignee_id_error'])}}
                                  <span id="assignee_id_error"></span>
                                </div>

                                <div class="primary_input col-md-6">
                                    {{Form::label('priority', __('task.Priority'), ['class' => 'required'])}}
                                  {{Form::select('priority', ['Low'=>'Low','Medium'=>'Medium','High'=>'High'], null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#priority_error'])}}
                                  <span id="priority_error"></span>
                                </div>


                                <div class="primary_input col-md-6">
                                    {{Form::label('stage_id', __('task.Stage'))}}
                                  {{Form::select('stage_id', $stages, null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#stage_id_error'])}}
                                  <span id="stage_id_error"></span>
                                </div>


                                <div class="primary_input col-md-6">
                                  {{Form::label('due_date', __('task.Due Date'))}}
                                  {{Form::text('due_date', null, ['class' => 'primary_input_field primary-input date form-control date', "id"=>"fromDate",'placeholder' => __('task.Date')])}}
                                 </div>
                              </div>

                              <div class="primary_input">
                                {{Form::label('description', __('task.Description'))}}
                                {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('task.Description'), 'rows' => 5, 'data-parsley-errors-container' =>
                                '#description_error' ])}}
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

  _componentAjaxDistrictLoad();
  _formValidation();
  
  });
  </script>
  @endpush