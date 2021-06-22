
<form enctype="multipart/form-data" id="{{ $form_id }}">
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label"
                    for="">{{ __('common.Name') }} *</label>
                <input name="name" class="primary_input_field name"
                    id="name" placeholder="{{ __('common.Name') }}"
                    type="text" required="1">
                <span class="text-danger"  id="name_error"></span>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="primary_input">
                <label class="primary_input_label" for="">{{ __('common.Status') }}</label>
                <ul id="theme_nav" class="permission_list sms_list ">
                    <li>
                        <label data-id="bg_option"
                               class="primary_checkbox d-flex mr-12">
                            <input name="status" id="status_active" value="1" checked="true" class="active" type="radio">
                            <span class="checkmark"></span>
                        </label>
                        <p>{{ __('common.Active') }}</p>
                    </li>
                    <li>
                        <label data-id="color_option"
                               class="primary_checkbox d-flex mr-12">
                            <input name="status" value="0" id="status_inactive"  class="de_active"
                                   type="radio">
                            <span class="checkmark"></span>
                        </label>
                        <p>{{ __('common.DeActive') }}</p>
                    </li>
                </ul>
                <span class="text-danger" id="status_error"></span>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <div class="d-flex justify-content-center pt_20">
                <button type="submit" class="primary-btn semi_large2 fix-gr-bg"><i
                        class="ti-check"></i>
                        {{ $button_level_name }}
                </button>
            </div>
        </div>

    </div>
</form>
