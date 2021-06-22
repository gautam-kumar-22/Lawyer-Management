@extends('layouts.master', ['title' => __('task.Task')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >
                            @if(request()->is('my-task'))
                                {{ __('task.My Task') }}

                            @elseif(request()->is('completed-task'))
                                {{ __('task.Completed Task') }}
                            @else
                                 {{ __('task.Task List') }}
                            @endif

                            </h3>
                            @if(request()->is('task'))
                            <ul class="d-flex">
                                @if(permissionCheck('task.store'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('task.create') }}"><i class="ti-plus"></i>{{ __
                            ('task.New Task') }}</a></li>
                                @endif
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('common.SL') }}</th>
                                            <th scope="col">{{ __('task.Name') }}</th>
                                            <th scope="col">{{ __('task.Priority') }}</th>
                                            <th scope="col">{{ __('task.Case') }}</th>
                                            <th scope="col">{{ __('task.Assigned to') }}</th>
                                            <th scope="col">{{ __('task.Due Date') }}</th>
                                            <th scope="col">{{ __('task.Stage') }}</th>
                                            <th scope="col">{{ __('common.Status') }}</th>
                                            <th scope="col">{{ __('common.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->priority }}</td>
                                            <td>{{ $model->case->title }}</td>
                                            <td><a href="">{{ $model->assignee->name }}</a></td>
                                            <td>{{ formatDate($model->due_date) }}</td>
                                            <td>{{ @$model->stage->name }}</td>
                                            <td>{!! $model->status != 1 ? '<span class="badge_3"> Pending </span>' : '<span class="badge_1"> Complete </span>' !!}</td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            @if(permissionCheck('task.edit'))
                                                            <a href="{{ route('task.edit', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                            @endif
                                                            @if(permissionCheck('task.show'))
                                                            <a href="{{ route('task.show', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Show')}}</a>
                                                             @endif
                                                             @if(permissionCheck('task.destroy'))
                                                            <span style="cursor: pointer;" data-url="{{route('task.destroy', $model->id)}}" id="delete_item" class="dropdown-item edit_brand" >{{__('common.Delete')}}</span>
                                                            @endif
                                                            @if($model->status != 1)
                                                            <a href="{{ route('task.completed', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Mark as completed')}}</a>
                                                            @endif
                                                        </div>
                                                    </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

});
</script>
@endpush
