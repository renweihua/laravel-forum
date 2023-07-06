require('./bootstrap');

require('./vue');

require('./element-ui');

require('./axios');

// 引入API
require('../api/dynamics');
require('../api/user');

// 是否展示返回页面顶部的图标
setTimeout(() => {
    window.addEventListener('scroll', () => {
        if (
            document.body.scrollTop > 400 ||
            document.documentElement.scrollTop > 400
        ) {
            // $('div.back-to-top').css('display', 'block');
            $('div.back-to-top').show();
        } else {
            // $('div.back-to-top').css('display', 'none');
            $('div.back-to-top').hide();
        }
    })
}, 1000);

// 返回页面顶部
scrollToTop = function () {
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    })
}

// 展示回复评论框
showReply = function(_that) {
    // 关闭所有回复框
    $('ul.list-unstyled div.reply-box').hide();
    // 展示当前回复框
    $(_that).parent().next().find('div.reply-box').show();
}
