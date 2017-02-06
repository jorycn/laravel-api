<template>
    <div class="m-setting">
			<div class="head">
					<router-link :to="{ 'name': 'bxjk_vote' }" class="ui button primary">返回</router-link>
			</div>
			<h3 class="ui header">#{{ voteId }}投票结果</h3>
			<div class="ui secondary segment form" v-for="(v, i) in subjects">
					<div class="inline fields">
							<h3 id="tip">#{{ i+1 }}：{{v.title}}</h3>
					</div>
					<div v-for="(sv, si) in v.options">
							<p>{{ si | toLetter }}、{{ sv.title }}&nbsp;(<strong>{{sv.count}}</strong>票)</p>
							<div class="ui green progress small">
								<div class="bar" :style="{ width:sv.percent+'%' }" v-if="sv.percent>0">
									<div class="progress">{{ sv.percent }}%</div>
								</div>
								<div class="bar" v-if="!sv.percent>0">
									<div class="progress">{{ sv.percent }}</div>
								</div>
							</div>
					</div>
					
			</div>
  </div>
</template>

<script>
	import { mapState } from 'vuex'

	export default{
		data () {
			return {
				voteId: 0
			}
		},
    computed:mapState({
			subjects: state => state.BxjkVote.subjects
		}),
		mounted () {
			this.voteId = this.$route.params.voteid
			this.$store.dispatch('getBxjkVoteSubject', this.voteId)
		}
	}
</script>

<style scoped>
    .head{
        margin-bottom:20px;
    }
		h3{
			margin-bottom:10px;
		}
</style>