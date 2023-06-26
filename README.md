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

### 功能列表
- [ ] 动态详情
  - [X] 动态渲染
  - [X] 作者渲染
  - 点赞
  - 评论
- [X] 会员权限组 /user-group
- [ ] 会员详情 /user/user_id
  - [X] 会员导航栏

### 感谢
- [Laravel](https://github.com/laravel)
- [tabler](https://github.com/tabler/tabler)
