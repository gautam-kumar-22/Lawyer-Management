<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('attendance', 50)->default('P');
            $table->date('date')->nullable();
            $table->string('day',30)->nullable();
            $table->string('month',30)->nullable();
            $table->Integer('year')->nullable();
            $table->string('note', 255)->nullable();
            $table->Integer('user_id')->default(1)->unsigned();
            $table->Integer('role_id')->default(1)->unsigned();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->foreign("updated_by")->on("users")->references("id");
            $table->timestamps();
        });
        DB::statement("INSERT INTO `attendances` (`id`, `attendance`, `date`, `month`, `day`, `year`, `note`, `user_id`, `role_id`, `created_by`, `updated_by`) VALUES
        (1, 'P', '2020-08-01', 'August', 'Monday', '2020', 'note', '1', '1', '1', '1'),
        (2, 'P', '2020-08-02', 'August', 'Tuesday', '2020', 'note', '1', '1', '1', '1'),
        (3, 'P', '2020-08-03', 'August', 'Wednessday', '2020', 'note', '1', '1', '1', '1'),
        (4, 'A', '2020-08-04', 'August', 'Thursday', '2020', 'note', '1', '1', '1', '1'),
        (5, 'P', '2020-08-05', 'August', 'Friday', '2020', 'note', '1', '1', '1', '1'),
        (6, 'L', '2020-08-06', 'August', 'Saturday', '2020', 'note', '1', '1', '1', '1'),
        (7, 'P', '2020-08-07', 'August', 'Sunday', '2020', 'note', '1', '1', '1', '1'),
        (8, 'P', '2020-08-08', 'August', 'Monday', '2020', 'note', '1', '1', '1', '1'),
        (9, 'P', '2020-08-09', 'August', 'Tuesday', '2020', 'note', '1', '1', '1', '1'),
        (10, 'P', '2020-08-10', 'August', 'Wednessday', '2020', 'note', '1', '1', '1', '1'),
        (11, 'A', '2020-08-11', 'August', 'Thursday', '2020', 'note', '1', '1', '1', '1'),
        (12, 'P', '2020-08-12', 'August', 'Friday', '2020', 'note', '1', '1', '1', '1'),
        (13, 'P', '2020-08-13', 'August', 'Saturday', '2020', 'note', '1', '1', '1', '1'),
        (14, 'A', '2020-08-14', 'August', 'Sunday', '2020', 'note', '1', '1', '1', '1'),
        (15, 'P', '2020-08-15', 'August', 'Monday', '2020', 'note', '1', '1', '1', '1'),
        (16, 'P', '2020-08-16', 'August', 'Tuesday', '2020', 'note', '1', '1', '1', '1'),
        (17, 'F', '2020-08-17', 'August', 'Wednessday', '2020', 'note', '1', '1', '1', '1'),
        (18, 'P', '2020-08-18', 'August', 'Thursday', '2020', 'note', '1', '1', '1', '1'),
        (19, 'P', '2020-08-19', 'August', 'Friday', '2020', 'note', '1', '1', '1', '1'),
        (20, 'P', '2020-08-20', 'August', 'Saturday', '2020', 'note', '1', '1', '1', '1'),
        (21, 'P', '2020-08-21', 'August', 'Sunday', '2020', 'note', '1', '1', '1', '1'),
        (22, 'P', '2020-08-22', 'August', 'Monday', '2020', 'note', '1', '1', '1', '1'),
        (23, 'P', '2020-08-23', 'August', 'Tuesday', '2020', 'note', '1', '1', '1', '1'),
        (24, 'P', '2020-08-24', 'August', 'Wednessday', '2020', 'note', '1', '1', '1', '1'),
        (25, 'P', '2020-08-25', 'August', 'Thursday', '2020', 'note', '1', '1', '1', '1'),
        (26, 'P', '2020-08-26', 'August', 'Friday', '2020', 'note', '1', '1', '1', '1'),
        (27, 'F', '2020-08-27', 'August', 'Saturday', '2020', 'note', '1', '1', '1', '1'),
        (28, 'P', '2020-08-28', 'August', 'Sunday', '2020', 'note', '1', '1', '1', '1'),
        (29, 'A', '2020-08-29', 'August', 'Monday', '2020', 'note', '1', '1', '1', '1'),
        (30, 'L', '2020-08-30', 'August', 'Tuesday', '2020', 'note', '1', '1', '1', '1')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
