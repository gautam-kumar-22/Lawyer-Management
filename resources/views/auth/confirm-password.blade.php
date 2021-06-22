@extends('project::layouts.master')

@section('content')
    <div class="recent_work_viewFile confirm_password_height align-items-center justify-content-center d-flex">
        <div class="container">
            <div class="row align-items-center justify-content-center ">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Confirm Your Password
                        </div>
                        <div class="card-body">
                        {!! Form::open(['url' => route('password.confirm'), 'method' => 'post', 'id' => 'content_form', 'files' =>true ]) !!}

                        <!-- Password -->
                            <div class="primary_input mb-25">

                                {{ Form::label('password', __('Password'), ['class' => 'primary_input_label']) }}
                                {{ Form::password('password', ['required', 'autocomplete' => 'current-password', 'placeholder' => __('Password'), 'class' => 'primary_input_field']) }}
                            </div>


                            <div class="d-flex justify-content-center">
                                <button type="submit" class="primary-btn semi_large2 fix-gr-bg submit" id="save_button_parent"><i class="ti-check"></i>{{ __('Confirm') }}
                                </button>

                                <button type="button" class="primary-btn semi_large2 fix-gr-bg submitting" disabled style="display: none;">
                                    <span class="ti-lock mr-2"></span>
                                    {{ __('Confirming') }}
                                </button>

                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js_after')

    <script>
        _formValidation('content_form', true, 'workspace_modal');
    </script>
    @endpush
