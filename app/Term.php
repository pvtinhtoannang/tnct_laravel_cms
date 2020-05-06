<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @param $tax
     * @return void
     */
    function addCategory($name, $slug, $description, $parent, $tax)
    {
        if ($name != null && $slug != null) {
            if ($this->slug($slug)->first() == null) {
                $termRequest = array(
                    'name' => $name,
                    'slug' => $slug,
                    'term_group' => 0
                );
                $term = $this->create($termRequest);
                if ($term) {
                    if ($description === null) {
                        $category_description = '';
                    } else {
                        $category_description = $description;
                    }
                    $taxonomyRequest = array(
                        'taxonomy' => $tax,
                        'description' => $category_description,
                        'parent' => $parent,
                        'count' => 0
                    );
                    $term->taxonomy()->create($taxonomyRequest);
                }
            }
        }
    }
}
