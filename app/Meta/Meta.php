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

    function key($key)
    {
        return $this->where('meta_key', $key)->first();
    }
}
