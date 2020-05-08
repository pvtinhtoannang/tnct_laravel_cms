<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menus';
    protected $fillable = ['label', 'link', 'parent_id', 'sort', 'positions_menu_id'];

    public function positionsMenu()
    {
        return $this->belongsTo('App\PositionMenu', 'positions_menu_id');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu', 'parent_id', 'id');
    }

    public function childrenMenus()
    {
        return $this->hasMany('App\Menu', 'parent_id', 'id')->with('menus');
    }


    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function addMenuItem($link = '', $label = '', $parent = 0, $sort = 0, $position = 1)
    {
        return self::create(['label' => $label, 'link' => $link, 'parent_id' => $parent, 'sort' => $sort, 'positions_menu_id' => $position]);
    }

    public function updateInformationMenuItem($id, $link = '', $label = '')
    {
        return self::find($id)->update(['link' => $link, 'label' => $label]);
    }

    public function updateParentMenuItem($id, $parent, $sort)
    {
        return self::find($id)->update(['parent_id' => $parent, 'sort' => $sort]);
    }

    public function deleteMenuItem($id)
    {
        return self::find($id)->delete();
    }


}
