<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionMenu extends Model
{

    protected $table = 'positions_menu';
    protected $fillable = ['name', 'display_name'];
    protected $primaryKey = 'id';
    public function menu()
    {
        return $this->hasMany('App\Menu');
    }

    public function getAllPostionMenu()
    {
        return self::orderBy('name', 'ASC')->get();
    }

    public function createPositionMenu($name, $display_name)
    {
        return self::create(['name' => $name, 'display_name' => $display_name]);
    }

    public function getPositionMenuByID($id)
    {
        return self::find($id);
    }

    public function updateMenuPostion($id, $name, $display_name)
    {
        $menup = $this->where('id', $id)->first()->update(['name'=>$name, 'display_name'=>$display_name]);
        return $menup;
    }
}
