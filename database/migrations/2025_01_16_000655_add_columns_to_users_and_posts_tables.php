<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersAndPostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_access_at')->nullable()->after('updated_at'); // 最終アクセス日時
            $table->timestamp('last_post_at')->nullable()->after('last_access_at'); // 最終投稿日時
            $table->integer('suspended_posts_count')->default(0)->after('last_post_at'); // 表示停止中の投稿件数
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->integer('reports_count')->default(0)->after('comment'); // 違反報告数
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_access_at', 'last_post_at', 'suspended_posts_count']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('reports_count');
        });
    }
}
