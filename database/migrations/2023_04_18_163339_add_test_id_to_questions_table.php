<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestIdToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('test_id')->after('id');
            
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
}
