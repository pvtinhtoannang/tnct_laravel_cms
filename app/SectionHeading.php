<?php

namespace App;

use App\Meta\SectionHeadingMeta;

class SectionHeading extends Post
{
    /**
     * @var string
     */
    protected $postType = 'section_heading';

    public function sectionHeading()
    {
        return $this->hasOne(SectionHeadingMeta::class, 'post_id')
            ->where('meta_key', 'course_id');
    }

    public function updateSectionHeading($id, $request)
    {
        $section_heading = $this->find($id);
        $section_heading->update($this->postRequest($request, $id));
    }
}
