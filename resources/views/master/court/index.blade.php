@extends('layouts.master', ['title' => __('court.Court')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{ __('court.Court List') }}</h3>
                            <ul class="d-flex">
                            @if(permissionCheck('master.court.store'))
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('master.court.create') }}"><i class="ti-plus"></i>{{ __
                        ('court.New Court') }}</a></li>
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

                                            <th scope="col">{{ __('court.SL') }}</th>
                                            <th>{{ __('court.Category') }}</th>
                                            <th>{{ __('court.Court') }}</th>
                                            <th>{{ __('court.Location') }}</th>
                                            <th>{{ __('court.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>

                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if($model->court_category)
                                                <a href="{{ route('category.court.show', $model->court_category->id) }}"> {{ $model->court_category->name }} </a>
                                                @else
                                                <span class="badge_4">{{ __('court.No Category') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('master.court.show', $model->id) }}">{{ $model->name }} {{ $model->room_number ? ' ('.$model->room_number .')' : '' }}</a>
                                            </td>
                                            <td>
                                                {{ $model->state ? $model->state->name .', ' : '' }}
                                                {{ $model->city ? $model->city->name .', ' : ''}}
                                                {{ $model->location }}
                                            </td>

                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        @if(permissionCheck('master.court.show'))
                                                        <a href="{{ route('master.court.show', $model->id) }}"
                                                            class="dropdown-item"><i class="icon-file-eye"></i> {{ __
                                                        ('common.View') }}</a>
                                                        @endif
                                                        @if(permissionCheck('master.court.edit'))
                                                        <a href="{{ route('master.court.edit', $model->id) }}"
                                                        class="dropdown-item"><i class="icon-pencil"></i>  {{ __('common.Edit') }}</a>
                                                        @endif
                                                        @if(permissionCheck('master.court.destroy'))
                                                        <span id="delete_item" data-id="{{ $model->id }}" data-url="{{ route
                                                            ('master.court.destroy', $model->id)
                                                        }}" class="dropdown-item"><i class="icon-trash"></i> {{ __('common.Delete') }} </span>
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
