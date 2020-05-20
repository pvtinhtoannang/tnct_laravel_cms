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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function video()
    {
        return $this->hasOne(LessonMeta::class, 'post_id')
            ->where('meta_key', 'video_link');
    }

    public function updateLesson($id, $request)
    {
        $lesson = $this->find($id);
        $lesson->update($this->postRequest($request, $id));
    }
}
