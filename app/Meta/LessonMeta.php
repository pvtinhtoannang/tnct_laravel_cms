<?php

namespace App\Meta;

use App\Lesson;

class LessonMeta extends PostMeta
{
    /**
     * @var array
     */
    protected $with = ['lessonMeta'];


    public function lessonMeta()
    {
        return $this->belongsTo(Lesson::class, 'meta_value');
    }
}
