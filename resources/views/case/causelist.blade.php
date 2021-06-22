@extends('layouts.master', ['title' => __('case.Cause List')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Cause List')}} | {{ __('case.Date')}} :{{formatDate($date) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">

                        {!! Form::open(['route' => 'causelist.index', 'method' => 'get']) !!}
                           
                            <div class="row">
                                <div class="col">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{__('case.Date From')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                    {{Form::text('date', date('Y-m-d'), ['class' => 'primary_input_field primary-input date form-control date', "id"=>"fromDate",'placeholder' => __('case.Date')])}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col mt-40">
                                    <div class="primary_input mb-15">
                                        <button type="submit" class="primary-btn fix-gr-bg" id="submit" value="submit" style="width: 100%;"><i class="ti-search"></i>{{ __('case.Get List') }}</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Cause List') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table ">
                                <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            
                                            <th scope="col">{{ __('common.SL') }}</th>
                                            <th>{{ __('case.Case') }}</th>
                                            <th>{{ __('case.Client') }}</th>
                                            <th>{{ __('case.Details') }}</th>
                                            <th class="noprint">{{ __('common.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <b>{{ __('case.Case No.') }}: </b> {{$model->case_category? $model->case_category->name : '' }}/{{$model->case_no}} <br>
                                                <a href="{{route('category.case.show', $model->case_category_id)}}"><b>{{ __('case.Category') }}: </b> {{$model->case_category? $model->case_category->name : '' }}</a>  <br>
                                                <a href="{{ route('case.show', $model->id) }}"><b>{{ __('case.Title') }}: </b>{{ $model->title }}
                                                </a>
                                                <br>
                                                <b>{{ __('case.Next Hearing Date') }}: </b> {{ formatDate($model->hearing_date) }} <br>
                                                <b>{{ __('case.Filing Date') }}: </b> {{ formatDate($model->filling_date) }}
                                            </td>
                                            <td>
                                                @if($model->client == 'Plaintiff' and $model->plaintiff_client)
                                                <a href="{{route('client.show', $model->plaintiff_client->id)}}"><b>{{ __('case.Name') }}</b>: {{ $model->plaintiff_client->name }}</a> <br>
                                                <b>{{ __('case.Mobile') }}: </b> {{ $model->plaintiff_client->mobile }} <br>
                                                <b>{{ __('case.Email') }}: </b> {{ $model->plaintiff_client->email }} <br>
                                                <b>{{ __('case.Address') }}: </b> {{ $model->plaintiff_client->address }}
                                                {{ $model->plaintiff_client->district ? ', '. $model->plaintiff_client->district->name : '' }}
                                                {{ $model->plaintiff_client->division ? ', '. $model->plaintiff_client->division->name : '' }}
                                                @elseif($model->client == 'Opposite' and $model->opposite_client)
                                                <a href="{{route('client.show', $model->opposite_client->id)}}"><b>{{ __('case.Name') }}</b>: {{ $model->opposite_client->name }}</a> <br>
                                                <b>{{ __('case.Mobile') }}: </b> {{ $model->opposite_client->mobile }} <br>
                                                <b>{{ __('case.Email') }}: </b> {{ $model->opposite_client->email }} <br>
                                                <b>{{ __('case.Address') }}: </b> {{ $model->opposite_client->address }}
                                                {{ $model->opposite_client->district ? ', '. $model->opposite_client->district->name : '' }}
                                                {{ $model->opposite_client->division ? ', '. $model->opposite_client->division->name : '' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($model->court)
                                                <a href="{{route('master.court.show', $model->court_id)}}"><b>{{ __('case.Court') }}</b>: {{ $model->court->name}} </a><br>
                                                <a href="{{route('category.court.show', $model->court_category_id)}}"> <b>{{ __('case.Category') }}</b>: {{ $model->court->court_category ? $model->court->court_category->name : '' }} </a><br>
                                                <b>{{ __('case.Room No') }}: </b> {{ $model->court->room_number }} <br>
                                                <b>{{ __('case.Address') }}: </b> {{ $model->court->location }}
                                                {{ $model->court->district ? ', '. $model->court->district->name : '' }}
                                                {{ $model->court->division ? ', '. $model->court->division->name : '' }}
                                                @endif
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

                                                        <a href="{{ route('case.show', $model->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> {{ __('common.View') }}</a>
                                                        @if(!$model->judgement)
                                                            <a href="{{route('case.edit', $model->id)}}" class="dropdown-item"><i class="icon-pencil mr-2"></i>{{ __('common.Edit') }}</a>
                                                            <a href="{{route('date.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                            class="icon-calendar3 mr-2"></i>{{ __('case.New Date') }}</a>
                                                            <a href="{{route('putlist.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                            class="icon-calendar3 mr-2"></i>{{ __('case.New Put Up Date') }}</a>
                                                            <a href="{{route('judgement.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                            class="icon-calendar3 mr-2"></i>{{ __('case.New Judgement Date') }}</a>
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
$(document).ready(function() {
    
});
</script>
@endpush