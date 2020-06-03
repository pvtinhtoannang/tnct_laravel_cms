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

    function FileSizeConvert($bytes)
    {
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
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
            $file_size = $file->getSize();
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
                'post_excerpt' => $file_name,
                'post_status' => 'inherit',
                'post_name' => $post_name,
                'post_type' => $this->post_type
            );
            $attachment = $this->attachment->create($postRequest);
            $metaRequest = array(
                'meta_key' => 'attached_file',
                'meta_value' => $this->year . '/' . $this->month . '/' . $file_name_generator,
            );
            $attachment->attached_file()->create($metaRequest);
            $attachment->attachment_type()->create([
                'meta_key' => 'attachment_type',
                'meta_value' => $file_extension,
            ]);
            $attachment->attachment_size()->create([
                'meta_key' => 'attachment_size',
                'meta_value' => $this->FileSizeConvert($file_size),
            ]);
        }
    }

    function getAttachedFile(Request $request)
    {
        $size = '';
        $type = '';
        $caption = '';
        $description = '';
        $path = '';
        $attachment = $this->attachment->find($request->id);
        if ($attachment->attachment_size) {
            $size = $attachment->attachment_size->meta_value;
        }
        if ($attachment->attachment_type) {
            $type = $attachment->attachment_type->meta_value;
        }
        if ($attachment->attachment_caption) {
            $caption = $attachment->attachment_caption->meta_value;
        }
        if ($attachment->attachment_description) {
            $description = $attachment->attachment_description->meta_value;
        }
        if ($attachment->attached_file) {
            $path = $attachment->attached_file->meta_value;
        }
        $attachment['size'] = $size;
        $attachment['type'] = $type;
        $attachment['caption'] = $caption;
        $attachment['description'] = $description;
        $attachment['path'] = $path;
        $attachment['upload_by'] = $attachment->author->name;
        return $attachment;
    }
}
