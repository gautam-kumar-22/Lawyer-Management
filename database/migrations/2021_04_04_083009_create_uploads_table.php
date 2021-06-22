<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->nullable();

            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('case_id')->nullable();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');

            $table->foreignId('hearing_date_id')->nullable();
            $table->foreign('hearing_date_id')->references('id')->on('hearing_dates')->onDelete('cascade');

            $table->string('user_filename')->nullable();
            $table->string('filename')->nullable();
            $table->string('filepath')->nullable();
            $table->string('file_type')->nullable();

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
        Schema::table('uploads', function(Blueprint $table)
        {
            $table->dropForeign('uploads_user_id_foreign');
            $table->dropForeign('uploads_case_id_foreign');
            $table->dropForeign('uploads_hearing_date_id_foreign');
        });
        Schema::dropIfExists('uploads');
    }
}
