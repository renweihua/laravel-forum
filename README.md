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
- [ ] 动态详情
  - [X] 动态渲染
  - [X] 作者渲染
  - 点赞
  - 评论
- [X] 会员权限组 /user-group

##### 会员相关
- [ ] 会员详情 /user/user_id
  - [X] 会员导航栏

##### 话题
- [X] 话题列表 /topics
- [ ] 话题详情

### 感谢
- [Laravel](https://github.com/laravel)
- [tabler](https://github.com/tabler/tabler)
