<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Model\GeneralSetting;


class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country_name')->nullable();
            $table->longText('company_info')->nullable();
            $table->Text('file_supported')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('currency')->nullable()->default('USD');
            $table->string('currency_symbol')->nullable()->default('$');
            $table->integer('promotionSetting')->nullable()->default(0);
            $table->string('logo')->default('uploads/settings/logo.png');
            $table->string('favicon')->default('uploads/settings/favicon.png');
            $table->string('system_version')->nullable()->default('1.0');
            $table->integer('active_status')->nullable()->default(1);
            $table->string('currency_code')->nullable()->default('USD');
            $table->string('language_name')->nullable()->default('en');
            $table->string('system_purchase_code')->nullable();
            $table->date('system_activated_date')->nullable();
            $table->string('envato_user')->nullable();
            $table->string('envato_item_id')->nullable();
            $table->string('system_domain')->nullable();
            $table->string('copyright_text')->nullable();
            $table->integer('website_btn')->default(1);
            $table->integer('dashboard_btn')->default(1);
            $table->integer('report_btn')->default(1);
            $table->integer('style_btn')->default(1);
            $table->integer('ltl_rtl_btn')->default(1);
            $table->integer('lang_btn')->default(1);
            $table->string('website_url')->nullable();
            $table->integer('ttl_rtl')->default(2);
            $table->integer('phone_number_privacy')->default(1)->comment('1 = enable, 0 = disable');
            $table->integer('time_zone_id')->nullable();
            $table->integer('language_id')->nullable()->default(19)->unsigned();
            $table->integer('date_format_id')->nullable()->default(1)->unsigned();
            $table->string('software_version', 100)->nullable();
            $table->string('mail_signature')->nullable();
            $table->longText('mail_header')->nullable();
            $table->longText('mail_footer')->nullable();
            $table->string('mail_protocol', 100)->nullable();
            $table->string('preloader', 100)->nullable()->default('infix');
            $table->integer('payment_gateway')->default(1)->comment('1 => cash ,2 => bank');
            $table->text('terms_conditions')->nullable();
            $table->timestamps();
        });


        // $sql_path = base_path('sql.sql');
        // DB::unprepared(file_get_contents($sql_path));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
