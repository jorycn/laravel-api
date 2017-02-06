<template>
  <div id="root">
    <header class="ui menu">
      <router-link :to="{ name:'index' }" tag="div" class="header item hand">
        Api Center
      </router-link>
      <div class="right menu">
        <router-link :to="{ name: 'login' }" v-if="!user.authenticated" class="item">登陆</router-link>
        <router-link :to="{ name: 'register' }" v-if="!user.authenticated" class="item">注册</router-link>
			<router-link :to="{ name: 'home' }" class="item" v-if="user.authenticated">{{ user.name }}</router-link>
			<a class="item" @click.prevent="logout" v-if="user.authenticated">退出</a>
      </div>
    </header>
    <div class="ui container">
      <Breadcrumb :breadcrumbs=breadcrumbs></Breadcrumb>      
      <transition name="fade">
        <keep-alive>
          <router-view v-on:dialog="openDialog"></router-view>
        </keep-alive>
      </transition>
    </div>
    <footer>
      <div class="ui container">
        <p>Copyright © 1998 - 2016 Tencent</p>
      </div>
    </footer>
  </div>
</template>

<script>
import store from './store'
import auth from './services/Auth.js'
import Breadcrumb from './views/Breadcrumb.vue'

export default {
  store: store,
  components: {
    Breadcrumb
  },
  data () {
    return {
      breadcrumbs:[],
      modalIsOpen: false,
      user: {},
    }
  },
  computed: {
    breadcrumbs () {
      return this.$route.matched
    }
  },
  mounted () {
    this.user = this.$store.state.user
  },
  methods: {
    openDialog () {
      this.modalIsOpen = true
    },
    logout () {
      auth.logout()
    }
  }
}
</script>

<style>
.hand{
  cursor:pointer;
}
footer{
  text-align:left;
  padding:20px 0;
}
</style>

