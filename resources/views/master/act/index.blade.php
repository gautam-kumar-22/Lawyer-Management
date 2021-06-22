@extends('layouts.master', ['title' => __('case.Act')])


@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{ __('case.Act') }}</h3>
                            <ul class="d-flex">
                            @if(permissionCheck('master.act.store'))
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('master.act.create') }}"><i class="ti-plus"></i>{{ __
                        ('case.New Act') }}</a></li>
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
                                            <th>{{ __('case.Act') }}</th>
                                            <th>{{ __('case.Description') }}</th>
                                            <th>{{ __('common.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->description }}</td>
                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">

                                                        @if(permissionCheck('master.act.edit'))
                                                        <a href="{{ route('master.act.edit', $model->id) }}"
                                                        class="dropdown-item"><i class="icon-pencil"></i>  {{ __('common.Edit') }}</a>
                                                        @endif

                                                        @if(permissionCheck('master.act.destroy'))
                                                        <span id="delete_item" data-id="{{ $model->id }}" data-url="{{ route
                                                        ('master.act.destroy', $model->id)
                                                        }}"
                                                        class="dropdown-item"><i class="icon-trash"></i>
                                                            {{ __('common.Delete') }} </span>  
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

