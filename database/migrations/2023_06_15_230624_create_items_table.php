<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('tire_id')->nullable();
            $table->string('tire_model')->nullable();
            $table->string('size', 100)->nullable();
            $table->string('number')->nullable();
            $table->string('tire_maker')->nullable();
            $table->string('inch', 100)->nullable();
            $table->string('year')->nullable();
            $table->string('oblateness')->nullable();
            $table->string('ditch', 100)->nullable();
            $table->string('eveluation')->nullable();
            // $table->integer('type_name')->nullable();
            $table->string('strength', 100)->nullable();
            $table->string('specification')->nullable();
            $table->string('foil')->nullable();
            $table->string('mime')->nullable();
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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('size', 100);
            $table->dropColumn('number');
            $table->dropColumn('tire_maker');
            $table->dropColumn('inch', 100);
            $table->dropColumn('year');
            $table->dropColumn('oblateness');
            $table->dropColumn('ditch', 100);
            $table->dropColumn('eveluation');
            $table->dropColumn('type_id');
            $table->dropColumn('strength', 100);
            $table->dropColumn('specification');
            $table->dropColumn('foil');
            $table->dropColumn('mime');
        });
    }
}
