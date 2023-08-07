<?php
use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    function getLoginUserId(): int
    {
        return getLoginUser()->user_id ?? 0;
    }

    function getLoginUser()
    {
        return Auth::user()->load('userInfo');
    }

    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }

    function category_nav_active($category_id)
    {
        return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
    }

    function make_excerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return \Illuminate\Support\Str::limit($excerpt, $length);
    }


//快速修改.env文件
function modifyEnv(array $data)
{
    $envPath      = base_path() . DIRECTORY_SEPARATOR . '.env';
    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
    $contentArray->transform(function ($item) use ($data)
    {
        foreach ($data as $key => $value) {
            if (str_contains($item, $key)) {
                return $key . '=' . $value;
            }
        }
        return $item;
    });
    $content = implode($contentArray->toArray(), "\n");
    \Illuminate\Support\Facades\File::put($envPath, $content);
}

// 获取数据表的前缀
function get_db_prefix()
{
    return config('database.connections.' . config('database.default') . '.prefix');
}
