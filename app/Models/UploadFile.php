<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class UploadFile extends Model
{
    protected $primaryKey = 'file_id';
    protected $is_delete = 0;

    protected $appends = ['file_url'];

    public function getFileUrlAttribute($key)
    {
        if ($this->attributes['storage'] == 'public'){
            return Storage::url($this->attributes['file_name']);
        }
        // 非本地文件，获取文件时自动追加域名
        return $this->attributes['host_url'] . '/' . trim($this->attributes['file_name'],'/');
    }

    public function setFileNameAttribute($key): void
    {
        // 非本地文件上传，存储文件时自动移除域名
        if ($this->attributes['storage'] != 'public'){
            $key = str_replace($this->attributes['host_url'], '', $key);
        }
        $this->attributes['file_name'] = $key;
    }

    /**
     * 添加文件库上传记录
     *
     * @param  string  $file_name
     * @param          $file
     * @param  string  $storage  存储引擎
     * @param  string  $host_url 存储域名
     *
     * @return UploadFile
     */
    public static function addRecord(string $file_name, $file, $storage = 'public', $host_url = '', int $file_size = 0, $file_type = 'image/jepg', $extension = 'jpg')
    {
        // 添加文件库记录
        return UploadFile::create([
            'storage' => $storage,
            'host_url' => $host_url,
            'file_name' => $file_name,
            'file_size' => is_string($file) ? $file_size : $file->getSize(),
            'file_type' => is_string($file) ? $file_type : $file->getMimeType(),
            'extension' => is_string($file) ? $extension : $file->getClientOriginalExtension(),
        ]);
    }
}
