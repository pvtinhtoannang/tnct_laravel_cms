<?php

namespace App;

use App\Builder\TaxonomyBuilder;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * @var string
     */
    protected $table = 'term_taxonomy';

    /**
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';

    /**
     * @var array
     */
    protected $with = ['term'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function posts()
    {
        return $this->belongsToMany(
            Post::class, 'term_relationships', 'term_taxonomy_id', 'object_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Taxonomy::class, 'parent');
    }

    /**
     * @param $taxonomy
     * @return mixed
     */
    public function tax($taxonomy)
    {
        return $this->where('taxonomy', $taxonomy);
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function parent_id($parent_id)
    {
        return $this->where('parent', $parent_id);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return TaxonomyBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new TaxonomyBuilder($query);
    }

    /**
     * @return TaxonomyBuilder
     */
    public function newQuery()
    {
        return isset($this->taxonomy) && $this->taxonomy ?
            parent::newQuery()->where('taxonomy', $this->taxonomy) :
            parent::newQuery();
    }
}
