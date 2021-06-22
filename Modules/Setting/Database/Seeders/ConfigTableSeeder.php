<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Config;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Config::insert([
            [
                'key' => 'site_title',
                'value' => 'Infix Advocate'
            ],
            [
                'key' => 'company_name',
                'value' => ''
            ],
            [
                'key' => 'country_id',
                'value' => '18'
            ],
            [
                'key' => 'company_info',
                'value' => ''
            ],
            [
                'key' => 'file_supported',
                'value' => ''
            ],
            [
                'key' => 'zip_code',
                'value' => ''
            ],
            [
                'key' => 'vat_number',
                'value' => ''
            ],
            [
                'key' => 'address',
                'value' => '89/2 Panthapath, Dhaka 1215, Bangladesh'
            ],
            [
                'key' => 'phone',
                'value' => '+8801841412141'
            ],
            [
                'key' => 'email',
                'value' => 'info@infix.com'
            ],
            [
                'key' => 'currency',
                'value' => 2
            ],
            [
                'key' => 'currency_symbol',
                'value' => '$'
            ],
            [
                'key' => 'promotionSetting',
                'value' => '0'
            ],
            [
                'key' => 'site_logo',
                'value' => 'public/uploads/settings/logo.png'
            ],
            [
                'key' => 'favicon_logo',
                'value' => 'public/uploads/settings/favicon.png'
            ],
            [
                'key' => 'system_version',
                'value' => '1.0.3'
            ],
            [
                'key' => 'active_status',
                'value' => '1'
            ],

            [
                'key' => 'currency_code',
                'value' => 'USD'
            ],
            [
                'key' => 'language_name',
                'value' => 'en'
            ],
            [
                'key' => 'system_purchase_code',
                'value' => ''
            ],
            [
                'key' => 'system_activated_date',
                'value' => ''
            ],
            [
                'key' => 'envato_user',
                'value' => ''
            ],
            [
                'key' => 'envato_item_id',
                'value' => ''
            ],

            [
                'key' => 'system_domain',
                'value' => ''
            ],
            [
                'key' => 'copyright_text',
                'value' => 'Copyright © 2020 - 2021 All rights reserved | This application is made by <a href="https://codecanyon.net/user/codethemes" target="_blank"><font color="#ff0000">Codethemes</font></a>'
            ],
            [
                'key' => 'website_btn',
                'value' => '1'
            ],
            [
                'key' => 'dashboard_btn',
                'value' => '1'
            ],
            [
                'key' => 'report_btn',
                'value' => '1'
            ],
            [
                'key' => 'style_btn',
                'value' => '1'
            ],
            [
                'key' => 'ltl_rtl_btn',
                'value' => '0'
            ],
            [
                'key' => 'ltl_rtl_btn',
                'value' => '1'
            ],
            [
                'key' => 'lang_btn',
                'value' => '1'
            ],
            [
                'key' => 'website_url',
                'value' => ''
            ],
            [
                'key' => 'ttl_rtl',
                'value' => 0
            ],
            [
                'key' => 'phone_number_privacy',
                'value' => '1'
            ],
            [
                'key' => 'time_zone_id',
                'value' => '1'
            ],
            [
                'key' => 'language_id',
                'value' => '19'
            ],
            [
                'key' => 'date_format_id',
                'value' => 1
            ],
            [
                'key' => 'software_version',
                'value' => ''
            ],
            [
                'key' => 'mail_signature',
                'value' => ''
            ],
            [
                'key' => 'mail_header',
                'value' => ''
            ],
            [
                'key' => 'mail_footer',
                'value' => ''
            ],
            [
                'key' => 'mail_protocol',
                'value' => 'sendmail'
            ],

            [
                'key' => 'preloader',
                'value' => 'infix'
            ],
            [
                'key' => 'payment_gateway',
                'value' => ''
            ],
            [
                'key' => 'terms_conditions',
                'value' => ''
            ],
            [
                'key' => 'login_backgroud_image',
                'value' => 'public/login-asset/img/advocate.jpg'
            ],
            [
                'key' => 'last_updated_date',
                'value' => ''
            ]

        ]);


    }
}
