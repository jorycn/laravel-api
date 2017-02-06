<template>
  <div class="Modal u-overlay" @click="closeModal" v-show="isModalOpen">
      <div class="Modal__container" @click.stop="" v-show="isModalOpen">
        <header class="Modal__header">{{ title }}</header>
        <div class="Modal__content">
          <slot></slot>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  props: ['title'],
  computed: {
    isModalOpen () {
      return this.$store.state.modal.open;
    }
  },
  methods: {
    closeModal () {
      this.$store.dispatch('closeModal')
    }
  }
}
</script>

<style>
.Modal__container{
  max-width:700px;width:90%;background:#fff;border-radius:2px;animation-duration:.3s;animation-delay:0s
  }
  .Modal__header{
    display: block;
    font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
    background: #FFF;
    margin: 0;
    padding: 1.25rem 1.5rem;
    box-shadow: none;
    color: rgba(0,0,0,.85);
    font-size: 1.42857143rem;
    line-height: 1.2857em;
    font-weight: 700;
    border-bottom: 1px solid rgba(34,36,38,.15);
  }
    
    .Modal__content{padding:10px 20px;}.Modal__footer{padding:5px}.Modal__form{display:flex;flex-wrap:wrap;}.Modal__form > *{flex-basis:100%;margin-bottom:20px}.Modal__form > input[type=text],.Modal__form > textarea{height:40px;border-radius:3px;border:1px solid #eee;padding:4px}.Modal__form > textarea{height:200px}.u-overlay{position:fixed;z-index:1000;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.8);display:flex;align-items:center;justify-content:center}.fade-transition{transition:opacity .2s ease;}.fade-transition.fade-enter,.fade-transition.fade-leave{opacity:0}.loader-inner.ball-clip-rotate > div{position:relative;right:-5px;top:2px}.Modal__button{display:flex;justify-content:center;align-items:center;font-size:20px}
</style>
