<template>
	<div>
		<video-modal :item="editItem" :active="active"></video-modal>
		<div class="head">
			<a href="javascript:;" class="ui button parimary" @click="addVideo">新增</a>
		</div>
		<div class="cont">
				<table class="ui celled table">
					<thead>
							<tr><th>#</th>
							<th>标题</th>
							<th>缩略图</th>
							<th>视频id</th>
							<th>时间</th>
							<th>创建时间</th>
							<th>操作</th>
					</tr></thead>
					<tbody>
							<tr v-for="(v, i) in pageItems">
								<td><div class="ui ribbon label">{{ v.id }}</div></td>
								<td :class="{ 'isTop':v.top==1 }">{{ v.title }}</td>
								<td><img :src="v.thumb" width="200" height="100"/></td>
								<td>{{ v.vid }}</td>
								<td>{{ v.year }} / {{ v.month }}</td>
								<td>{{ v.created_at }}</td>
								<td>
									<i class="level up icon hand" @click="topVideo(v.id)" title="推荐" v-show="v.top==0"></i>
									<i class="level down icon hand" @click="downVideo(v.id)" title="取消推荐"  v-show="v.top==1"></i>
									<i class="icon edit hand" @click="editVideo(i)" title="编辑"></i>
									<i class="icon trash hand" @click="deleteVideo(v.id)" title="删除"></i>
								</td>
							</tr>
					</tbody>
				</table>
				<zpagenav 
					:page="paginate.current_page"
					:page-size="paginate.pageSize"
					:total="paginate.total"
					:page-handler="pageHandler"
					:create-url="createUrl" v-show="paginate.total>paginate.pageSize">
				</zpagenav>
		</div>
	</div>
</template>

<script>
	import videoModal from './videoModal.vue'
  import { mapState } from 'vuex'
	import moment from 'moment'

	export default{
		components: {
			videoModal
		},
		data () {
			return {
				editItem: {},
				active: true
			}
		},
		computed: mapState({
			paginate: (state) => state.BxjkVideo.paginate,
			pageItems: (state) => {
				let _items = state.BxjkVideo.items
				let arrayItems = _.chunk(_items, state.BxjkVideo.paginate.pageSize)
				return arrayItems[state.BxjkVideo.paginate.current_page - 1]
			}
		}),
		mounted () {
			this.getBxjkVideo()
		},
		methods: {
			getBxjkVideo() {
				this.$store.dispatch('getBxjkVideo', 1)
			},
			addVideo() {
				this.editItem = {
					'top': 0,
					'year': moment().format('Y'),
					'month': moment().format('M')
				}
				this.$store.dispatch('openModal')
			},
			editVideo (idx) {
				this.editItem = this.pageItems[idx]
				this.$store.dispatch('openModal')				
			},
			deleteVideo (id) {
				this.$swal('是否删除：《'+_.find(this.pageItems, {'id': id}).title+'》', () => {
					this.$store.dispatch('deleteBxjkVideo', id)
				})
			},
			topVideo (id) {
				this.$swal('是否将：《'+_.find(this.pageItems, {'id': id}).title+'》设为推荐', () => {
					this.$store.dispatch('topBxjkVideo', {'id': id, 'top': 1})
				})
			},
			downVideo (id) {
				this.$swal('是否取消：《'+_.find(this.pageItems, {'id': id}).title+'》推荐', () => {
					this.$store.dispatch('downBxjkVideo', {'id': id, 'top': 0})
				})
			},
			pageHandler: function(page) {
				this.$store.dispatch('topBxjkVideoPage', page)
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
		.isTop{
			color:red;
			font-weight:600;
		}
</style>