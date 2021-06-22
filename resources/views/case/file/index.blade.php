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
                    <a class="primary-btn small fix-gr-bg " href="{{ route('case.show', $model->id) }}"><i class="ti-file mr-2"></i>
                        {{ __('case.Case') }}
                    </a>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">


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

                                    <div class="student-meta-box mb-20">
                                        <div class="white-box student-details pt-2 pb-3">

                                            {!! Form::open(['url' => route('file.store', ['case' => $model->id]), 'method' => 'post', 'id' => 'content_form', 'files' =>true, 'data-parsley-focus' => 'none' ]) !!}
                                            @includeIf('case.file')

                                            <div class="col-xl-12 text-center mt-3">
                                                <button class="primary_btn_large submit" type="submit"><i
                                                        class="ti-check"></i>{{ __('common.Create') }}
                                                </button>
                                                <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                                                    <i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                                                </button>
                                            </div>

                                            {!! Form::close() !!}


                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-12">


                                    <div class="student-meta-box mb-20">
                                        <div class="white-box student-details pt-2 pb-3">

                                            @includeIf('case.file_show', ['files' => $model->allFiles, 'type' => 'case'])


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
    <div class="modal fade animated file_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog" aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>

@stop
@push('admin.scripts')
    <script>
        _formValidation();

    </script>
@endpush
