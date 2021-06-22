<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Leave\Entities\LeaveType;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->boolean("status")->default(1);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->foreign("updated_by")->on("users")->references("id");
            $table->timestamps();
        });


        LeaveType::insert([

            [
                'name' => 'Sick Leave',
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'name' => 'Annual Leave',
                'created_by' => 1,
                'updated_by' => 1
            ],



        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
