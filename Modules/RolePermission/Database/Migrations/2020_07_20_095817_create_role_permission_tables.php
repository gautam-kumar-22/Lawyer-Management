<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('permission_id')->nullable();
            $table->integer('role_id')->nullable()->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(1)->unsigned();
            $table->integer('updated_by')->default(1)->unsigned();
            $table->timestamps();

        });

        DB::statement("INSERT INTO `role_permission` (`id`, `permission_id`, `role_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 170, 3, 1, 1, 1, NULL, NULL),
(2, 171, 3, 1, 1, 1, NULL, NULL),
(3, 325, 3, 1, 1, 1, NULL, NULL),
(4, 177, 3, 1, 1, 1, NULL, NULL),
(5, 193, 3, 1, 1, 1, NULL, NULL),
(6, 194, 3, 1, 1, 1, NULL, NULL),
(7, 338, 3, 1, 1, 1, NULL, NULL),
(8, 339, 3, 1, 1, 1, NULL, NULL),
(9, 217, 3, 1, 1, 1, NULL, NULL),
(10, 218, 3, 1, 1, 1, NULL, NULL),
(11, 219, 3, 1, 1, 1, NULL, NULL),
(12, 220, 3, 1, 1, 1, NULL, NULL),
(13, 221, 3, 1, 1, 1, NULL, NULL),
(14, 222, 3, 1, 1, 1, NULL, NULL),
(15, 223, 3, 1, 1, 1, NULL, NULL),
(16, 224, 3, 1, 1, 1, NULL, NULL),
(17, 225, 3, 1, 1, 1, NULL, NULL),
(18, 226, 3, 1, 1, 1, NULL, NULL),
(19, 227, 3, 1, 1, 1, NULL, NULL),
(20, 228, 3, 1, 1, 1, NULL, NULL),
(21, 229, 3, 1, 1, 1, NULL, NULL),
(22, 230, 3, 1, 1, 1, NULL, NULL),
(23, 342, 3, 1, 1, 1, NULL, NULL),
(24, 343, 3, 1, 1, 1, NULL, NULL),
(25, 344, 3, 1, 1, 1, NULL, NULL),
(26, 231, 3, 1, 1, 1, NULL, NULL),
(27, 232, 3, 1, 1, 1, NULL, NULL),
(28, 320, 3, 1, 1, 1, NULL, NULL),
(29, 321, 3, 1, 1, 1, NULL, NULL),
(30, 233, 3, 1, 1, 1, NULL, NULL),
(31, 234, 3, 1, 1, 1, NULL, NULL),
(32, 235, 3, 1, 1, 1, NULL, NULL),
(33, 236, 3, 1, 1, 1, NULL, NULL),
(34, 237, 3, 1, 1, 1, NULL, NULL),
(35, 341, 3, 1, 1, 1, NULL, NULL),
(36, 289, 3, 1, 1, 1, NULL, NULL),
(37, 290, 3, 1, 1, 1, NULL, NULL),
(38, 291, 3, 1, 1, 1, NULL, NULL),
(39, 292, 3, 1, 1, 1, NULL, NULL),
(40, 293, 3, 1, 1, 1, NULL, NULL),
(41, 294, 3, 1, 1, 1, NULL, NULL),
(42, 261, 3, 1, 1, 1, NULL, NULL),
(43, 262, 3, 1, 1, 1, NULL, NULL),
(44, 263, 3, 1, 1, 1, NULL, NULL),
(45, 239, 3, 1, 1, 1, NULL, NULL),
(46, 315, 3, 1, 1, 1, NULL, NULL),
(47, 316, 3, 1, 1, 1, NULL, NULL),
(48, 317, 3, 1, 1, 1, NULL, NULL),
(49, 346, 3, 1, 1, 1, NULL, NULL),
(851, 1, 2, 1, 1, 1, NULL, NULL),
(852, 66, 2, 1, 1, 1, NULL, NULL),
(853, 170, 2, 1, 1, 1, NULL, NULL),
(854, 171, 2, 1, 1, 1, NULL, NULL),
(855, 172, 2, 1, 1, 1, NULL, NULL),
(856, 173, 2, 1, 1, 1, NULL, NULL),
(857, 174, 2, 1, 1, 1, NULL, NULL),
(858, 175, 2, 1, 1, 1, NULL, NULL),
(859, 176, 2, 1, 1, 1, NULL, NULL),
(860, 224, 2, 1, 1, 1, NULL, NULL),
(861, 225, 2, 1, 1, 1, NULL, NULL),
(862, 226, 2, 1, 1, 1, NULL, NULL),
(863, 203, 2, 1, 1, 1, NULL, NULL),
(864, 204, 2, 1, 1, 1, NULL, NULL),
(865, 205, 2, 1, 1, 1, NULL, NULL),
(866, 206, 2, 1, 1, 1, NULL, NULL),
(867, 177, 2, 1, 1, 1, NULL, NULL),
(868, 178, 2, 1, 1, 1, NULL, NULL),
(869, 179, 2, 1, 1, 1, NULL, NULL),
(870, 180, 2, 1, 1, 1, NULL, NULL),
(871, 181, 2, 1, 1, 1, NULL, NULL),
(872, 182, 2, 1, 1, 1, NULL, NULL),
(873, 183, 2, 1, 1, 1, NULL, NULL),
(874, 188, 2, 1, 1, 1, NULL, NULL),
(875, 189, 2, 1, 1, 1, NULL, NULL),
(876, 190, 2, 1, 1, 1, NULL, NULL),
(877, 191, 2, 1, 1, 1, NULL, NULL),
(878, 195, 2, 1, 1, 1, NULL, NULL),
(879, 196, 2, 1, 1, 1, NULL, NULL),
(880, 197, 2, 1, 1, 1, NULL, NULL),
(881, 198, 2, 1, 1, 1, NULL, NULL),
(882, 199, 2, 1, 1, 1, NULL, NULL),
(883, 200, 2, 1, 1, 1, NULL, NULL),
(884, 201, 2, 1, 1, 1, NULL, NULL),
(885, 202, 2, 1, 1, 1, NULL, NULL),
(886, 300, 2, 1, 1, 1, NULL, NULL),
(887, 301, 2, 1, 1, 1, NULL, NULL),
(888, 302, 2, 1, 1, 1, NULL, NULL),
(889, 303, 2, 1, 1, 1, NULL, NULL),
(890, 304, 2, 1, 1, 1, NULL, NULL),
(891, 305, 2, 1, 1, 1, NULL, NULL),
(892, 306, 2, 1, 1, 1, NULL, NULL),
(893, 307, 2, 1, 1, 1, NULL, NULL),
(894, 308, 2, 1, 1, 1, NULL, NULL),
(895, 309, 2, 1, 1, 1, NULL, NULL),
(896, 310, 2, 1, 1, 1, NULL, NULL),
(897, 311, 2, 1, 1, 1, NULL, NULL),
(898, 312, 2, 1, 1, 1, NULL, NULL),
(899, 313, 2, 1, 1, 1, NULL, NULL),
(900, 314, 2, 1, 1, 1, NULL, NULL),
(901, 315, 2, 1, 1, 1, NULL, NULL),
(902, 316, 2, 1, 1, 1, NULL, NULL),
(903, 317, 2, 1, 1, 1, NULL, NULL),
(904, 318, 2, 1, 1, 1, NULL, NULL),
(905, 319, 2, 1, 1, 1, NULL, NULL),
(906, 320, 2, 1, 1, 1, NULL, NULL),
(907, 321, 2, 1, 1, 1, NULL, NULL),
(908, 322, 2, 1, 1, 1, NULL, NULL),
(909, 323, 2, 1, 1, 1, NULL, NULL),
(910, 324, 2, 1, 1, 1, NULL, NULL),
(911, 325, 2, 1, 1, 1, NULL, NULL),
(912, 326, 2, 1, 1, 1, NULL, NULL),
(913, 327, 2, 1, 1, 1, NULL, NULL),
(914, 328, 2, 1, 1, 1, NULL, NULL),
(915, 329, 2, 1, 1, 1, NULL, NULL),
(916, 330, 2, 1, 1, 1, NULL, NULL),
(917, 332, 2, 1, 1, 1, NULL, NULL),
(918, 333, 2, 1, 1, 1, NULL, NULL),
(919, 334, 2, 1, 1, 1, NULL, NULL),
(920, 335, 2, 1, 1, 1, NULL, NULL),
(921, 337, 2, 1, 1, 1, NULL, NULL),
(922, 338, 2, 1, 1, 1, NULL, NULL),
(923, 339, 2, 1, 1, 1, NULL, NULL),
(924, 368, 2, 1, 1, 1, NULL, NULL),
(925, 340, 2, 1, 1, 1, NULL, NULL),
(926, 342, 2, 1, 1, 1, NULL, NULL),
(927, 343, 2, 1, 1, 1, NULL, NULL),
(928, 344, 2, 1, 1, 1, NULL, NULL),
(929, 345, 2, 1, 1, 1, NULL, NULL),
(930, 347, 2, 1, 1, 1, NULL, NULL),
(931, 348, 2, 1, 1, 1, NULL, NULL),
(932, 349, 2, 1, 1, 1, NULL, NULL),
(933, 350, 2, 1, 1, 1, NULL, NULL),
(934, 352, 2, 1, 1, 1, NULL, NULL),
(935, 353, 2, 1, 1, 1, NULL, NULL),
(936, 354, 2, 1, 1, 1, NULL, NULL),
(937, 355, 2, 1, 1, 1, NULL, NULL),
(938, 357, 2, 1, 1, 1, NULL, NULL),
(939, 358, 2, 1, 1, 1, NULL, NULL),
(940, 359, 2, 1, 1, 1, NULL, NULL),
(941, 360, 2, 1, 1, 1, NULL, NULL),
(942, 362, 2, 1, 1, 1, NULL, NULL),
(943, 363, 2, 1, 1, 1, NULL, NULL),
(944, 364, 2, 1, 1, 1, NULL, NULL),
(945, 365, 2, 1, 1, 1, NULL, NULL),
(946, 366, 2, 1, 1, 1, NULL, NULL),
(947, 367, 2, 1, 1, 1, NULL, NULL),
(948, 369, 2, 1, 1, 1, NULL, NULL),
(949, 371, 2, 1, 1, 1, NULL, NULL),
(950, 372, 2, 1, 1, 1, NULL, NULL),
(951, 373, 2, 1, 1, 1, NULL, NULL),
(952, 374, 2, 1, 1, 1, NULL, NULL),
(953, 376, 2, 1, 1, 1, NULL, NULL),
(954, 377, 2, 1, 1, 1, NULL, NULL),
(955, 378, 2, 1, 1, 1, NULL, NULL),
(956, 379, 2, 1, 1, 1, NULL, NULL),
(957, 381, 2, 1, 1, 1, NULL, NULL),
(958, 382, 2, 1, 1, 1, NULL, NULL),
(959, 383, 2, 1, 1, 1, NULL, NULL)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
    }
}
