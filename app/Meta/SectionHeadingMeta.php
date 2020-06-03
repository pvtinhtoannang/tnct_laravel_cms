<?php

namespace App\Meta;

use App\Course;

class SectionHeadingMeta extends PostMeta
{
    /**
     * @var array
     */
    protected $with = ['sectionHeadingMeta'];


    public function sectionHeadingMeta()
    {
        return $this->belongsTo(Course::class, 'meta_value');
    }
}
