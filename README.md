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

### 功能列表
- [X] 会员权限组 /user-group
- [ ] 消息通知列表
  + [X] 动态评论
- [X] 活跃会员；定时脚本：每小时自动更新一次
- [X] 会员最后活跃时间计算
- [X] 动态标题的seo自动转换
- [X] 登录会员切换工具 sudo-su
  - 发布资源文件`php artisan vendor:publish --provider="VIACreative\SudoSu\ServiceProvider"`
- [X] 返回页面顶部的小工具
- [X] 文件上传，兼容`pandao/editor.md`编辑器的结构 /api/upload

#### 动态相关
  + [ ] 动态详情
    + [X] 动态渲染
    + [X] 作者渲染
    + [X] 评论列表
    + [X] 访问量
    + [X] 点赞 /api/dynamics/praise
      + 动态渲染
    + [X] 收藏 /api/dynamics/collection
      + 动态渲染
    + [X] 评论
      * [X] 评论之后，给动态创建人发送Job通知消息；如果评论本身就是动态创建人，则无需发送。
      * [X] 发送邮件通知
      * [ ] 回复评论
    * [X] 删除评论
    * [X] 作者信息
      - [X] 作者的文章、粉丝、点赞与收藏统计
  + [X] 发布
    + [X] 仅限文章类型
    + [X] 发布之后，更新所属话题的动态数量
  + [X] 编辑
      + [X] 更新原始与所属话题的动态数量
  + [X] 删除
    * [X] 同步删除`未删除`的评论 

##### 会员相关
- [X] 话题列表
- [X] 个人主页
  + [X] 我的动态
  + [X] 我的评论

##### 话题
- [X] 话题的动态列表 /topic/话题Id
- [ ] 话题详情

### 感谢
- [Laravel](https://github.com/laravel)
- [tabler](https://github.com/tabler/tabler)
