<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'title',
                            'cid',
                            'quality',
                            'barcode',
                            'certificateNo',
                            'goldContent',
                            'enterpriseStandard',
                            'companyName',
                            'companyAddress',
                            'serviceTel',
                            'companyWebsite',
                            'testingFacility',
                            'companyTel',
                            'QRcode'

                        ];

    public function category()
    {
        //模型名 外键 本键
        return $this->hasOne('Douyasi\Models\Category', 'id', 'cid');
    }
}
