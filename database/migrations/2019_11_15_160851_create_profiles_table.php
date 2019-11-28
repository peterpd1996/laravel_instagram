<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            // unsigneBigInteger là nó sẽ không có giá trị âm và nó sẽ bắt đầu từ 0 -> 4 tỉ bình thường int thì nó từ -2 tỉ -> 2ti
            $table->unsignedBigInteger('user_id');
            $table->string('profileImage')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            // laravel nó sẽ dùng thằng index để tốc độ truy xuất của laravel sẽ nhanh hơn rất nhiều 
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
