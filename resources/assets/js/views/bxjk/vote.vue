<template>
    <div>
        <vote-modal :item="editItem" :active="active"></vote-modal>
        <div class="head">
            <a href="javascript:;" class="ui button parimary" @click="addVote" v-show="settingId==0">新增</a>
            <a href="javascript:;" class="ui button red" @click="settingId = 0" v-show="settingId!=0">返回</a>
						<a href="javascript:;" class="ui" @click="toggleApi">Api</a>
        </div>
				<vote-api v-show="showApi"></vote-api>
				<vote-subjects :voteId="settingId" v-show="settingId > 0"></vote-subjects>
        <div class="cont" v-show="settingId==0">
					<table class="ui celled table">
						<thead>
								<tr><th>#</th>
								<th>标题</th>
								<th>创建时间</th>
								<th>操作</th>
						</tr></thead>
						<tbody>
								<tr v-for="(v, i) in pageItems">
									<td><div class="ui ribbon label">{{ v.id }}</div></td>
									<td>{{ v.title }}</td>
									<td>{{ v.created_at }}</td>
									<td>
										<i class="icon setting hand" @click="settingVote(v.id)"></i>
										<router-link :to="{ name: 'bxjk_vote_data', params: { 'voteid': v.id } }" tag="i" class="icon database hand"></router-link>
										<i class="icon edit hand" @click="editVote(i)"></i>
										<i class="icon trash hand" @click="deleteVote(v.id)"></i>
									</td>
								</tr>
						</tbody>
					</table>
					<zpagenav 
						:page="paginate.current_page"
						:page-size="paginate.pageSize"
						:total="paginate.total"
						:page-handler="pageHandler"
						:create-url="createUrl">
					</zpagenav>
        </div>
    </div>
</template>

<script>
	import voteModal from './voteModal.vue'
	import voteApi from './voteApi.vue'
	import voteSubjects from './voteSubject.vue'

	import { mapState } from 'vuex'
	import moment from 'moment'

	export default{
		components: {
			voteModal,
			voteApi,
			voteSubjects
		},
		data () {
			return {
				editItem: {},
				active: true,
				settingId: 0,
				showApi: false,
			}
		},
		computed: mapState({
			paginate: (state) => state.BxjkVote.paginate,
			pageItems: (state) => {
				let _items = state.BxjkVote.items
				let arrayItems = _.chunk(_items, state.BxjkVote.paginate.pageSize)
				return arrayItems[state.BxjkVote.paginate.current_page - 1]
			}
		}),
		mounted () {
			this.getBxjkVote()
		},
		methods: {
			getBxjkVote() {
				this.$store.dispatch('getBxjkVote', 1)
			},
			addVote() {
				this.editItem = {}
				this.$store.dispatch('openModal')
			},
			editVote (idx) {
				this.editItem = this.pageItems[idx]
				this.$store.dispatch('openModal')				
			},
			deleteVote (id) {
				this.$swal('是否删除：《'+_.find(this.pageItems, {'id': id}).title+'》', () => {
					this.$store.dispatch('deleteBxjkVote', id)
				})
			},
			settingVote (id) {
				this.settingId = id
			},
			toggleApi () {
				this.showApi = this.showApi?false:true
			},
			pageHandler: function(page) {
				this.$store.dispatch('topBxjkVotePage', page)
			},
			createUrl: function(unit) {
				return unit.page > 1?'#page=' + unit.page:'#'
			}
		}
	}
</script>

<style scoped>
    .head{
        margin-bottom:20px;
    }
</style>