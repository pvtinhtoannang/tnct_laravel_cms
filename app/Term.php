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

    private $taxonomy;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->taxonomy = new Taxonomy();
    }

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
    function addTerm($name, $slug, $description, $parent, $tax)
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

    function updateTerm($name, $slug, $description, $parent, $tax, $term_id)
    {
        $term = $this->find($term_id);
        $termRequest = array(
            'name' => $name,
            'slug' => $slug,
            'term_group' => 0
        );
        if ($term) {
            $term->update($termRequest);
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
            $term->taxonomy()->update($taxonomyRequest);
        }
    }

    function deleteTerm($term_id)
    {
        $term = $this->find($term_id);
        if ($term) {
            $child_terms = $this->taxonomy->parent_id($term_id)->get();
            $taxonomy = $this->taxonomy->where('term_id', $term_id)->first();
            if ($child_terms->count() > 0) {
                $parent = $taxonomy->parent;
                foreach ($child_terms as $child_term) {
                    $child_term->update(['parent' => $parent]);
                }
            }
            $term->delete();
            $taxonomy->delete();
        }
    }
}
