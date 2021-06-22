<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Model\BusinessSettings;

class CreateBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("category_type", 200)->nullable();
            $table->string("type", 200)->nullable();
            $table->boolean("status")->default(0);
            $table->timestamps();
        });

        DB::table('business_settings')->insert([
            [
                'category_type' => null,
                'type' => 'email_verification',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => null,
                'type' => 'sms_verification',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => null,
                'type' => 'mail_notification',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => null,
                'type' => 'system_notification',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'beginning_stock_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'sale_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'sale_return_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'pos_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'purchase_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'purchase_return_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'commision_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'packing_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'retailer_add_balance_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'retailer_substraction_balance_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'add_balance_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'substraction_balance_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'voucher_payment_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'voucher_recieve_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'journal_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'contra_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'payroll_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'loan_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'voucher',
                'type' => 'expense_voucher_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'sale&purchase_type',
                'type' => 'sale_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'sale&purchase_type',
                'type' => 'sale_return_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'sale&purchase_type',
                'type' => 'purchase_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ],
            [
                'category_type' => 'sale&purchase_type',
                'type' => 'purchase_return_approval',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
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
        Schema::dropIfExists('business_settings');
    }
}
