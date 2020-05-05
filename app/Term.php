<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'term_group'
    ];

    /**
     * @var integer
     */
    protected $slugAlias = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class, 'term_id');
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function slug($slug)
    {
        return $this->where('slug', $slug);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function slugGenerator($slug)
    {
        if ($this->slug($slug)->first() == null) {
            return $slug;
        } else {
            $newSlug = $slug . '-' . $this->slugAlias++;
            return $this->slugGenerator($newSlug);
        }
    }
}
