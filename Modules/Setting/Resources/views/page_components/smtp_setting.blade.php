    <!-- SMTP form  -->
    <div class="main-title mb-25">
        <h3 class="mb-0">{{ __('setting.SMTP Settings') }} <span class="badge_1"> {{ (config('configs')->where('key','mail_protocol')->first()->value == "smtp") ? 'SMPT' : 'PHP Mail' }}  </span></h3>
    </div>

    <form action="{{ route('smtp_gateway_credentials_update') }}" method="post">
        @csrf
        <input type="hidden" name="smtp_set" value="1">
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_MAILER">
                    <label class="primary_input_label" for="">{{ __('setting.Email Protocol') }}</label>
                    <select class="primary_select mb-25" name="mail_protocol" onchange="smtp_form()" id="mail_mailer">
                        <option value="smtp"@if (config('configs')->where('key','mail_protocol')->first()->value == "smtp") selected @endif>SMTP</option>
                        <option value="sendmail"@if (config('configs')->where('key','mail_protocol')->first()->value == "sendmail") selected @endif>PHP Mail</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                    <label class="primary_input_label" for="">{{ __('setting.From Name') }}*</label>
                    <input class="primary_input_field" placeholder="Infix CRM" type="text" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                    <label class="primary_input_label" for="">{{ __('setting.From Mail') }}*</label>
                    <input class="primary_input_field" placeholder="demo@infix.com" type="email" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}">
                </div>
            </div>
        </div>
        <div class="row" id="smtp">

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_HOST">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Host') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PORT">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Port') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_USERNAME">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Username') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Password') }}</label>
                    <input class="primary_input_field" placeholder="-" type="password" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Encryption') }}</label>
                    <select name="MAIL_ENCRYPTION" class="primary_select mb-25">
                        <option value="ssl" @if (env('MAIL_ENCRYPTION') == "ssl") selected @endif>SSL</option>
                        <option value="tls" @if (env('MAIL_ENCRYPTION') == "tls") selected @endif>TLS</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 mb-45 pt_15">
                <div class="submit_btn text-center">
                    <button class="primary_btn_large" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>
                </div>
            </div>
        </div>
    </form>

    {!! Form::open(['url' => route('test_mail.send'), 'method' => 'post', 'id' => "test_mail_send", 'files' =>true ]) !!}
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    {{ Form::label('email', __('setting.Send a Test Email to') , ['class' => 'primary_input_label required']) }}
                    {{ Form::email('email', null , ["class" => "primary_input_field", "placeholder" => __('setting.Send a Test Email to'), "required"]) }}

                </div>
            </div>
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    {{ Form::label('content', __('setting.Mail Text') , ['class' => 'primary_input_label required']) }}
                    {{ Form::text('content', 'This is test mail' , ["class" => "primary_input_field", "placeholder" => __('setting.Mail Text'), "required"]) }}
                </div>
            </div>
        </div>
        <div class="submit_btn text-center mb-100 pt_15">
                <button class="primary_btn_2 submit" type="submit"><i class="ti-check"></i>{{ __('common.Send') }}
                </button>

                <button class="primary_btn_2 submitting" type="submit" disabled style="display: none;"><i class="ti-check"></i>{{ __('common.Sending') }}
                </button>
            </div>

    {!! Form::close() !!}
