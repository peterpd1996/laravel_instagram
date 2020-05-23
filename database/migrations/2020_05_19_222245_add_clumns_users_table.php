<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('band')->nullable()->comment('Khóa ních');
            $table->timestamp('time_band')->nullable()->comment('Thời gian khóa ních');
            $table->integer('count_band')->nullable()->comment('Số lần khóa ních');
            $table->tinyInteger('isadmin')->nullable()->comment('Admin');
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
            $table->dropColumn('band','time_band','count_band','isadmin');
        });
    }
}
