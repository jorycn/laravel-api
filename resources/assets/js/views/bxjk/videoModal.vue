<template>
  <modal title="创建视频">
    <form class="ui form" @submit.prevent="addVideo">
      <label>标题</label>
      <div class="field">
        <input type="text" v-model="item.title" placeholder="视频标题" required>
      </div>
      <label>视频id</label>
      <div class="field">
        <input type="text" v-model="item.vid" placeholder="视频腾讯VID" required>
      </div>
      <label>年份</label>
      <div class="field">
        <input type="text" v-model="item.year" placeholder="年份" required>
      </div>
      <label>月份</label>
      <div class="field">
        <select v-model="item.month" required>
          <option value="1">一月</option>
          <option value="2">二月</option>
          <option value="3">三月</option>
          <option value="4">四月</option>
          <option value="5">五月</option>
          <option value="6">六月</option>
          <option value="7">七月</option>
          <option value="8">八月</option>
          <option value="9">九月</option>
          <option value="10">十月</option>
          <option value="11">十一月</option>
          <option value="12">十二月</option>
        </select>
      </div>
      <label>封面</label>
      <div class="field">
        <input type="text" v-model="item.thumb" placeholder="封面图片链接" required>
      </div>
      
      <input type="hidden" v-model="item.id" v-if="item.id">
      <input type="hidden" v-model="item.top">

      <footer class="Modal__footer">
        <button class="ui button positive" type="submit">保存</button>
      </footer>
    </form>
  </modal>
</template>

<script>
import Modal from '../Modal.vue';

export default {
  components: { Modal },
  props: {
    item: {
      required: true
    }
  },
  methods: {
    addVideo () {
      this.$store.dispatch('addBjkVideo', this.item)
    }
  }
}
</script>
