<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductExtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_exts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned()->nullable()->default(0)->comment('产品id：默认为0');
            $table->string('name', 100)->nullable()->index('name')->comment('属性名称');
            $table->string('value', 500)->nullable()->comment('属性值');
            $table->json('desc');
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
        Schema::drop('product_exts');
    }
}
