<?php

namespace App;

use App\Builder\PostBuilder;
use App\Meta\PostMeta;
use App\Meta\ThumbnailMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected static $postTypes = [];

    /**
     * @var array
     */
    protected $with = ['meta'];

    /**
     * @var integer
     */
    protected $slugAlias = 1;

    /**
     * @var array
     */
    protected $fillable = [
        'post_author',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'post_name',
        'post_type'
    ];

    private $term;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->term = new Term();
    }

    public function usersCourses()
    {
        return $this->belongsToMany('App\User', 'permission_post', 'post_id', 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class, 'term_relationships', 'object_id', 'term_taxonomy_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail()
    {
        return $this->hasOne(ThumbnailMeta::class, 'post_id')
            ->where('meta_key', 'thumbnail_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function meta()
    {
        return $this->hasOne(PostMeta::class, 'post_id');
    }

    /**
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->where('post_type', $type);
    }

    /**
     * @param array $types
     * @return mixed
     */
    public function typeIn(array $types)
    {
        return $this->whereIn('post_type', $types);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function slug($slug)
    {
        return $this->where('post_name', $slug);
    }

    public function post_id($post_id)
    {
        return $this->where('ID', $post_id);
    }

    /**
     * Create a new Eloquent query builder
     */
    public function newEloquentBuilder($query)
    {
        return new PostBuilder($query);
    }

    /**
     * Get a new query builder
     */
    public function newQuery()
    {
        return $this->postType ?
            parent::newQuery()->type($this->postType) :
            parent::newQuery();
    }

    public function slugGenerator($slug)
    {
        $post = $this->slug($slug)->first();
        if ($post !== null) {
            $newPostName = $slug . '-' . ++$this->slugAlias;
            return $this->slugGenerator($newPostName);
        } else {
            return $postName = $slug;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachment()
    {
        return $this->hasMany(Post::class, 'post_parent')
            ->where('post_type', 'attachment');
    }

    /**
     * @param $str
     * @return string|string[]|null
     */
    function toSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    /**
     * @param $post_tyle
     * @return array
     */
    function count_post($post_tyle)
    {
        $all = $this->type($post_tyle)->not_status('trash')->latest()->get();
        $trash = $this->type($post_tyle)->status('trash')->latest()->get();
        $pending = $this->type($post_tyle)->status('pending')->latest()->get();
        $draft = $this->type($post_tyle)->status('draft')->latest()->get();
        $publish = $this->type($post_tyle)->status('publish')->latest()->get();
        return array(
            'all' => count($all),
            'publish' => count($publish),
            'draft' => count($draft),
            'pending' => count($pending),
            'trash' => count($trash)
        );
    }

    /**
     * @param $request
     * @return array
     */
    function thumbnailRequest($request)
    {
        return array(
            'meta_key' => 'thumbnail_id',
            'meta_value' => $request->thumbnail_id,
        );
    }

    /**
     * @param $request
     * @param string $id
     * @return array
     */
    function postRequest($request, $id = '')
    {
        $post_content = '';
        $excerpt = '';
        if (isset($request->post_content)) {
            $post_content = $request->post_content;
        }

        if (isset($request->excerpt)) {
            $excerpt = $request->excerpt;
        }
        $user_id = Auth::user()->id;
        if ($id !== '') {
            $post_name = $request->post_name;
        } else {
            $post_name = $this->slugGenerator($this->toSlug($request->post_title));
        }
        return array(
            'post_author' => $user_id,
            'post_content' => $post_content,
            'post_title' => $request->post_title,
            'post_excerpt' => $excerpt,
            'post_status' => $request->post_status,
            'post_name' => $post_name,
            'post_type' => $request->post_type
        );
    }

    /**
     * @param $meta_key
     * @param $meta_value
     * @return array
     */
    function postMeta($meta_key, $meta_value)
    {
        return array(
            'meta_key' => $meta_key,
            'meta_value' => $meta_value,
        );
    }

    /**
     * @param $request
     * @return array
     */
    function taxonomyRequest($request)
    {
        $tags = explode(',', $request->post_tag);
        $tagData = array();
        $catData = array();
        if (empty($request->post_category)) {
            $cats = array("1");
        } else {
            $cats = $request->post_category;
        }
        foreach ($tags as $key => $tag) {
            if ($tag !== '') {
                $tagCheck = $this->term->slug($this->toSlug($tag))->first();
                if ($tagCheck == null) {
                    $termRequest = array(
                        'name' => $tag,
                        'slug' => $this->toSlug($tag),
                        'term_group' => 0
                    );
                    $term = $this->term->create($termRequest);
                    if ($term) {
                        $tagData[$key]['term_taxonomy_id'] = $term->term_id;
                        $taxonomyRequest = array(
                            'taxonomy' => 'post_tag',
                            'description' => '',
                            'parent' => 0,
                            'count' => 0
                        );
                        $term->taxonomy()->create($taxonomyRequest);
                    }
                } else {
                    $tagData[$key]['term_taxonomy_id'] = $tagCheck->term_id;
                }
            }
        }
        foreach ($cats as $key => $term_id) {
            $catData[$key]['term_taxonomy_id'] = $term_id;
        }
        return array_merge($catData, $tagData);
    }


    function updatePost($id, $request)
    {
        $post = self::find($id);
        $cats = array();
        foreach ($this->taxonomyRequest($request) as $term_id) {
            array_push($cats, $term_id['term_taxonomy_id']);
        }
        if ($post->thumbnail === null) {
            if (isset($request->thumbnail_id)) {
                $post->meta()->create($this->thumbnailRequest($request));
            }
        } else {
            $thumbnail = $post->meta()->find($post->thumbnail->meta_id);
            if (isset($request->thumbnail_id)) {
                $thumbnail->update($this->thumbnailRequest($request));
            } else {
                $thumbnail->delete();
            }
        }
        if ($post->lesson === null) {
            if (isset($request->course)) {
                $post->meta()->create($this->postMeta('course_id', $request->course));
            }
        } else {
            $course = $post->meta()->find($post->lesson->meta_id);
            if (isset($request->course)) {
                $course->update($this->postMeta('course_id', $request->course));
            } else {
                $course->delete();
            }
        }

        if ($post->price === null) {
            if (isset($request->course_price)) {
                $post->meta()->create($this->postMeta('course_price', $request->course));
            }
        } else {
            $course = $post->meta()->find($post->price->meta_id);
            if (isset($request->course_price)) {
                $course->update($this->postMeta('course_price', $request->course_price));
            } else {
                $course->update($this->postMeta('course_price', 0));
            }
        }

        if ($post->hot === null) {
            if (isset($request->course_hot)) {
                $post->meta()->create($this->postMeta('course_hot', $request->course_hot));
            }
        } else {
            $course = $post->meta()->find($post->hot->meta_id);
            if (isset($request->course_hot)) {
                $course->update($this->postMeta('course_hot', $request->course_hot));
            } else {
                $course->update($this->postMeta('course_hot', 0));
            }
        }

        $post->update($this->postRequest($request, $id));
        $post->taxonomies()->wherePivot('object_id', $id)->sync($cats);
    }

    function updateStatus($id, $post_type, $status)
    {
        $postData = $this->post_id($id)->type($post_type)->first();
        if ($postData === null) {
            return false;
        } else {
            $this->post_id($id)->update(array(
                    'post_status' => $status
                )
            );
            return true;
        }
    }
}
