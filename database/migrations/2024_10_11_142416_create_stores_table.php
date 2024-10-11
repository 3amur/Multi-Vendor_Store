<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id(); // unSigned bigInteger not Null auto Increment
            $table->string('name'); // varchar(255)
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // varchar(255)
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
