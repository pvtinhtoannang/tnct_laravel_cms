<?php

namespace App;

use App\Meta\AttachmentMeta;

class Attachment extends Post
{
    /**
     * @var string
     */
    protected $postType = 'attachment';

    public function attached_file()
    {
        return $this->hasOne(AttachmentMeta::class, 'post_id')
            ->where('meta_key', 'attached_file');
    }

    public function attachment_type()
    {
        return $this->hasOne(AttachmentMeta::class, 'post_id')
            ->where('meta_key', 'attachment_type');
    }

    public function attachment_size()
    {
        return $this->hasOne(AttachmentMeta::class, 'post_id')
            ->where('meta_key', 'attachment_size');
    }

    public function attachment_caption()
    {
        return $this->hasOne(AttachmentMeta::class, 'post_id')
            ->where('meta_key', 'attachment_caption');
    }

    public function attachment_description()
    {
        return $this->hasOne(AttachmentMeta::class, 'post_id')
            ->where('meta_key', 'attachment_description');
    }
}
