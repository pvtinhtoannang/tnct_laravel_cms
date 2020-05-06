<?php

namespace App\Meta;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'meta_id';

    /**
     * @var bool
     */
    public $timestamps = false;
}
