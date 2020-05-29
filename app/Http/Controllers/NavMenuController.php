<?php

namespace App\Http\Controllers;

use App\Course;
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
    private $menu, $position_menu, $post, $page, $tag, $taxonomy, $course;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->position_menu = new PositionMenu();
        $this->post = new Post();
        $this->page = new Page();
        $this->tag = new Tag();
        $this->taxonomy = new Taxonomy();
        $this->course = new Course();
    }

    public function getViewNavMenu()
    {
        $postion_menu_first = $this->position_menu->getAllPostionMenu()->first();
        $position_menu = $this->position_menu->getAllPostionMenu();
        $pages = $this->page->latest()->get();
        $posts = $this->post->type('post')->latest()->get();
        $tags = $this->tag->get();
        $category = $this->taxonomy->category()->get();
        $category_course = $this->taxonomy->name('course_cat')->get();
        $coursed = $this->course->get();
//return $coursed

        $menus = Menu::where('position_menu_id', $postion_menu_first->id)->whereNull('parent_id')->orderBy("sort", "ASC")->with('childrenMenus')->get();
        return view('admin.appearance.nav-menu', [
            'position_menu' => $position_menu,
            'pages' => $pages,
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $category,
            'menus' => $menus,
            'menus_editing' => $postion_menu_first,
            'category_course' => $category_course,
            'coursed' => $coursed,
        ]);
    }

    public function getMenuPosition($id)
    {
        return $menus = $this->position_menu->getPositionMenuByID($id);
    }


    public function getViewNavMenuByID($id)
    {
        $postion_menu_first = $this->position_menu->getPositionMenuByID($id);
        $position_menu = $this->position_menu->getAllPostionMenu();
        $pages = $this->page->latest()->get();
        $posts = $this->post->type('post')->latest()->get();
        $tags = $this->tag->get();
        $category = $this->taxonomy->category()->get();
        $category_course = $this->taxonomy->name('course_cat')->get();
        $coursed = $this->course->get();

        $menus = Menu::where('position_menu_id', $id)->whereNull('parent_id')->orderBy("sort", "ASC")->get();


        return view('admin.appearance.nav-menu', [
            'position_menu' => $position_menu,
            'pages' => $pages,
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $category,
            'menus' => $menus,
            'menus_editing' => $postion_menu_first,
            'category_course' => $category_course,
            'coursed' => $coursed,
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
        if (!empty($link) && !empty($label)) {
            return $this->menu->addMenuItem($link, $label, NULL, 0, $position);
        }
    }

    function saveMenuItem(array $arrMenu, $parent_id = null, $sort = 0)
    {
        foreach ($arrMenu as $key => $item) {
            $parent = $item['id'];
            $sort = $key;
            $this->menu->updateParentMenuItem($item['id'], $parent_id, $sort);
            if (!empty($item['children'])) {
                return $this->saveMenuItem($item['children'], $parent, $key);
            } else {
                $this->menu->updateParentMenuItem($item['id'], $parent_id, $sort);
            }
        }
    }

    public function saveMenu(Request $request)
    {
        $data = $request->data;
        return $this->saveMenuItem($request->data);
    }


    public function deleteMenuItem(Request $request)
    {
        return $this->menu->deleteMenuItem($request->id);
    }

    public function updateMenuPosition(Request $request)
    {
        $id = $request->update_id;
        $name = $request->name;
        $display_name = $request->display_name;
        if (!empty($name) && !empty($display_name)) {
            return $this->position_menu->updateMenuPostion($id, $name, $display_name);
        } else {
            return false;
        }
    }
}
