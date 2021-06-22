@extends('layouts.master', ['title' => __('contact.Contact')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{ __('contact.Contact List') }}</h3>
                            <ul class="d-flex">
                            @if(permissionCheck('contact.store'))
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('contact.create') }}"><i class="ti-plus"></i>{{ __
                        ('New Contact') }}</a></li>
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
                                            <th scope="col">{{ __('contact.Name') }}</th>
                                            <th scope="col">{{ __('contact.Category') }}</th>
                                            <th scope="col">{{ __('contact.Mobile') }}</th>
                                            <th scope="col">{{ __('contact.Email') }}</th>
                                            <th scope="col">{{ __('common.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a href="{{ route('contact.show', $model->id) }}">{{ $model->name }}</a></td>
                                            <td>{{ @$model->category->name }}</td>
                                            <td>{{ $model->mobile_no }}</td>
                                            <td>{{ $model->email }}</td>

                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                @if(permissionCheck('contact.show'))
                                                                <a href="{{ route('contact.show', $model->id) }}" class="dropdown-item edit_brand">{{__('common.View')}}</a>
                                                                @endif
                                                                @if(permissionCheck('contact.edit'))
                                                                <a href="{{ route('contact.edit', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                                @endif
                                                                
                                                                @if(permissionCheck('contact.destroy'))
                                                                 <span style="cursor: pointer;" data-url="{{route('contact.destroy', $model->id)}}" id="delete_item" class="dropdown-item edit_brand" >{{__('common.Delete')}}</span>
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

</script>
@endpush