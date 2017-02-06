<template>
    <div class="ui grid">
        <div class="four wide column">
            <div class="ui segments">
                <div class="ui segment"><i class="ui icon video"></i>视频</div>
                <div class="ui secondary segment">
                    <router-link :to="{ name: 'bxjk_video'}" tag="p" class="hand">视频列表</router-link>
                </div>
                <div class="ui segment"><i class="ui icon building"></i>投票</div>
                <div class="ui secondary segment">
                    <router-link :to="{ name: 'bxjk_vote'}" tag="p" class="hand">投票列表</router-link>
                </div>
                <div class="ui segment"><i class="ui icon announcement"></i>留言</div>
                <div class="ui secondary segment">
                    <router-link :to="{ name: 'bxjk_message'}" tag="p" class="hand">互动</router-link>
                </div>
            </div>
        </div>
        <div class="twelve wide column">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default{

    }
</script>
