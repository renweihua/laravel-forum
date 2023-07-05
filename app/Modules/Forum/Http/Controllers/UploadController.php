<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Constants\HttpStatus;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends ForumController
{
    public function file(Request $request)
    {
        // 兼容`http://www.ipandao.com/editor.md/examples/image-upload.html`编辑器的结果结构
        $editor_result = [
            'success' => 0,
            'message' => '',
            'url' => ''
        ];
        $file_key = $request->input('file', 'file');
        if (!$request->hasFile($file_key)) {
            $editor_result['message'] = $msg = '请上传文件媒体[001]！';
            return $this->errorJson($msg, HttpStatus::BAD_REQUEST, [], $editor_result);
        }
        if (empty($request->file($file_key))){
            $editor_result['message'] = $msg = '请检查上传的媒体文件[002]！';
            return $this->errorJson($msg, HttpStatus::BAD_REQUEST, [], $editor_result);
        }

        $file = $request->file($file_key);

        $extension = $file->getClientOriginalExtension();

        $file_name = Str::random(50) . '.' . $extension;
        $folder = 'uploads';
        $key = (empty($folder) ? '' : ($folder . '/')) . date('Ym') . '/' . $file_name;
        $content = file_get_contents($file->getRealPath());

        Storage::put($key, $content);

        // 添加文件库记录
        $uploadFile = UploadFile::addRecord(
            $key,
            $file,
            config('filesystems.default', 'public'),
            trim(Storage::url(''), '/'),
            $file->getSize(),
            $file->getMimeType(),
            $extension
        );
        $editor_result['url'] = $path_url = $uploadFile->file_url;
        $editor_result['success'] = 1;
        $editor_result['message'] = $msg = '上传成功';
        return $this->successJson(compact('path_url'), $msg, array_merge(['path_url' => $path_url], $editor_result));
    }
}
