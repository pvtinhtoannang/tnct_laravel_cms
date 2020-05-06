<?php

namespace App\Meta;

use App\Attachment;

class ThumbnailMeta extends PostMeta
{
    /**
     * @var array
     */
    protected $with = ['attachment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'meta_value');
    }
}
