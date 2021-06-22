<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveDefinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_defines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role_id");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("leave_type_id");
            $table->integer("total_days")->default(0);
            $table->integer("max_forward")->default(0);
            $table->boolean("balance_forward")->default(0);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->timestamps();

            $table->foreign("leave_type_id")->on("leave_types")->references("id");
            $table->foreign("created_by")->on("users")->references("id");
            $table->foreign("updated_by")->on("users")->references("id");
            $table->foreign("role_id")->on("roles")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_defines');
    }
}
