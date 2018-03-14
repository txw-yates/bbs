<?php
namespace App\Handlers;

use Image;
use Symfony\Component\HttpFoundation\File\File;

class ImageUploadHandler
{
    protected $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * @param File $file
     * @param string $folder
     * @param string $file_prefix
     * @return array|bool
     */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        $folder_name = "upload/images/{$folder}/" . date('Ym', time()) . '/' . date('d', time()) . '/';

        $upload_path = public_path() . '/' . $folder_name;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $file_prefix . time() . '_' . str_random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        // 调整图片大小
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . '/' . $folder_name . $filename
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        $image = Image::make($file_path);

        $image->resize($max_width, null, function ($constraint) {
            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}