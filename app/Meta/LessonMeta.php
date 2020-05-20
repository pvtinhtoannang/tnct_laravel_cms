<?php

namespace App\Meta;

use App\Course;

class LessonMeta extends PostMeta
{
    /**
     * @var array
     */
    protected $with = ['lessonMeta'];


    public function lessonMeta()
    {
        return $this->belongsTo(Course::class, 'meta_value');
    }
}
