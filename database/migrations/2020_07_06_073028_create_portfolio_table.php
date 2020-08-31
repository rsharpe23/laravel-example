<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->integer('price')->nullable();
            $table->integer('days_amount')->nullable();

            // Один ко многим
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('work_types')->onDelete('set null');

            // Один к одному
            $table->integer('attachment_id')->unsigned()->nullable();
            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('set null');

            // Один к одному
            $table->integer('link_id')->unsigned()->nullable();
            // TODO: Поменять на каскадное удаление ссылки
            $table->foreign('link_id')->references('id')->on('links')->onDelete('set null');

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
        Schema::dropIfExists('portfolio');
    }
}
