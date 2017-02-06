<template>
  <modal title="创建投票">
    <form class="ui form" @submit.prevent="addVideo">
      <label>标题</label>
      <div class="field">
        <input type="text" v-model="item.title" placeholder="视频标题" required>
      </div>
      <input type="hidden" v-model="item.id" v-if="item.id">

      <footer class="Modal__footer">
        <button class="ui button positive" type="submit">保存</button>
      </footer>
    </form>
  </modal>
</template>

<script>
import Modal from '../Modal.vue'
import voteSubject from './voteSubject.vue'

export default {
  components: { 
    Modal,
    voteSubject
  },
  props: {
    item: {
      required: true
    }
  },
  data () {
    return {
      current: 1, 
      subjects: 5,
    }
  },
  methods: {
    addVideo () {
      let data = {'title': this.item.title, 'uuid': this.$store.state.user.id, 'id': this.item.id}
      this.$store.dispatch('addBjkVote', data)
    },
    dropdown (idx) {
      this.current = idx
    }
  }
}
</script>
