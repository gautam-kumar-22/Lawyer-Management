@extends('layouts.master', ['title' => __('appointment.Appointment')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{ __('appointment.Appointment') }}</h3>
                            <ul class="d-flex">
                            @if(permissionCheck('appointment.store'))
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('appointment.create') }}"><i class="ti-plus"></i>{{ __
                        ('appointment.New Appointment') }}</a></li>
                        @endif
                            </ul>
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
                                            <th scope="col">{{ __('common.Title') }}</th>
                                            <th scope="col">{{ __('appointment.Contact Name') }}</th>
                                            <th scope="col">{{ __('appointment.Motive') }}</th>
                                            <th scope="col">{{ __('common.Date') }}</th>
                                            <th scope="col">{{ __('common.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $model->title }}</td>
                                            <td><a href="{{ route('contact.show', $model->id) }}">{{ $model->contact->name }}</a></td>
                                            <td>{{ strlen($model->motive) > 20 ? substr($model->motive, 0, 20).'...' : $model->motive }}</td>
                                            <td>{{ formatDate($model->date) }}</td>
                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        @if(permissionCheck('appointment.edit'))

                                                            <a href="{{ route('appointment.edit', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                            @endif
                                                            @if(permissionCheck('appointment.show'))
                                                            <a href="{{ route('appointment.show', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Show')}}</a>
                                                            @endif
                                                            @if(permissionCheck('appointment.destroy'))
                                                            <span style="cursor: pointer;" data-url="{{route('appointment.destroy', $model->id)}}" id="delete_item" class="dropdown-item edit_brand" >{{__('common.Delete')}}</span>
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
