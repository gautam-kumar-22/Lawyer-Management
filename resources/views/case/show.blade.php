@extends('layouts.master', ['title' => __('case.Case Details')])

@section('mainContent')



    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">{{ $model->title }}</h3>
                    </div>
                </div>

                <div class="col-lg-12 d-print-none">

                    @if($model->judgement_status=='Open' OR $model->judgement_status=='Reopen')
                        @if(permissionCheck('date.store'))
                            <a href="{{route('date.create', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.New Date') }}</a>
                        @endif
                        @if(permissionCheck('putlist.store'))
                            <a href="{{route('putlist.create', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.New Put Up Date') }}</a>
                        @endif
                        @if(permissionCheck('lobbying.store'))
                            <a href="{{route('lobbying.create', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.New Lobbying Date') }}</a>
                        @endif
                        @if(permissionCheck('judgement.store'))
                            <a href="{{route('judgement.create', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.New Judgement Date') }}</a>
                        @endif

                    @endif
                    @if($model->judgement_status=='Judgement')
                        @if(permissionCheck('judgement.store'))
                            <a href="{{route('judgement.reopen', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.Re-open') }}</a>
                        @endif
                        @if(permissionCheck('judgement.store'))
                            <a href="{{route('judgement.close', ['case' => $model->id])}}"
                               class="primary-btn small fix-gr-bg"><i
                                    class="ti-calendar mr-2"></i>{{ __('case.Close') }}</a>
                        @endif

                    @endif

                    <span class="primary-btn small fix-gr-bg printMe"><i class="ti-printer mr-2"></i>
                                    {{ __('case.Print') }}
                                </span>
                    <a class="primary-btn small fix-gr-bg " href="{{ route('file.index', ['case' => $model->id]) }}"><i class="ti-file mr-2"></i>
                                    {{ __('case.File') }}
                                </a>


                </div>
            </div>


            <div class="row">
                <div class="col-lg-8">


                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row mb-4">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">


                                    @foreach($model->hearing_dates as $date)

                                        @if($date->type == 'lobbying')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name mr-1">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('lobbying.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('lobbying.edit'))
                                                                    <a href="{{route('lobbying.edit', [$date->id, 'case' => $model->id])}}"
                                                                       class="primary-btn small fix-gr-bg">{{__('common.Edit')}}</a>
                                                                @endif
                                                                @if(permissionCheck('lobbying.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('lobbying.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('common.Delete')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Lobbying') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'lobbying'])


                                                </div>
                                            </div>
                                        @elseif($date->type == 'putlist')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('putlist.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('putlist.edit'))
                                                                    <a href="{{route('putlist.edit', [$date->id, 'case' => $model->id])}}"
                                                                       class="primary-btn small fix-gr-bg">Edit</a>
                                                                @endif
                                                                @if(permissionCheck('putlist.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('putlist.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('case.Delete')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Put up Date') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' =>'putlist'])

                                                </div>
                                            </div>
                                        @elseif($date->type == 'close')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('date.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('date.edit'))
                                                                    <a href="{{route('date.edit', [$date->id, 'case' => $model->id])}}"
                                                                       class="primary-btn small fix-gr-bg">Edit</a>
                                                                @endif
                                                                @if(permissionCheck('date.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('date.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('case.Delete')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Closed case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])


                                                </div>
                                            </div>
                                        @elseif($date->type == 'reopen')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('date.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('date.edit'))
                                                                    <a href="{{route('date.edit', [$date->id, 'case' => $model->id])}}"
                                                                       class="primary-btn small fix-gr-bg">Edit</a>
                                                                @endif
                                                                @if(permissionCheck('date.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('date.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('case.Delete')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Re-open Case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])

                                                </div>
                                            </div>
                                        @elseif($date->type == 'judgement')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('judgement.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('judgement.edit'))
                                                                    <a href="{{route('judgement.edit', [$date->id, 'case' => $model->id])}}"
                                                                       class="primary-btn small fix-gr-bg">Edit</a>
                                                                @endif
                                                                @if(permissionCheck('judgement.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('judgement.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('case.Delete')}}</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Judgement Case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'judgement' ])

                                                </div>
                                            </div>

                                        @elseif($date->type == 'court_change')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('date.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Court Change') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])


                                                </div>
                                            </div>

                                        @else

                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name mr-1">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                            <div class="value">
                                                                @if(permissionCheck('date.edit'))
                                                                    <span style="cursor: pointer;" data-container="file_modal" data-href="{{route('file.create', ['case' => $model->id, 'date' => $date->id])}}"  class="primary-btn small fix-gr-bg btn-modal">{{ __('case.Add File') }}</span>
                                                                @endif
                                                                @if(permissionCheck('date.edit'))
                                                                    <a href="{{route('date.edit', [$date->id, 'case' => $model->id])}}" class="primary-btn small fix-gr-bg">Edit</a>
                                                                @endif
                                                                @if(permissionCheck('date.destroy'))
                                                                    <span style="cursor: pointer;"
                                                                          data-url="{{route('date.destroy', $date->id)}}"
                                                                          id="delete_item"
                                                                          class="primary-btn small fix-gr-bg">{{__('case.Delete')}}</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex align-items-center">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ @$date->case_stage->name }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                   @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])

                                                </div>
                                            </div>
                                        @endif


                                    @endforeach

                                    <div class="student-meta-box mb-20">
                                        <div class="white-box student-details pt-2 pb-3">
                                            <div class="single-meta">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="name mr-1">

                                                    </div>
                                                    <div class="value">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="d-flex align-items-center">
                                                    <div class="name mr-1">
                                                        {{ __('case.Description') }} :
                                                    </div>
                                                    <div class="value">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="text-left">
                                                    {!!$model->description!!}
                                                </div>
                                            </div>

                                            @includeIf('case.file_show', ['files' => $model->files, 'type' => 'case'])

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-25">
                    <div class="student-meta-box sticky-details">
                        <div class="white-box student-details pt-3">
                            <div class="single-meta">
                                <h3 class="mb-0">{{__('case.Details')}} </h3>
                            </div>
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Case No.') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->case_category? $model->case_category->name : '' }}
                                        - {{$model->case_no}}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Category') }}:
                                    </div>
                                    <div class="value">
                                        @if($model->case_category)
                                            <a href="{{route('category.case.show', $model->case_category_id)}}">
                                                {{$model->case_category? $model->case_category->name : '' }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.File No') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->file_no}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Reference') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->ref_name}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Reference Mobile') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->ref_mobile}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Next Hearing Date') }}:
                                    </div>
                                    <div class="value">
                                        {{ formatDate($model->hearing_date) }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Filing Date') }}:
                                    </div>
                                    <div class="value">
                                        {{formatDate($model->filling_date)}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Opposite Lawyer') }}:
                                    </div>
                                    <div class="value">
                                        {!!$model->lawyer ? '<a
                                            href="'.route('lawyer.show', $model->lawyer_id).'">'. $model->lawyer->name .'</a>' :
                                        ''!!}
                                    </div>
                                </div>
                            </div>


                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Case Stage') }}:
                                    </div>
                                    <div class="value">
                                        {!!$model->case_stage ? '<a
                                            href="'.route('master.stage.show', $model->stage_id).'">'. $model->case_stage->name
                                            .'</a>' : ''!!}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Client')}} </h3>
                            </div>


                            @if($model->client == 'Plaintiff' and $model->plaintiff_client)
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Name') }}:
                                        </div>
                                        <div class="value">
                                            <a href="{{route('client.show', $model->plaintiff_client->id)}}">
                                                {{ $model->plaintiff_client->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Mobile') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->mobile }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Email') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Address') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Location') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->state ? $model->plaintiff_client->state->name.',' : '' }}
                                            {{ $model->plaintiff_client->city ? $model->plaintiff_client->city->name : '' }}
                                        </div>
                                    </div>
                                </div>

                            @elseif($model->client == 'Opposite' and $model->opposite_client)

                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Name') }}:
                                        </div>
                                        <div class="value">
                                            <a href="{{route('client.show', $model->opposite_client->id)}}">
                                                {{ $model->opposite_client->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Mobile') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->mobile }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Email') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Address') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Location') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->district ? ', '. $model->opposite_client->district->name : '' }}
                                            {{ $model->opposite_client->division ? ', '. $model->opposite_client->division->name : '' }}
                                        </div>
                                    </div>
                                </div>

                            @endif


                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Court')}} </h3>

                                <a href="{{ route('case.court.change', $model->id) }}"
                                   class="primary-btn small fix-gr-bg">
                                    {{ __('case.Court Change') }}
                                </a>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Name') }}
                                    </div>
                                    <div class="value">
                                        <a href="{{route('master.court.show', $model->court_id)}}">
                                            {{ $model->court->name}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Category') }}
                                    </div>
                                    <div class="value">
                                        <a href="{{route('category.court.show', $model->court_category_id)}}">
                                            {{ $model->court->court_category ? $model->court->court_category->name : '' }} </a>
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Room No') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->room_number }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Address') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->location }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Location') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->state ? $model->court->state->name.',' : '' }}
                                        {{ $model->court->city ? $model->court->city->name : '' }}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Acts')}} </h3>
                            </div>

                            <div class="single-meta mt-10">
                                @if ($model->acts)
                                    @foreach ($model->acts as $act)
                                        {{$act->act ? $act->act->name .', ': ''}}
                                    @endforeach
                                @endif
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade animated file_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog" aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>

@stop
@push('admin.scripts')
    <script>
        $('.printMe').click(function () {
            window.print();
        });

    </script>
@endpush
