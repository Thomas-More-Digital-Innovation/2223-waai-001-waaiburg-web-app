<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("questions", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tree_part_id")->nonNull();
            $table->unsignedBigInteger("question_list_id")->nonNull();
            $table->string("content")->nonNull();
            $table->timestamps();

            $table
            ->foreign("tree_part_id")
            ->references("id")
            ->on("tree_parts");

            $table
            ->foreign("question_list_id")
            ->references("id")
            ->on("question_lists");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("questions");
    }
};
