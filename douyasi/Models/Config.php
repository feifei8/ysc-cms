<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    protected $table = 'configs';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'name',
                            'value',
                            'sort',
                            'desc'
                        ];
}
