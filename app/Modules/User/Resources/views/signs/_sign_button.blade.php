<a v-if="login_user && login_user.user_info && login_user.user_info.is_sign" href="javascript:;" class="btn btn-block" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);color: rgba(0,0,0,.6)!important;">
    <i class="fa fa-calendar-check-o mr-2" style="opacity: .8;"></i>  今日已打卡成功
</a>
<a v-else @click="loginUserSign" href="javascript:;" class="btn btn-block" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);color: rgba(0,0,0,.6)!important;">
    <i class="fa fa-calendar-minus-o mr-2" style="opacity: .8;"></i>  立即签到
</a>
