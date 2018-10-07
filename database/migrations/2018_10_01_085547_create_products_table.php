<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->unsigned()->nullable()->default(0)->comment('分类id：文章分类id不为0，单页与碎片分类id默认为0');
            $table->string('title', 300)->nullable()->index('title')->comment('产品名称');
            $table->string('quality', 100)->nullable()->default('')->comment('产品质量');
            $table->string('barcode', 50)->nullable()->default('')->comment('条码');
            $table->string('certificateNo', 50)->nullable()->default('')->comment('证书编号');
            $table->string('goldContent', 50)->nullable()->default('')->comment('含金量');
            $table->string('enterpriseStandard', 100)->nullable()->default('')->comment('企业标准');
            $table->string('companyName', 200)->nullable()->default('')->comment('公司名称');
            $table->string('companyAddress', 200)->nullable()->default('')->comment('公司地址');
            $table->string('serviceTel', 50)->nullable()->default('')->comment('客服电话');
            $table->string('companyWebsite', 200)->nullable()->default('')->comment('公司网址');
            $table->string('testingFacility', 100)->nullable()->default('')->comment('检测机构');
            $table->string('companyTel', 50)->nullable()->default('')->comment('电话');
            $table->string('QRcode', 200)->nullable()->comment('二维码');
            $table->string('description')->nullable()->comment('备注');
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
        Schema::drop('products');
    }
}
