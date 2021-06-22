
<form class="" action="{{ route('sms_gateway_credentials_update') }}" method="post">
    @csrf
    <div class="main-title mb-20">
        <h3 class="mb-0">{{__('setting.SMS Settings')}}</h3>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <label class="primary_input_label" for="">{{ __('setting.Activate SMS Gateway') }}</label>
            <ul id="" class="permission_list sms_list">

                @foreach (\Modules\Setting\Model\SmsGateway::all() as $key => $smsGateway)
                <li>
                    <label class="primary_checkbox d-flex mr-12 ">
                        <input name="sms_gateway_id" type="radio" id="sms_gateway_id{{ $key }}" value="{{ $smsGateway->id }}" @if ($smsGateway->status == 1) checked @endif>
                        <span class="checkmark"></span>
                    </label>
                    <p>{{ $smsGateway->name }}</p>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <ul id="sms_setting" class="permission_list sms_list mb-50 ">
                <li>
                    <label  data-id="Twilio_Settings" class="primary_checkbox d-flex mr-12 ">
                        <input name="sms1" type="radio" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <p>{{__('setting.Twilio Settings')}}</p>
                </li>
                <li>
                    <label data-id="TexttoLocal_Settings" class="primary_checkbox d-flex mr-12">
                        <input name="sms1" type="radio">
                        <span class="checkmark"></span>
                    </label>
                    <p>{{__('setting.Text To Local Settings')}}</p>
                </li>
            </ul>
            <div id="Twilio_Settings" class="sms_ption" >
                <!-- content  -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <input type="hidden" name="types[]" value="TWILIO_SID">
                            <label class="primary_input_label" for="">{{ __('setting.Twilio Account SID') }} *</label>
                            <input class="primary_input_field" placeholder="-" type="text" name="TWILIO_SID" value="{{ env('TWILIO_SID') }}">
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <input type="hidden" name="types[]" value="TWILIO_TOKEN">
                            <label class="primary_input_label" for="">{{ __('setting.Authentication Token') }} *</label>
                            <input class="primary_input_field" placeholder="-" type="text" name="TWILIO_TOKEN" value="{{ env('TWILIO_TOKEN') }}">
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="primary_input mb-100">
                            <input type="hidden" name="types[]" value="VALID_TWILLO_NUMBER">
                            <label class="primary_input_label" for="">{{ __('setting.Registered Phone Number') }} *</label>
                            <input class="primary_input_field" placeholder="-" type="text" name="VALID_TWILLO_NUMBER" value="{{ env('VALID_TWILLO_NUMBER') }}">
                        </div>
                    </div>
                </div>
                <div class="submit_btn text-center mb-100 pt_15">
                    <button class="primary_btn_large" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>
                </div>
                <!-- content  -->
            </div>
            <div id="TexttoLocal_Settings" class="sms_ption"  style="display: none;">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <input type="hidden" name="types[]" value="TEXT_TO_LOCAL_API_KEY">
                            <label class="primary_input_label" for="">{{ __('setting.API Key') }} *</label>
                            <input class="primary_input_field" placeholder="-" type="text" name="TEXT_TO_LOCAL_API_KEY" value="{{ env('TEXT_TO_LOCAL_API_KEY') }}">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <input type="hidden" name="types[]" value="TEXT_TO_LOCAL_SENDER">
                            <label class="primary_input_label" for="">{{ __('setting.Sender Name') }} *</label>
                            <input class="primary_input_field" placeholder="-" type="text" name="TEXT_TO_LOCAL_SENDER" value="{{ env('TEXT_TO_LOCAL_SENDER') }}">
                        </div>
                    </div>
                </div>

                <div class="submit_btn text-center mb-100 pt_15">
                    <button class="primary_btn_large" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
