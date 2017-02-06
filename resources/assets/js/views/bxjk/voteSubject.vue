<template>
  <div class="m-setting">
    <h3 class="ui header">字段编辑#{{ voteId }}</h3>
    <div class="ui secondary segment form" v-for="(v, i) in subjects">
        <div class="inline fields">
            <label id="tip">#{{ i+1 }}：</label>
            <input type="text" class="ui segment" v-model="v.title" placeholder="点击编辑"/>
        </div>
        <div class="ui secondary segment" v-for="(sv, si) in v.options">
            <div class="inline fields">
                <label>{{ si | toLetter }}</label>
                <input type="text" v-model="sv.title" placeholder="请输入问题">
                <i class="icon trash red large hand" @click="deleteOption(si, i)"></i>
            </div>
        </div>
        <button class="ui button basic black" @click="addOption(i)">添加一项</button>
        <button class="ui button basic black" @click="deleteSubject(i)">删除该题</button>
    </div>
    <div class="ui large buttons">
      <button class="ui button green" @click="addSubject">添加一题</button>
      <div class="or"></div>
      <button class="ui button primary" @click="saveSubject">保存</button>
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    props: {
      voteId: {
        required: true,
        default: 0
      }
    },
    watch: {
      voteId: function(val, oldVal){
        if(val>0){
          this.loadSubject()
        }
      }
    },
    computed: mapState({
			subjects: state => state.BxjkVote.subjects
		}),
    methods: {
      addSubject () {
        this.$store.dispatch('addBxjkVoteSubject', this.voteId)
      },
      saveSubject () {
        this.subjects.voteid = this.voteId
        this.$store.dispatch('saveBxjkVoteSubject', this.subjects)
      },
      addOption (idx) {
        this.$store.dispatch('addBxjkVoteOption', idx)
      },
      loadSubject () {
        this.$store.dispatch('getBxjkVoteSubject', this.voteId)
      },
      deleteSubject (subjectIdx) {
        let subjectId = this.subjects[subjectIdx].id
        if(!subjectId){
          this.$store.dispatch('deleteBxjkVoteSubject', {
            'subjectIdx': subjectIdx, 
            'needAjax': false
            })
        }else{
          this.$store.dispatch('deleteBxjkVoteSubject', {
            'subjectIdx': subjectIdx, 
            'needAjax': true, 
            'subjectId': subjectId
            })
        }
      },
      deleteOption (optionIdx, subjectIdx) {
        let optionId = this.subjects[subjectIdx].options[optionIdx].id
        if(!optionId){
         this.$store.dispatch('deleteBxjkVoteOption', {
           'optionIdx':optionIdx, 
           'subjectIdx':subjectIdx, 
           'needAjax': false
           })
        }else{
          this.$store.dispatch('deleteBxjkVoteOption', {
            'optionIdx':optionIdx, 
            'subjectIdx':subjectIdx, 
            'needAjax': true, 
            'optionId': optionId
            })
        }
      }
    }
  }
</script>

<style scoped>
  .m-setting{
    margin-bottom:20px;
  }
  .ui.header{
    padding:10px;
  }
  #tip{
    font-size:30px;
    font-weight:bold;
    margin: .035714em 0 0 0;
  }
</style>