@extends('layouts.master', ['title' => __('client.Client Details')])
@section('mainContent')
    <section class="mb-40 student-details">
        @if(session()->has('message-success'))
            <div class="alert alert-success">
                {{ session()->get('message-success') }}
            </div>
        @elseif(session()->has('message-danger'))
            <div class="alert alert-danger">
                {{ session()->get('message-danger') }}
            </div>
        @endif
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20">@lang('client.Client Details')</h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100"
                             src="{{ asset('frontend/img/user.png') }}"
                             alt="">
                        <div class="white-box">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Name') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->name}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Mobile') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->mobile}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Email') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->email}}@endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Student Meta Information -->
                </div>
                <!-- Start Student Details -->
                <div class="col-lg-9 staff-details">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#studentProfile" role="tab"
                               data-toggle="tab">{{ __('client.Profile') }}</a>
                        </li>

                        <li class="nav-item edit-button">
                            <a href="{{ route('client.edit', $model->id) }}" class="primary-btn small fix-gr-bg"
                               >{{ __('common.Edit') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head">{{ __('client.Client Info') }}</h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Name') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Mobile') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->mobile}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Email') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->email}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Client Category') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model->category)){{@$model->category->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Address') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->address}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Country') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                            {{ $model->country ? $model->country->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.State') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                            {{ $model->state ? $model->state->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.City') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                            {{ $model->city ? $model->city->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Description') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){!! $model->description !!}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@push('admin.scripts')
    <script type="text/javascript">
     
    </script>
@endpush

