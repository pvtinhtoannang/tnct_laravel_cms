<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Page;
use App\Menu;
use App\Taxonomy;
use App\PositionMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NavMenuController extends Controller
{
    private $menu, $position_menu, $post, $page, $tag, $taxonomy;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->position_menu = new PositionMenu();
        $this->post = new Post();
        $this->page = new Page();
        $this->tag = new Tag();
        $this->taxonomy = new Taxonomy();
    }

    public function getViewNavMenu()
    {
        $position_menu = $this->position_menu->getAllPostionMenu();
        $pages = $this->page->latest()->get();
        $posts = $this->post->type('post')->latest()->get();
        $tags = $this->tag->get();
        $category = $this->taxonomy->category()->get();
        $menus = Menu::where('positions_menu_id', 1)->where('parent', 0)->with('childrenMenus')->get();
        return view('admin.appearance.nav-menu', [
            'position_menu' => $position_menu,
            'pages' => $pages,
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $category,
            'menus' => $menus
        ]);
    }

    public function addPositionMenu(Request $request)
    {

        $rules = [
            'name' => 'required|unique:positions_menu',
            'display_name' => 'required',
        ];
        $messages = [
            'name.required' => 'Nhãn bạn đã quên điền, nó không có được để trống!',
            'name.unique' => 'Nhãn này đã có rồi nhe, tìm ở ô search bên kia nè',
            'display_name.required' => 'Điền ô tên hiển thị cho mọi người đọc nhe',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $this->position_menu->createPositionMenu($request->name, $request->display_name);
            return redirect()->back()->with('messages', 'Cập nhật thành công!');
        }

    }

    public function updateMenuItem(Request $request)
    {
        $id = $request->id;
        $link = $request->link;
        $label = $request->label;
        if (!empty($id) && !empty($link) && !empty($label)) {
            echo json_encode($this->menu->updateInformationMenuItem($id, $link, $label));
            exit;
        }
        exit;
    }

    public function addMenuItem(Request $request)
    {
        $label = $request->label;
        $link = $request->link;
        $position = $request->position;
        if(!empty($link) && !empty($label)){
            return $this->menu->addMenuItem($link, $label);
        }
    }


}
