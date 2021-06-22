<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Staff;
use App\User;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50)->nullable();
            $table->integer('user_id')->nullable()->default(1)->unsigned();
            $table->string('phone', 20)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('bank_branch_name', 255)->nullable();
            $table->string('bank_account_name', 255)->nullable();
            $table->string('bank_account_no', 255)->nullable();
            $table->string('current_address', 255)->nullable();
            $table->string('permanent_address', 255)->nullable();
            $table->string('basic_salary', 255)->nullable();
            $table->string('employment_type', 150)->nullable();
            
            $table->tinyInteger('provisional_months')->default(0);
            $table->date('date_of_joining')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('leave_applicable_date')->nullable();
            $table->integer('carry_forward')->default(0);
            $table->boolean('is_carry_active')->default(0);
            $table->timestamps();
        });

        $users = User::all();
        foreach ($users as $user) {
            $staff = new Staff;
            $staff->user_id = $user->id;
            $staff->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
