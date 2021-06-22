@extends('layouts.master', ['title' => __('case.Case History Details')])

@section('mainContent')
<!-- Vertical form options -->

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('case.Case History Details') }}</h3>

                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <h2 class="font-weight-bold"><b>{{ __('case.Title') }}</b>: {{ $case->title }}</h2>
                            <p class="text-justify">
                                {!! $case->description !!}
                            </p>
                            @if (count($models))
                                <h2 class="font-weight-bold"><b>{{ __('case.History') }}</b></h2>
                                @foreach($models as $history)
                                <p class="font-weight-bold mt-2">
                                {{__('case.Date')}}: {{$history->date}}
                                </p>
                                <p>
                                    {{__('case.Event')}}: {{$history->event}}
                                </p>
                                <p class="text-justify">{!!$date->description!!}</p>
                                @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@push('admin.scripts')
@endpush