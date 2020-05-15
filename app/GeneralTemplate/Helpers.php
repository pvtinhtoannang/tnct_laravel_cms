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
    global $cpn_assets;
    $cpn_assets = url('/component-assets');
    register_style($cpn_assets . "/lib/bootstrap/css/bootstrap.min.css");
    register_style($cpn_assets . "/lib/font-awesome/css/font-awesome.min.css");
    register_style($cpn_assets . "/lib/mmenu/jquery.mmenu.all.css");
    register_style($cpn_assets . "/lib/slick/slick.css");
    register_style($cpn_assets . "/lib/slick/slick-theme.css");
    register_style($cpn_assets . "/css/reset.min.css");
    register_style($cpn_assets . "/css/style.css");
}

add_action('theme_footer', 'theme_script_footer');

function theme_script_footer()
{
    global $cpn_assets;
    register_script($cpn_assets . '/lib/jquery/dist/jquery.js');
    register_script($cpn_assets . '/lib/bootstrap/js/bootstrap.min.js');
    register_script($cpn_assets . '/lib/slick/slick.min.js');
    register_script($cpn_assets . '/lib/mmenu/jquery.mmenu.all.min.js');
    register_script($cpn_assets . '/js/script.js');
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

function the_title()
{
    global $post;
    if ($post) {
        echo $post->post_title;
    } else {
        echo '';
    }
}

function get_the_title()
{
    global $post;
    if ($post) {
        return $post->post_title;
    } else {
        return '';
    }
}

function the_archive_title()
{
    global $term;
    if ($term) {
        echo $term->name;
    } else {
        echo '';
    }
}

function get_the_archive_title()
{
    global $term;
    if ($term) {
        return $term->name;
    } else {
        return '';
    }
}

function get_permalink($id = '')
{
    $post = new Post();
    $post_data = $post->find($id);
    $option = new Option();
    if ($post_data) {
        return $option->getField('home') . '/' . $post_data->post_name;
    } else {
        return '';
    }
}

function the_permalink($id = '')
{
    $post = new Post();
    $post_data = $post->find($id);
    $option = new Option();
    if ($post_data) {
        echo $option->getField('home') . '/' . $post_data->post_name;
    } else {
        echo '';
    }
}

function get_term_link($term_id = '')
{
    $term = new Term();
    $term_data = $term->find($term_id);
    $option = new Option();
    if ($term_data) {
        return $option->getField('home') . '/' . $term_data->slug;
    } else {
        return '';
    }
}

function the_term_link($term_id = '')
{
    $term = new Term();
    $term_data = $term->find($term_id);
    $option = new Option();
    if ($term_data) {
        echo $option->getField('home') . '/' . $term_data->slug;
    } else {
        echo '';
    }
}
