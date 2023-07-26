# laravel-forum

### 软件架构
软件架构说明
- [Laravel:8.75](https://github.com/laravel)
- PHP:7.3^8.0
- <font color='red'>禁止使用DB对数据进行删除</font>
  - 原因：`is_delete`的概念是自己封装的，无法兼容`DB::delete`删除逻辑，需手动调整为`DB::update(['is_delete' => 1, ……])`
  - 如需使用，两个步骤操作：
    - 请更换`App\Models\Model`的假删除引用为Laravel假删除模块
    - 且数据表需引入对应的删除字段  


### 安装教程
1. composer install
2. cp .env.example .env
3. 生成 APP_KEY：`php artisan key:generate`
4. jwt：`php artisan jwt:secret`
5. 数据表迁移 `php artisan migrate`
6. 创建`Storage`目录软链接 `php artisan storage:link`
   1. docker环境使用`php artisan storage:link --relative`
7. 数据库填充：`php artisan module:seed`
8. 可发布语言包：`php artisan lang:publish zh_CN/语言标识`
9. 发布编辑器`pandao/editor.md`相关文件：`php artisan vendor:publish --provider="Cnpscy\LaravelEditormd\EditorMdProvider"`

### 前端安装
- 为 NPM 和 Yarn 配置安装加速
  - npm config set registry=https://registry.npm.taobao.org
  - yarn config set registry https://registry.npm.taobao.org
- 使用 Yarn 安装依赖
  - SASS_BINARY_SITE=http://npm.taobao.org/mirrors/node-sass yarn
- 安装成功后，运行以下命令
  - npm run watch-poll
- 如遇错误`[webpack-cli] Error: Cannot find module 'laravel-mix-merge-manifest'`
  - 重新安装 `npm install laravel-mix-merge-manifest --save-dev`
- fa 动态效果相关文档
  - https://l-lin.github.io/font-awesome-animation/

### [功能列表](./功能列表.md)

### 感谢
- [Laravel](https://github.com/laravel)
- [L02 Laravel 教程 - Web 开发实战进阶](https://learnku.com/courses/laravel-intermediate-training/8.x)
- 编辑器：[pandao/editor.md](https://github.com/pandao/editor.md)
- [element](https://element.eleme.cn)
