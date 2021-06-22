<div class="main-title mb-25">
    <h3 class="mb-0">{{ __('setting.General') }}</h3>
</div>

{!! Form::open(['url' => route('config.update'), 'method' => 'post', 'id' => 'update_config_setting', 'files' =>true ]) !!}
    @csrf
    <input type="hidden" name="g_set" value="1">
    <div class="General_system_wrap_area">
        <div class="single_system_wrap">
            <div class="single_system_wrap_inner text-center">
                <div class="logo">
                    <span>{{ __('setting.System Logo') }}</span>
                </div>
                <div class="logo_img ml-auto mr-auto">
                    <img src="{{asset(getConfigValueByKey($config,'site_logo')) }}" alt="{{ getConfigValueByKey($config,'site_title') }}" id="logo_image">
                </div>
                <div class="update_logo_btn">
                    <button class="primary-btn small fix-gr-bg "  type="button">
                        <input placeholder="Upload Logo" type="file" name="site_logo" id="site_logo" onchange="imageChangeWithFile(this, '#logo_image' )">
                        {{ __('setting.Upload Logo') }}
                    </button>
                </div>
            </div>
            <div class="single_system_wrap_inner text-center">
                <div class="logo">
                    <span>{{ __('setting.Fav Icon') }}</span>
                </div>

                <div class="logo_img ml-auto mr-auto">
                    <img src="{{asset(getConfigValueByKey($config,'favicon_logo')) }}" alt="favicon_image" id="favicon_image">
                </div>

                <div class="update_logo_btn">
                    <button class="primary-btn small fix-gr-bg " type="button">
                        <input placeholder="Upload Logo" type="file" name="favicon_logo" id="favicon_logo" onchange="imageChangeWithFile(this, '#favicon_image' )" >
                        {{ __('setting.Upload Fav Icon') }}
                    </button>
                </div>
            </div>
        </div>

        <div class="single_system_wrap">
            <div class="row">
                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                        {{ Form::label('site_title', __('setting.System Title') , ['class' => 'primary_input_label required']) }}
                        {{ Form::text('site_title', getConfigValueByKey($config,'site_title') , ["class" => "primary_input_field", "placeholder" => 'Infix PM', "required"]) }}
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                    {{ Form::label('email', __('setting.Company Email') , ['class' => 'primary_input_label']) }}
                    {{ Form::email('email',getConfigValueByKey($config,'email'), ["class" => "primary_input_field", "placeholder" => 'info@infix.com']) }}
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                    {{ Form::label('phone', __('setting.Company phone') , ['class' => 'primary_input_label']) }}
                    {{ Form::text('phone',getConfigValueByKey($config,'phone'), ["class" => "primary_input_field", "placeholder" => '+00818***9']) }}
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                    {{ Form::label('address', __('setting.Company address') , ['class' => 'primary_input_label']) }}
                    {{ Form::text('address',getConfigValueByKey($config,'address'), ["class" => "primary_input_field", "placeholder" => 'Enter Address']) }}
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                    {{ Form::label('mail_signature', __('setting.Mail signature') , ['class' => 'primary_input_label']) }}
                    {{ Form::text('mail_signature',getConfigValueByKey($config,'mail_signature'), ["class" => "primary_input_field", "placeholder" => 'Enter mail signature']) }}
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="primary_input mb-25t">
                        {{ Form::label('date_format_id', __('setting.Date Format') , ['class' => 'primary_input_label required']) }}

                        {{ Form::select('date_format_id', $date_formats, getConfigValueByKey($config,'date_format_id'), ['class'=> 'primary_select', 'required', 'id' => 'date_format_id', 'data-parsley-errors-container' => '#date_format_id_error']) }}
                        <span id='date_format_id_error'></span>

                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="primary_input mb-25t">

                        {{ Form::label('currency', __('setting.System Default Currency') , ['class' => 'primary_input_label required']) }}

                        {{ Form::select('currency', $currencies, getConfigValueByKey($config,'currency'), ['class'=> 'primary_select', 'required', 'id' => 'currency', 'data-parsley-errors-container' => '#currency_error']) }}
                        <span id='currency_error'></span>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="primary_input mb-25t">

                        {{ Form::label('time_zone_id', __('setting.Time Zone') , ['class' => 'primary_input_label required']) }}
                        {{ Form::select('time_zone_id', $timeZones, getConfigValueByKey($config,'time_zone_id'), ['class'=> 'primary_select', 'required', 'id' => 'time_zone_id', 'data-parsley-errors-container' => '#time_zone_id_error']) }}
                        <span id='time_zone_id_error'></span>


                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="primary_inpu mb-25t">
                        <label class="primary_input_label" for="">{{ __('setting.Currency Symbol') }}</label>
                        <input class="primary_input_field" placeholder="-" type="text" id="currency_symbol"
                               name="currency_symbol" value="{{ getConfigValueByKey($config,'currency_symbol') }}" readonly>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="primary_input">
                        <label class="primary_input_label" for="">{{ __('setting.Currency Code') }}</label>
                        <input class="primary_input_field" placeholder="-" type="text" id="currency_code"
                               name="currency_code" value="{{ getConfigValueByKey($config,'currency_code') }}" readonly>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="primary_input">
                    {{ Form::label('preloader', __('setting.Preloader') , ['class' => 'primary_input_label required']) }}
                    {{ Form::text('preloader', getConfigValueByKey($config,'preloader') , ["class" => "primary_input_field", "id"=>"preloader", "placeholder" => '-', "required"]) }}

                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="primary_input mb-25t">
                        {{ Form::label('country_id', __('setting.Country') , ['class' => 'primary_input_label required']) }}

                        {{ Form::select('country_id', $countries, getConfigValueByKey($config,'country_id'), ['class'=> 'primary_select', 'required', 'id' => 'country_id', 'data-parsley-errors-container' => '#country_id_error']) }}
                        <span id='country_id_error'></span>

                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="primary_input mb-25">
                    {{ Form::label('copyright_text', __('setting.Copywrite Text') , ['class' => 'primary_input_label required']) }}
                    {{ Form::textarea('copyright_text',getConfigValueByKey($config,'copyright_text') , ["class" => "primary_textarea", "placeholder" => '-', "required"]) }}
                    </div>
                </div>




            </div>
        </div>
    </div>

    <div class="submit_btn text-center mt-4">
        <button class="primary_btn_large submit" type="submit"><i class="ti-check"></i>{{ __('common.Save') }}
        </button>

        <button class="primary_btn_large submitting" type="submit" disabled style="display: none;"><i class="ti-check"></i>{{ __('common.Saving') }}
        </button>

    </div>
{!! Form::close() !!}
