<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollPaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->Integer('staff_id')->nullable()->unsigned();
            $table->Integer('payroll_id')->nullable()->unsigned();

            $table->string('payment_method');

            $table->string('payroll_month')->nullable();
            $table->string('payroll_year')->nullable();

            $table->date('payment_date')->nullable();
            $table->text('note')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('account_no')->nullable();

            $table->Integer('pay_amount')->nullable();

            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_payment_logs');
    }
}
