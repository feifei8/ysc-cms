<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_options')->insert([
            [
                'name' => 'website_keywords',
                'value' => 'yas cms',
            ],
            [
                'name' => 'company_address',
                'value' => '',
            ],
            [
                'name' => 'website_title',
                'value' => '凌宇升内容管理框架',
            ],
            [
                'name' => 'company_telephone',
                'value' => '800-168-8888',
            ],
            [
                'name' => 'company_full_name',
                'value' => '凌宇升络科技有限公司',
            ],
            [
                'name' => 'website_icp',
                'value' => '华ICP备88888888号'
            ],
            [
                'name' => 'system_version',
                'value' => '5.x',
            ],
            [
                'name' => 'page_size',
                'value' => '15',
            ],
            [
                'name' => 'system_logo',
                'value' => '/assets/img/yas_logo.png'
            ],
            [
                'name' => 'picture_watermark',
                'value' => '/assets/img/yas_logo.png',
            ],
            [
                'name' => 'company_short_name',
                'value' => '凌宇升',
            ],
            [
                'name' => 'system_author',
                'value' => '凌宇升',
            ],
            [
                'name' => 'system_author_website',
                'value' => 'http://lingyusheng.com'
            ],
            [
                'name' => 'is_watermark',
                'value' => '0',
            ],
        ]);
    }
}
