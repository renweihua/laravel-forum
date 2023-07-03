require('./bootstrap');

require('./axios');

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

$(function(){
   // 不可直接在html的a标签调用onclick,未找到方法……
   $('a#back-to-top').click(function(){
       scrollToTop();
   });
});

// 返回页面顶部
function scrollToTop() {
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    })
}
