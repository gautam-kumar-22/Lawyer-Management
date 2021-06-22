@extends('layouts.master', ['title' => __('taskContact Details')])

@section('mainContent')




<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('taskTask Details') }}</h3>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    <table>
                    <tbody>
                        <tr>
                            <td class="p-2"><h4>{{__('task.Task Name')}}</h4> </td>
                            <td>:</td>
                            <td><h4>{{ $model->name }}</h4></td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('task.Task Priority')}}</td>
                            <td>:</td>
                            <td>{{ $model->priority }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('task.Case')}}</td>
                            <td>:</td>
                            <td><a href="{{ route('case.show', $model->case->id) }}">{{ $model->case->title }}</a></td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('task.Assigned to')}}</td>
                            <td>:</td>
                            <td>{{ $model->assignee->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{__('task.Due Date')}}</td>
                            <td>:</td>
                            <td>{{ formatDate($model->due_date) }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('task.Stage')}}</td>
                            <td>:</td>
                            <td>{{ @$model->stage->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{__('task.Description')}} </td>
                            <td>:</td>
                            <td>{!! $model->description !!}</td>
                        </tr>
                    </tbody>
                    </table>

                  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@push('admin.scripts')
<script>
$('.printMe').on("click", function(){
window.print();
});
</script>
@endpush