<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->Integer('staff_id')->default(1)->unsigned();
            $table->Integer('role_id')->default(1)->unsigned();
            $table->double('basic_salary', 16,2)->nullable();
            $table->double('total_earning', 16,2)->nullable();
            $table->double('total_deduction', 16,2)->nullable();
            $table->double('gross_salary', 16,2)->nullable();
            $table->double('tax', 16,2)->nullable();
            $table->double('net_salary', 16,2)->nullable();
            $table->string('payroll_month')->nullable();
            $table->string('payroll_year')->nullable();
            $table->string('payroll_status')->nullable()->comment('NG for not generated, G for generated, P for paid');
            $table->string('payment_mode')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('note', 200)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('cheque_no')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->foreign("updated_by")->on("users")->references("id");
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
        Schema::dropIfExists('payrolls');
    }
}
