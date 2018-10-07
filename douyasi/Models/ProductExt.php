<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

class productExt extends Model
{
    protected $table = 'product_exts';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'pid',
                            'name',
                            'value',
                            'desc'
                        ];

    public function product()
    {
        //模型名 外键 本键
        return $this->hasOne('Douyasi\Models\Product', 'id', 'pid');
    }
}
