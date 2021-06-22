

{!! Form::open(['url' => route('updateLoginBG'), 'method' => 'post', 'id' => 'updateLoginBG', 'files' =>true ]) !!}
    @csrf
    <input type="hidden" name="g_set" value="1">

    <div class="General_system_wrap_area d-block">

        <div class="single_system_wrap">
            <div class="single_system_wrap_inner text-center">
                <div class="logo ">
                    <span>{{ __('setting.Login Backgroud Image') }}</span>
                </div>
                <div class="logo_img ml-auto mr-auto">
                    <img class="img-fluid" src="{{asset(getConfigValueByKey($config,'login_backgroud_image')) }}" alt="Login background image" id="login_bg_image">
                </div>
                <div class="update_logo_btn">
                    <button class="primary-btn small fix-gr-bg " type="button">
                        <input placeholder="Upload Image" type="file" name="login_backgroud_image"  onchange="imageChangeWithFile(this, '#login_bg_image' )" id="login_backgroud_image">
                        {{ __('setting.Upload Image') }}
                    </button>
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
