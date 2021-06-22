@extends('layouts.master', ['title' => 'Setting'])

@push('css_before')
@endpush

@section('mainContent')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid">
            <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30 ml-4" >{{ __('setting.Settings') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- myTab  -->
                                    <div class="white_box_30px mb_30">
                                        <ul class="nav custom_nav" id="myTab" role="tablist">
                                           
                                            @if(permissionCheck('general_setting.index'))
                                            <li class="nav-item">
                                                <a class="nav-link" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="home" aria-selected="true">{{ __('setting.General') }}</a>
                                            </li>
                                            @endif
                                           
                                            @if(permissionCheck('smtp_setting.index'))
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" id="SMTP-tab" data-toggle="tab" href="#SMTP" role="tab" aria-controls="contact" aria-selected="false">{{ __('setting.SMTP') }}</a>
                                            </li>
                                            @endif
                                           
                                            @if(permissionCheck('cron.index'))
                                            <li class="nav-item">
                                                <a class="nav-link" id="CORN-tab" data-toggle="tab" href="#CORN" role="tab" aria-controls="contact" aria-selected="false">{{ __('setting.CRON') }}</a>
                                            </li>
                                            @endif
                                           
                                            @if(permissionCheck('login_bg_image.index'))
                                            <li class="nav-item">
                                                <a class="nav-link" id="SMS-tab" data-toggle="tab" href="#SMS" role="tab" aria-controls="contact" aria-selected="false">{{ __('setting.Login Backgroud Image') }}</a>
                                            </li>
                                            @endif
                                           
                                            @if(permissionCheck('email_template_settings.index'))
                                            <li class="nav-item submenu_parent">
                                                <a class="nav-link submenu_toggler d-flex jusify-content-between align-itesm-center" aria-controls="contact" aria-selected="false"> <span>{{ __('setting.Email Template') }}</span> <i class="fas fa-caret-down"></i> </a>

                                                <ul class="email-sub-menu">
                                                    @foreach($email_templates as $key => $template)
                                                        <li  class="nav-item">
                                                            <a class="nav-link tab-link"  id="{{ $template->type }}-tab" data-toggle="tab" href="#{{ $template->type }}" role="tab" aria-controls="{{ $template->type }}" aria-selected="false">{{ $template->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <!-- tab-content  -->
                                    <div class="tab-content " id="myTabContent">
                                        <!-- General -->
                                        @if(permissionCheck('general_setting.index'))
                                        <div class="tab-pane fade white_box_30px active show" id="General" role="tabpanel" aria-labelledby="General-tab">
                                            @include('setting::page_components.general_settings')
                                        </div>
                                        @endif
                                           
                                        @if(permissionCheck('smtp_setting.index'))
                                       
                                        <!-- SMTP  -->
                                        <div class="tab-pane fade white_box_30px" id="SMTP" role="tabpanel" aria-labelledby="SMTP-tab">
                                            @include('setting::page_components.smtp_setting')
                                        </div>
                                        @endif
                                           
                                        @if(permissionCheck('cron.index'))
                                        <!-- SMTP  -->
                                        <div class="tab-pane fade white_box_30px" id="CORN" role="tabpanel" aria-labelledby="CORN-tab">
                                            @include('setting::page_components.corn')
                                        </div>
                                         @endif
                                           
                                        @if(permissionCheck('login_bg_image.index'))
                                        <!-- SMS  -->
                                        <div class="tab-pane fade white_box_30px" id="SMS" role="tabpanel" aria-labelledby="SMS-tab">
                                            @include('setting::page_components.login_bg')
                                        </div>
                                        <!-- email template -->
                                        @endif
                                        @if(permissionCheck('email_template_settings.index'))
                                        <!-- submenu tab content -->
                                        @include('setting::page_components.email_template')
                                        @endif
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

@push('js_before')


@endpush

@push('js_after')
    <script type="text/javascript">
        $(document).on('click', '.tab-link', function(){
            $('.tab-link').removeClass('active show');
        });
    // submneu custom js 
        $(document).ready(function(){
            $(".email-sub-menu").slideUp();

            $(".submenu_toggler").on("click", function(){
                $(".email-sub-menu").slideToggle("300")
            });

        });
        $(document).ready(function() {
            smtp_form();


            $('.summernote3').summernote({
                height: 500
            });

        });

        _formValidation2('update_config_setting');
        _formValidation2('update_config_company_details');
        _formValidation2('test_mail_send');
        _formValidation2('updateLoginBG');
        
        

        function update_active_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('update_activation_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success("Successfully Updated","Success");
                }
                else{
                    toastr.warning("Something went wrong");
                }
            });
        }

        function smtp_form(){
            var mail_mailer = $('#mail_mailer').val();
            if (mail_mailer == 'smtp') {
                $('#sendmail').hide();
                $('#smtp').show();
            }
            else if (mail_mailer == 'sendmail') {
                $('#smtp').hide();
                $('#sendmail').show();
            }
        }


        function company_info_form_submit(){
            var company_name = $('#site_title').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var vat_number = $('#vat_number').val();
            var address = $('#address').val();
            var country_name = $('#country_name').val();
            var zip_code = $('#zip_code').val();
            var company_info = $('#company_info').val();
            $.post('{{ route('company_information_update') }}', {_token:'{{ csrf_token() }}', phone:phone, company_name:company_name, email:email, vat_number:vat_number, address:address, country_name:country_name, zip_code:zip_code, company_info:company_info}, function(data){
                if(data == 1){
                    toastr.success("Successfully Updated","Success");
                }
                else{
                    toastr.warning(data.error);
                }
            });
        }

        $('#email_tamplate_tab li label').on('click', function(){
            $('#'+$(this).data('id')).show().siblings('div.sms_ption').hide();
        })
    </script>
@endpush
