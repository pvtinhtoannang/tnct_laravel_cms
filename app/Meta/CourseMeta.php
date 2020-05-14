<?php

namespace App\Meta;

use App\Course;

class CourseMeta extends PostMeta
{
    /**
     * @var array
     */
    protected $with = ['courseMeta'];


    public function courseMeta()
    {
        return $this->belongsTo(Course::class, 'meta_value');
    }
}
