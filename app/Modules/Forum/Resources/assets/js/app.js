require('./bootstrap');

require('./vue');

require('./element-ui');

require('./axios');

require('./dynamics');

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
