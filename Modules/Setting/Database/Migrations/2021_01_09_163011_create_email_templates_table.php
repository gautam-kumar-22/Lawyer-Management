<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Model\EmailTemplate;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("subject")->nullable();
            $table->longtext("value")->nullable();
            $table->text('available_variable')->nullable();
            $table->boolean("status")->nullable()->default(true);
            $table->timestamps();
        });


        DB::table('email_templates')->insert([

            [
                'name' => 'Welcome Mail',
                'type' => 'welcome_mail',
                'subject' => 'Welcome Mail',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{
                        text-decoration: none;
                    }

                    .primary-btn {
                        display: inline-block;
                        padding: 17px 23px;
                        text-transform: uppercase;
                        line-height: 16px;
                        font-size: 12px;
                        font-weight: 500;
                        border-radius: 5px;
                        white-space: nowrap;
                        -webkit-transition: 0.3s;
                        transition: 0.3s;
                        color: #fff;
                        border: 0;
                        cursor: pointer;
                        letter-spacing: 0.1em;

                        background: linear-gradient(
                            90deg , #7C32FF 0%, #A235EC 70%, #C738D8 100%);
                            
                    }
                    
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>Welcome to {APP_NAME}</h3>
                        <p style="text-align: left; ">Hello {USER_NAME}, </p><p style="text-align: left; ">Welcome to {APP_NAME}</p><p style="text-align: left; "><br></p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                ,
                'available_variable' => '{APP_NAME},{USER_NAME},{APP_NAME}',
                'status' => true
            ],
           
            [
                'name' => 'Signup Mail',
                'type' => 'sign_up_email',
                'subject' => 'Sign up Email',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{
                        text-decoration: none;
                    }

                    .primary-btn {
                        display: inline-block;
                        padding: 17px 23px;
                        text-transform: uppercase;
                        line-height: 16px;
                        font-size: 12px;
                        font-weight: 500;
                        border-radius: 5px;
                        white-space: nowrap;
                        -webkit-transition: 0.3s;
                        transition: 0.3s;
                        color: #fff;
                        border: 0;
                        cursor: pointer;
                        letter-spacing: 0.1em;

                        background: linear-gradient(
                            90deg , #7C32FF 0%, #A235EC 70%, #C738D8 100%);
                            
                    }
                    
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>Welcome to {APP_NAME}</h3>
                        <p style="text-align: left; ">Hello {USER_NAME}, </p><p style="text-align: left; ">Welcome to {APP_NAME}</p><p style="text-align: left; ">Password : {PASSWORD}</p><p style="text-align: left; "><br></p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                ,
                'available_variable' => '{APP_NAME},{USER_NAME},{APP_NAME},{PASSWORD}',
                'status' => true
            ],
            
            [
                'name' => 'Task Assign',
                'type' => 'task_assign',
                'subject' => 'Task Assign',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{
                        text-decoration: none;
                    }
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>{ASSIGNED_FROM} assigned a task to you<br></h3>
                        <p style="text-align: left; ">Task </p><p style="text-align: left; "><a href="http://{TASK_URL}" target="_blank">{TASK_NAME}</a>,</p><p style="text-align: left; "> Assigned To : {ASSIGNED_TO} </p><p style="text-align: left; ">Due Date : {DUE_DATE} </p><p style="text-align: left; ">Case : <a href="http://{CASE_URL}" target="_blank">{CASE_NAME}</a> </p><p style="text-align: left; "><br></p><p style="text-align: left; ">{EMAIL_SIGNATURE}<br></p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                ,
                'available_variable' => '{ASSIGNED_FROM},{TASK_NAME},{ASSIGNED_TO},{DUE_DATE},{CASE_NAME},{CASE_URL},{EMAIL_SIGNATURE}',
                'status' => true
            ],
            [
                'name' => 'Task Completed',
                'type' => 'task_complete',
                'subject' => 'Task Complete',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{
                        text-decoration: none;
                    }
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>{USER_NAME} has complete {TASK_NAME}<br></h3>
                        <p style="text-align: left; ">&nbsp;Hello {ASSIGNED_FROM}<span style="color: rgb(130, 139, 178);">,</span></p><p style="text-align: left; ">{USER_NAME} has complete <a href="http://{TASK_URL}" target="_blank">{TASK_NAME}</a> in <a href="http://{CASE_URL}" target="_blank">{CASE_NAME}</a> For check <a href="http://{TASK_URL}" target="_blank">Click here</a><br></p><p style="text-align: left; "><br></p><p style="text-align: left; ">{EMAIL_SIGNATURE}</p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                ,
                'available_variable' => '{EMAIL_SIGNATURE},{USER_NAME},{TASK_NAME},{TASK_URL},{CASE_NAME},{CASE_URL}',
                'status' => true
            ],
            [
                'name' => 'Task Date Reminder',
                'type' => 'due_date_remider',
                'subject' => 'Due date remider',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{

                        text-decoration: none;
                    }
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>Due Date reminder<br></h3>
                        <p style="text-align: left; ">Hello {USER_NAME}, </p><p style="text-align: left; ">You have assigned in <a href="http://{TASK_URL}" target="_blank">{TASK_NAME}</a>, which due date is nearby.&nbsp;</p><p style="text-align: left; ">The last date of this task is {LAST_DATE}</p><p style="text-align: left; ">{EMAIL_SIGNATURE}</p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                ,
                'available_variable' => '{EMAIL_SIGNATURE},{USER_NAME},{TASK_NAME},{LAST_DATE},{TASK_URL}',
                'status' => true
            ],
            [
                'name' => 'Password Reset',
                'type' => 'password_reset_template',
                'subject' => 'Password reset template',
                'value' => <<<'EOD'
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;
            
                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }
            
                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .primary-btn {
                        display: inline-block;
                        padding: 17px 23px;
                        text-transform: uppercase;
                        line-height: 16px;
                        font-size: 12px;
                        font-weight: 500;
                        border-radius: 5px;
                        white-space: nowrap;
                        -webkit-transition: 0.3s;
                        transition: 0.3s;
                        color: #fff;
                        border: 0;
                        cursor: pointer;
                        letter-spacing: 0.1em;

                        background: linear-gradient(
                            90deg , #7C32FF 0%, #A235EC 70%, #C738D8 100%);
                            
                    }

                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;
            
                    }
                    a{
                        text-decoration: none;
                    }

                    .primary-btn {
                        display: inline-block;
                        padding: 17px 23px;
                        text-transform: uppercase;
                        line-height: 16px;
                        font-size: 12px;
                        font-weight: 500;
                        border-radius: 5px;
                        white-space: nowrap;
                        -webkit-transition: 0.3s;
                        transition: 0.3s;
                        color: #fff;
                        border: 0;
                        cursor: pointer;
                        letter-spacing: 0.1em;

                        background: linear-gradient(
                            90deg , #7C32FF 0%, #A235EC 70%, #C738D8 100%);
                            
                    }         </style>
            
            
            
                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="http://spondan.com/advocate/public/uploads/settings/logo.png" alt=""></a></div><div class="invitation_text">
                        <h1 style="text-align: left; " segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" color:="" rgb(61,="" 72,="" 82);="" font-size:="" 18px;="" text-align:="" left;"="">Hello!</h1><p style="text-align: left; color: rgb(113, 128, 150);" segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" line-height:="" 1.5em;="" text-align:="" left;"="">You are receiving this email because we received a password reset request for your account.</p><p style="text-align: left;" segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" line-height:="" 1.5em;="" text-align:="" left;"=""><a class="primary-btn fix-gr-bg" href="http://{RESET_LINK}" target="_blank" style="color: rgb(255, 255, 255); font-weight: bold;">Reset Link</a></p><p style="text-align: left; color: rgb(113, 128, 150);" segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" line-height:="" 1.5em;="" text-align:="" left;"="">This password reset link will expire in 60 minutes.</p><p style="text-align: left; color: rgb(113, 128, 150);" segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" line-height:="" 1.5em;="" text-align:="" left;"="">If you did not request a password reset, no further action is required.</p><p style="color: rgb(113, 128, 150); font-family: -apple-system, BlinkMacSystemFont, " segoe="" ui",="" roboto,="" helvetica,="" arial,="" sans-serif,="" "apple="" color="" emoji",="" "segoe="" ui="" symbol";="" position:="" relative;="" line-height:="" 1.5em;="" text-align:="" left;"=""><br></p><p style="position: relative; line-height: 1.5em; text-align: left;"><font color="#828bb2" face="-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol"><span style="font-size: 14px;">If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="http://{RESET_LINK}" target="_blank">{RESET_LINK}</a></span></font><br></p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        <p><span style="color: rgb(130, 139, 178); font-family: Poppins, sans-serif; font-size: 16px; text-align: left; text-transform: none;"></span><br></p></div>
                </div>
EOD
                ,
                'available_variable' => '{RESET_LINK},{APP_NAME}',
            'status' => true
                        ],

                        [
                            'name' => 'Appointment',
                            'type' => 'appointment',
                            'subject' => 'Appointment',
                            'value' => <<<'EOD'
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Document</title>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                                body{
                                    font-family: 'Poppins', sans-serif;
                                    margin: 0;
                                    padding: 0;
                                }
                                .email_invite_wrapper{
                                    background: #fff;
                                    text-align: center;
            
                                }
                                h1,h2,h3,h4,h5{
                                    color: #415094;
                                }
                                .btn_1 {
                                    display: inline-block;
                                    padding: 13.5px 45px;
                                    border-radius: 5px;
                                    font-size: 14px;
                                    color: #fff;
                                    -o-transition: all .4s ease-in-out;
                                    -webkit-transition: all .4s ease-in-out;
                                    transition: all .4s ease-in-out;
                                    text-transform: capitalize;
                                    background-size: 200% auto;
                                    border: 1px solid transparent;
                                    box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                                    background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                                    background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                    background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                    background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                }
                                .btn_1:hover {
                                    color: #fff !important;
                                    background-position: right center;
                                    box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                                }
            
                                .banner img{
                                    width: 100%;
                                }
                                .invitation_text {
                                    max-width: 500px;
                                    margin: 30px auto 0 auto
                                }
                                .invitation_text h3{
                                    font-size: 20px;
                                    text-transform: capitalize;
                                    color: #2F353D;
                                    margin-bottom: 10px;
                                    font-weight: 600;
                                }
                                .invitation_text p{
                                    font-family: "Poppins", sans-serif;
                                    line-height: 1.929;
                                    font-size: 16px;
                                    margin-bottom: 0px;
                                    color: #828bb2;
                                    font-weight: 300;
                                    margin: 10px 0 30px 0;
                                }
                                .invitation_text a{}
                                .logo{
                                    margin: 30px 0;
                                }
                                .social_links{
                                    background: #F4F4F8;
                                    padding: 15px;
                                    margin: 30px 0 30px 0;
                                }
                                .social_links a{
                                    display: inline-block;
                                    font-size: 15px;
                                    color: #252B33;
                                    padding: 5px;
                                }
                                .email_invite_bottom{
                                    text-align: center;
                                    margin: 20px 0 30px 0;
                                }
                                .email_invite_bottom p{
                                    font-size: 14px;
                                    font-weight: 400;
                                    color: #828bb2;
                                    text-transform: capitalize;
                                    margin-bottom: 0;
                                }
                                .email_invite_bottom a{
                                    font-size: 14px;
                                    font-weight: 500;
                                    color: #7c32ff  ;
            
                                }
                                a{
                                    text-decoration: none;
                                }

                                .primary-btn {
                                    display: inline-block;
                                    padding: 17px 23px;
                                    text-transform: uppercase;
                                    line-height: 16px;
                                    font-size: 12px;
                                    font-weight: 500;
                                    border-radius: 5px;
                                    white-space: nowrap;
                                    -webkit-transition: 0.3s;
                                    transition: 0.3s;
                                    color: #fff;
                                    border: 0;
                                    cursor: pointer;
                                    letter-spacing: 0.1em;
            
                                    background: linear-gradient(
                                        90deg , #7C32FF 0%, #A235EC 70%, #C738D8 100%);
                                        
                                }

                            </style>
            
            
            
                            <div class="email_invite_wrapper text-center">
                                <div class="logo">
                                    <a href="#">
                                        <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                                    </a>
                                </div>
                                
                                <div class="invitation_text">
                                    <h3>Appointment</h3>
                                    <p style="text-align: left; ">Hello , </p><p style="text-align: left; "><a href="http://{CASE_URL}" target="_blank">H</a>ere are new appointment with {CONTACT_NAME}&nbsp; at&nbsp; {APPOINTMENT_DATE}.</p><p style="text-align: left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://{APPOINTMENT_URL}" class="primary-btn fix-gr-bg" target="_blank"><b style="color: rgb(255, 255, 255);">View Details</b></a></p><p style="text-align: left; ">{EMAIL_SIGNATURE}<br></p></div>
                                <div class="social_links">
                                    <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                    <a href="#"> <i class="fab fa-twitter"></i> </a>
                                    <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                                </div>
                                <div class="email_invite_bottom">
                                    </div>
                            </div>
EOD
                            ,
                            'available_variable' => '{CONTACT_NAME},{APPOINTMENT_DATE},{EMAIL_SIGNATURE}',
                            'status' => true
                        ],
                        [
                            'name' => 'Case Date Changed',
                            'type' => 'case_date_change',
                            'subject' => 'Case Date change',
                            'value' => <<<'EOD'
                            <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                    body{
                        font-family: 'Poppins', sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .email_invite_wrapper{
                        background: #fff;
                        text-align: center;

                    }
                    h1,h2,h3,h4,h5{
                        color: #415094;
                    }
                    .btn_1 {
                        display: inline-block;
                        padding: 13.5px 45px;
                        border-radius: 5px;
                        font-size: 14px;
                        color: #fff;
                        -o-transition: all .4s ease-in-out;
                        -webkit-transition: all .4s ease-in-out;
                        transition: all .4s ease-in-out;
                        text-transform: capitalize;
                        background-size: 200% auto;
                        border: 1px solid transparent;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                        background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                        background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                        background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                    }
                    .btn_1:hover {
                        color: #fff !important;
                        background-position: right center;
                        box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                    }

                    .banner img{
                        width: 100%;
                    }
                    .invitation_text {
                        max-width: 500px;
                        margin: 30px auto 0 auto
                    }
                    .invitation_text h3{
                        font-size: 20px;
                        text-transform: capitalize;
                        color: #2F353D;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }
                    .invitation_text p{
                        font-family: "Poppins", sans-serif;
                        line-height: 1.929;
                        font-size: 16px;
                        margin-bottom: 0px;
                        color: #828bb2;
                        font-weight: 300;
                        margin: 10px 0 30px 0;
                    }
                    .invitation_text a{}
                    .logo{
                        margin: 30px 0;
                    }
                    .social_links{
                        background: #F4F4F8;
                        padding: 15px;
                        margin: 30px 0 30px 0;
                    }
                    .social_links a{
                        display: inline-block;
                        font-size: 15px;
                        color: #252B33;
                        padding: 5px;
                    }
                    .email_invite_bottom{
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .email_invite_bottom p{
                        font-size: 14px;
                        font-weight: 400;
                        color: #828bb2;
                        text-transform: capitalize;
                        margin-bottom: 0;
                    }
                    .email_invite_bottom a{
                        font-size: 14px;
                        font-weight: 500;
                        color: #7c32ff  ;

                    }
                    a{
                        text-decoration: none;
                    }
                </style>



                <div class="email_invite_wrapper text-center">
                    <div class="logo">
                        <a href="#">
                            <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                        </a>
                    </div>
                    
                    <div class="invitation_text">
                        <h3>Case Date change</h3>
                        <p style="text-align: left; ">Hello {CLIENT_NAME}, </p><p style="text-align: left; "><a href="http://{CASE_URL}" target="_blank">{CASE_NAME}</a> hearing date has chanced to {CASE_DATE}.<br></p><p style="text-align: left; "><br></p><p style="text-align: left; ">{EMAIL_SIGNATURE}<br></p></div>
                    <div class="social_links">
                        <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                        <a href="#"> <i class="fab fa-twitter"></i> </a>
                        <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                    </div>
                    <div class="email_invite_bottom">
                        </div>
                </div>
EOD
                            ,
                            'available_variable' => '{CLIENT_NAME}, {CASE_NAME}, {CASE_DATE},{CASE_URL},{EMAIL_SIGNATURE}',
                            'status' => true
                        ],

                        [
                            'name' => 'Leave Approved',
                            'type' => 'leave_approve',
                            'subject' => 'Leave Approved',
                            'value' => <<<'EOD'
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Document</title>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                                body{
                                    font-family: 'Poppins', sans-serif;
                                    margin: 0;
                                    padding: 0;
                                }
                                .email_invite_wrapper{
                                    background: #fff;
                                    text-align: center;
            
                                }
                                h1,h2,h3,h4,h5{
                                    color: #415094;
                                }
                                .btn_1 {
                                    display: inline-block;
                                    padding: 13.5px 45px;
                                    border-radius: 5px;
                                    font-size: 14px;
                                    color: #fff;
                                    -o-transition: all .4s ease-in-out;
                                    -webkit-transition: all .4s ease-in-out;
                                    transition: all .4s ease-in-out;
                                    text-transform: capitalize;
                                    background-size: 200% auto;
                                    border: 1px solid transparent;
                                    box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                                    background-image: -webkit-gradient(linear, right top, left top, from(#7c32ff), color-stop(50%, #c738d8), to(#7c32ff));
                                    background-image: -webkit-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                    background-image: -o-linear-gradient(right, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                    background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%);
                                }
                                .btn_1:hover {
                                    color: #fff !important;
                                    background-position: right center;
                                    box-shadow: 0px 10px 20px 0px rgba(108, 39, 255, 0.3);
                                }
            
                                .banner img{
                                    width: 100%;
                                }
                                .invitation_text {
                                    max-width: 500px;
                                    margin: 30px auto 0 auto
                                }
                                .invitation_text h3{
                                    font-size: 20px;
                                    text-transform: capitalize;
                                    color: #2F353D;
                                    margin-bottom: 10px;
                                    font-weight: 600;
                                }
                                .invitation_text p{
                                    font-family: "Poppins", sans-serif;
                                    line-height: 1.929;
                                    font-size: 16px;
                                    margin-bottom: 0px;
                                    color: #828bb2;
                                    font-weight: 300;
                                    margin: 10px 0 30px 0;
                                }
                                .invitation_text a{}
                                .logo{
                                    margin: 30px 0;
                                }
                                .social_links{
                                    background: #F4F4F8;
                                    padding: 15px;
                                    margin: 30px 0 30px 0;
                                }
                                .social_links a{
                                    display: inline-block;
                                    font-size: 15px;
                                    color: #252B33;
                                    padding: 5px;
                                }
                                .email_invite_bottom{
                                    text-align: center;
                                    margin: 20px 0 30px 0;
                                }
                                .email_invite_bottom p{
                                    font-size: 14px;
                                    font-weight: 400;
                                    color: #828bb2;
                                    text-transform: capitalize;
                                    margin-bottom: 0;
                                }
                                .email_invite_bottom a{
                                    font-size: 14px;
                                    font-weight: 500;
                                    color: #7c32ff  ;
            
                                }
                                a{
                                    text-decoration: none;
                                }
                            </style>
            
            
            
                            <div class="email_invite_wrapper text-center">
                                <div class="logo">
                                    <a href="#">
                                        <img src="https://spondan.com/advocate/public/uploads/settings/logo.png" alt="">
                                    </a>
                                </div>
                                
                                <div class="invitation_text">
                                    <h3>Leave Approved</h3>
                                    <p style="text-align: left; ">Hello {USER_NAME}, </p><p style="text-align: left; ">Your <a href="http://{LEAVE_URL}" target="_blank">leave</a> request for {LEAVE_REASONE} has approved by {APPROVED_BY}.</p><p style="text-align: left; ">Leave Start Date: {START_DATE}</p><p style="text-align: left; ">Leave End Date: {END_DATE}</p><p style="text-align: left; "><br></p><p style="text-align: left; ">{EMAIL_SIGNATURE}<br></p></div>
                                <div class="social_links">
                                    <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                    <a href="#"> <i class="fab fa-twitter"></i> </a>
                                    <a href="#"> <i class="fab fa-pinterest-p"></i> </a>
                                </div>
                                <div class="email_invite_bottom">
                                    </div>
                            </div>
EOD
                            ,
                            'available_variable' => '{USER_NAME},{EMAIL_SIGNATURE},{START_DATE},{END_DATE},{LEAVE_REASONE},{APPROVED_BY}',
                            'status' => true
                        ]

        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
}
