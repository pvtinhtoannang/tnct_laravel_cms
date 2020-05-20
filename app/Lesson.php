<?php

namespace App;
use App\Meta\LessonMeta;

class Lesson extends Post
{
    /**
     * @var string
     */
    protected $postType = 'lesson';

    public function lesson()
    {
        return $this->hasOne(LessonMeta::class, 'post_id')
            ->where('meta_key', 'course_id');
    }

    public function updateLesson($id, $request)
    {
        $lesson = $this->find($id);
        $lesson->update($this->postRequest($request, $id));
    }
}
