<template>
  <ol class="breadcrumb">
    <li v-for="(item, index) in breadcrumbs">
      <span class="active" v-if="isLast(index)">{{item.meta.label}}</span>
      <router-link :to="{ name: item.name }" v-if="!isLast(index)">{{item.meta.label}}</router-link>
    </li>
  </ol>
</template>

<script>

export default {
  props: {
    breadcrumbs: {
      type: Array,
      required: true,
      default: () => []
    },
    separator: {
      type: String
    }
  },

  mounted () {
    if (this.separator) {
      this.$el.style.setProperty('--separator', `"${this.separator}"`)
    }
  },

  methods: {
    isLast (index) {
      return index === this.breadcrumbs.length - 1
    }
  }
}
</script>

<style lang="less">
.breadcrumb {
  // > \003e
  // / \2044
  --separator: "\2044";

  list-style: none;
  align-items: center;
  display: flex;
  justify-content: flex-end;

  & > li + li:before {
    padding: 0 5px;
    color: #ccc;
    content: var(--separator, "\2044");
  }
}
</style>
