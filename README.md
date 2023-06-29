# laravel-forum

### 软件架构
软件架构说明
- [Laravel:8.75](https://github.com/laravel)
- PHP:7.3^8.0
- 模板:[tabler](https://github.com/tabler/tabler)


### 安装教程
1. composer install
2. cp .env.example .env
3. 生成 APP_KEY：`php artisan key:generate`
4. 数据表迁移 `php artisan migrate`
5. 创建`Storage`目录软链接 `php artisan storage:link`
6. 数据库填充：`php artisan module:seed`
7. 可发布语言包：`php artisan lang:publish zh_CN/语言标识`

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

#### 动态相关
  + [ ] 动态详情
    + [X] 动态渲染
    + [X] 作者渲染
    + [X] 评论列表
    + 点赞
    + [X] 评论
      * [X] 评论之后，给动态创建人发送Job通知消息；如果评论本身就是动态创建人，则无需发送。
      * [X] 发送邮件通知
  + [X] 新增
  + [X] 编辑
  + [X] 删除

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
