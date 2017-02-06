<template>
  <div>
    <router-link :to="{ name: 'category' }" class="circular ui icon button hand" tag="button"><i class="icon settings"></i></router-link>
    <div class="ui divider"></div>
    <ul>
      <li v-for="item in cases">
        <router-link :to="item.route" class="ui button large">{{ item.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      cases: []
    }
  },
  mounted () {
    this.cases = this.$store.state.cases
  }
} 
</script>
