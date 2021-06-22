<?php

use Modules\Localization\Entities\LanguagePhrase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagePhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_phrases', function (Blueprint $table) {
            // $table->collation = 'utf0_general_ci';
            // $table->charset = 'utf0';
            $table->id('id');
            $table->unsignedBigInteger('module_id')->nullable();
			$table->string('page_name')->nullable();
            $table->text('default_phrases')->nullable();
            $table->text('en')->nullable();
            $table->text('es')->nullable();
            $table->text('bn')->nullable();
            $table->text('fr')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });

        // $data = [
        //     [1,'dashboard' ,'dashboard', 'Dashboard', 'Tablero', 'ড্যাশবোর্ড', 'Tableau de bord']
        // ];
        //
        //
        // foreach ($data as $row) {
        //     $s = new LanguagePhrase();
        //     $s->module_id = $row[0];
        //     $s->page_name = $row[1];
        //     $s->default_phrases = trim($row[2]);
        //     $s->en = trim($row[3]);
        //     $s->es = trim($row[4]);
        //     $s->bn = trim($row[5]);
        //     $s->fr = trim($row[6]);
        //     $s->save();
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language_phrases');
    }
}
