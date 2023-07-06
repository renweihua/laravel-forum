<script>
    <!-- 如果需实现模块化，安装卸载，那么只能写function，不可绑定到vue事件 -->
    function praiseComment(comment_id){
        instance.post("{{ route('dynamics.comment.praise') }}", {
            comment_id
        }).then(res => {
            Element.Message.success(res.msg);
            var parise_count = parseInt($('#comment-praise-' + comment_id).find('span').html());
            if(res.is_praise){
                ++parise_count;
                $('#comment-praise-' + comment_id).find('i').removeClass('fa-thumbs-o-up');
                $('#comment-praise-' + comment_id).find('i').addClass('fa-thumbs-up');
            }else{
                --parise_count;
                $('#comment-praise-' + comment_id).find('i').removeClass('fa-thumbs-up');
                $('#comment-praise-' + comment_id).find('i').addClass('fa-thumbs-o-up');
            }
            $('#comment-praise-' + comment_id).find('span').html(parise_count)
        });
    }
</script>
