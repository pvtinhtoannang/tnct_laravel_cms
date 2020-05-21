<?php
/**
 * User: NFSociety
 * Date: 27/04/2020
 * Time: 3:37 CH
 */

use App\Page;
use App\Post;
use App\Option;
use App\Term;

function theme_head()
{
    do_action('theme_head');
}

function theme_footer()
{
    do_action('theme_footer');
}

function register_style($src, $media = 'all')
{
    echo "<link rel='stylesheet' href='" . $src . "' media='" . $media . "'/>\n";
}

function register_script($src, $in_footer = false)
{
    echo "<script  src='" . $src . "'></script>\n";
}

add_action('theme_head', 'theme_styles');

function theme_styles()
{
    $component_assets = url('/component-assets');
    register_style($component_assets . "/lib/bootstrap/css/bootstrap.min.css");
    register_style($component_assets . "/lib/font-awesome/css/font-awesome.min.css");
    register_style($component_assets . "/lib/mmenu/jquery.mmenu.all.css");
    register_style($component_assets . "/lib/slick/slick.css");
    register_style($component_assets . "/lib/slick/slick-theme.css");
    register_style($component_assets . "/css/reset.min.css");
    register_style($component_assets . "/css/style.css");
}

add_action('theme_footer', 'theme_script_footer');

function theme_script_footer()
{
    $component_assets = url('/component-assets');
    register_script($component_assets . '/lib/jquery/dist/jquery.js');
    register_script($component_assets . '/lib/bootstrap/js/bootstrap.min.js');
    register_script($component_assets . '/lib/slick/slick.min.js');
    register_script($component_assets . '/lib/mmenu/jquery.mmenu.all.min.js');
    register_script($component_assets . '/js/script.js');
}

function is_page($page = '')
{
    global $post;
    $page_model = new Page();
    if (!is_null($page_model->slug($page)->first()) && $page === $post->post_name) {
        return $page_model->slug($page)->first();
    } else if (!is_null($page_model->find($page)) && $page === $post->ID) {
        return $page_model->find($page);
    } else if ($page === '' && $post->post_type === 'page') {
        return $post;
    } else {
        return null;
    }
}

function render_slider($id, $class = '', $id_slider_custom = '')
{
    $slider = new \App\Slider();
    $slider_data = $slider->find($id)->post_content;
    if (!empty($slider_data)) { ?>
        <div class="tnct-slider-<?= $id ?>" class="<?= $class ?>" id="<?= $id_slider_custom ?>">
            <?php foreach (json_decode($slider_data) as $value) { ?>

            <?php } ?>
        </div>
    <?php }

}
