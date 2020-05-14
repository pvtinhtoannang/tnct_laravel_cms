<?php

namespace App;

use App\Meta\CourseMeta;

class Course extends Post
{
    /**
     * @var string
     */
    protected $postType = 'course';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function price()
    {
        return $this->hasOne(CourseMeta::class, 'post_id')
            ->where('meta_key', 'course_price');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hot()
    {
        return $this->hasOne(CourseMeta::class, 'post_id')
            ->where('meta_key', 'course_hot');
    }
}
