<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{

    /**
     * @param string $status
     * @return PostBuilder
     */
    public function status($status)
    {
        return $this->where('post_status', $status);
    }

    /**
     * @param string $type
     * @return PostBuilder
     */
    public function type($type)
    {
        return $this->where('post_type', $type);
    }

    /**
     * @param array $types
     * @return PostBuilder
     */
    public function typeIn(array $types)
    {
        return $this->whereIn('post_type', $types);
    }

    /**
     * @param string $slug
     * @return PostBuilder
     */
    public function slug($slug)
    {
        return $this->where('post_name', $slug);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function not_status($status)
    {
        return $this->where('post_status', '!=', $status);
    }

}
