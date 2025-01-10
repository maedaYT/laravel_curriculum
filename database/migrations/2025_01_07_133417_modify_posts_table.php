<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->date('check_in_date')->nullable()->change();
            $table->date('check_out_date')->nullable()->change();
            $table->integer('guest_count')->nullable()->change();
            $table->integer('price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->change();
            $table->date('check_in_date')->change();
            $table->date('check_out_date')->change();
            $table->integer('guest_count')->change();
            $table->integer('price')->change();
        });
    }
}
