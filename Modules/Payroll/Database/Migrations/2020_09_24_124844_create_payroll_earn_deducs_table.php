<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollEarnDeducsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_earn_deducs', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->nullable();
            $table->float('amount', 10, 2)->nullable();
            $table->string('earn_dedc_type')->length(5)->nullable()->comment('e for earnings and d for deductions');
            $table->tinyInteger('active_status')->default(1);
            $table->tinyInteger('loan_status')->default(0);
            $table->Integer('payroll_id')->default(1)->unsigned();
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
        Schema::dropIfExists('payroll_earn_deducs');
    }
}
