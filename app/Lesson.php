<?php

namespace App;
use App\Meta\LessonMeta;

class Lesson extends Post
{
    /**
     * @var string
     */
    protected $postType = 'lesson';

    public function course()
    {
        return $this->hasOne(LessonMeta::class, 'post_id')
            ->where('meta_key', 'course_id');
    }
}
