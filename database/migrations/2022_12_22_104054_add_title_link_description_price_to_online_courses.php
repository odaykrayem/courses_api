<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleLinkDescriptionPriceToOnlineCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_courses', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->longText('description')->nullable()->after('title');
            $table->longText('link')->after('description');
            $table->integer('price')->nullable()->after('link');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('online_courses', function (Blueprint $table) {
            //
        });
    }
}
