
<?php

use Modules\Localization\Entities\SelectedLanguage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_languages', function (Blueprint $table) {
            $table->id();
            $table->string('language_name')->nullable();
            $table->string('native')->nullable();
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->string('language_universal')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        // $store = new SelectedLanguage();
        // $store->language_name = 'English';
        // $store->native = 'English';
        // $store->language_universal = 'en';
        // $store->lang_id = 19;
        // $store->status = 1;
        // $store->created_at = date('Y-m-d h:i:s');
        // $store->save();
        //
        // $store = new SelectedLanguage();
        // $store->language_name = 'Bengali';
        // $store->native = 'বাংলা';
        // $store->language_universal = 'bn';
        // $store->lang_id = 9;
        // $store->created_at = date('Y-m-d h:i:s');
        // $store->save();
        //
        // $store = new SelectedLanguage();
        // $store->language_name = 'Spanish';
        // $store->native = 'Español';
        // $store->language_universal = 'es';
        // $store->lang_id = 20;
        // $store->created_at = date('Y-m-d h:i:s');
        // $store->save();
        //
        //
        // $store->save();
        // $store = new SelectedLanguage();
        // $store->language_name = 'French';
        // $store->native = 'Français';
        // $store->language_universal = 'fr';
        // $store->lang_id = 28;
        // $store->created_at = date('Y-m-d h:i:s');
        // $store->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_languages');
    }
}
