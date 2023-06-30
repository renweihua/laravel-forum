<?php
namespace App\Modules\Forum\Handlers;

use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
