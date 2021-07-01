<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blogger_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 200);
            $table->text('content');
            $table->string('thumbnail');
            $table->string('cover');
            $table->enum('topic', ['Science', 'Sports', 'Movies', 'Music', 'Literature']);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('posts');
    }
}
