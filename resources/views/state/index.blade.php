@extends('layouts.master', ['title' => __('setting.State')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12 mt_30">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('setting.State') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('setup.state.store'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="{{ route('setup.state.create', ['country_id' => $country_id]) }}"><i class="ti-plus"></i>{{ __
                        ('setting.New State') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-30">
                    <div class="white_box_50px box_shadow_white pt-2 pb-3">

                        {!! Form::open(['route' => 'setup.state.index', 'method' => 'get', 'id' => 'content_form']) !!}

                        <div class="row">
                            <div class="primary_input col-md-6">
                                {{Form::label('country_id', __('setting.Country'), ['class' => 'required'])}}
                                {{Form::select('country_id', $countries, $country_id, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('court.Select country'),  'data-parsley-errors-container' => '#country_id_error'])}}
                                <span id="country_id_error"></span>
                            </div>

                            <div class="primary_input mt_30 col-md-6">
                                <button type="submit" class="primary-btn fix-gr-bg" id="submit" value="submit" style="width: 100%;"><i class="ti-search"></i>{{ __('case.Get List') }}</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="col-lg-12 mt-30">
                    <div class="QA_section QA_section_heading_custom check_box_table mt-30">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>

                                        <th scope="col">{{ __('common.SL') }}</th>
                                        <th>{{ __('common.Name') }}</th>
                                        <th>{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>

                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>
                                                {{ $model->name }}
                                            </td>

                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">

                                                        @if(permissionCheck('setup.city.index'))
                                                            <a href="{{ route('setup.city.index', ['country_id' => $model->country_id, 'state_id' => $model->id]) }}"
                                                               class="dropdown-item">
                                                                <i class="icon-pencil"></i> {{ __('setting.City list') }}</a>
                                                        @endif

                                                        @if(permissionCheck('setup.state.edit'))
                                                            <a href="{{ route('setup.state.edit', $model->id) }}"
                                                               class="dropdown-item"><i
                                                                    class="icon-pencil"></i> {{ __('common.Edit') }}</a>
                                                        @endif
                                                        @if(permissionCheck('setup.state.destroy'))
                                                            <span id="delete_item" data-id="{{ $model->id }}" data-url="{{ route
                                                            ('setup.state.destroy', $model->id)
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
    </section>

@stop
@push('admin.scripts')

    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
