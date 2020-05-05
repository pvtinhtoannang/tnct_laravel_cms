<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    private $uploads_path, $post_type, $post_name_num, $month, $year, $attachment;

    /**
     * UploadController constructor.
     */
    public function __construct()
    {
        $this->attachment = new Attachment();
        $this->post_type = 'attachment';
        $this->post_name_num = 1;
        $this->month = date('m');
        $this->year = date('Y');
        $this->uploads_path = public_path('/contents/uploads/' . $this->year . '/' . $this->month);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getUpload()
    {
        $attachments = $this->attachment->get();
        return view('admin.uploads.upload', ['attachments' => $attachments]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getUploadNew()
    {
        return view('admin.uploads.upload-new');
    }

    /**
     * @param string $path
     * @param string $file_name
     * @param string $base_name
     * @param string $file_extension
     * @return string|string[]
     */
    function fileNameGenerator($path = '', $file_name = '', $base_name = '', $file_extension = '')
    {
        $file_name = str_replace(" ", "-", $file_name);
        $file_path = $path . '/' . $file_name;
        if (!file_exists($file_path)) {
            return $file_name;
        } else {
            $new_file_name = $base_name . '-' . $this->post_name_num++ . '.' . $file_extension;
            return $this->fileNameGenerator($path, $new_file_name, $base_name, $file_extension);
        }
    }

    /**
     * @param Request $request
     */
    function postUploadNew(Request $request)
    {
        $files = $request->file('file');
        $user_id = Auth::user()->id;

        if (!is_array($files)) {
            $files = [$files];
        }

        if (!is_dir($this->uploads_path)) {
            mkdir($this->uploads_path, 0777, true);
        }
        $file_name = '';
        foreach ($files as $key => $file) {
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();
            $file_basename = basename($file_name, '.' . $file_extension);
            $file_name_generator = $this->fileNameGenerator($this->uploads_path, $file_name, $file_basename, $file_extension);
            $file->move($this->uploads_path, $file_name_generator);
            $post_name = basename($file_name_generator, '.' . $file_extension);
            $post_name = str_replace(" ", "-", $post_name);
            $postRequest = array(
                'post_author' => $user_id,
                'post_content' => '',
                'post_title' => $file_basename,
                'post_excerpt' => '',
                'post_status' => 'inherit',
                'post_name' => $post_name,
                'post_type' => $this->post_type
            );
            $attachment = $this->attachment->create($postRequest);
            $metaRequest = array(
                'meta_key' => 'attached_file',
                'meta_value' => $this->year . '/' . $this->month . '/' . $file_name_generator,
            );
            $attachment->meta()->create($metaRequest);
        }
    }
}
