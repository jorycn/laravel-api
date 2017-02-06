<template>
	<div>
		<div class="cont">
			<table class="ui celled table">
					<thead>
							<tr><th>#</th>
							<th>留言内容</th>
							<th>提交时间</th>
					</tr></thead>
					<tbody>
							<tr v-for="(v, i) in pageItems">
								<td><div class="ui ribbon label">{{ v.id }}</div></td>
								<td>{{ v.content }}</td>
								<td>{{ v.created_at }}</td>
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
 import { mapState } from 'vuex'

	export default{
		mounted () {
      this.getMessages()
    },
		computed: mapState({
			paginate: (state) => state.BxjkMessage.paginate,
			pageItems: (state) => {
				let _items = state.BxjkMessage.items
				let arrayItems = _.chunk(_items, state.BxjkMessage.paginate.pageSize)
				return arrayItems[state.BxjkMessage.paginate.current_page - 1]
			}
		}),
    methods: {
      getMessages () {
        this.$store.dispatch('getBxjkMessage', 1)
      },
			pageHandler: function(page) {
				this.$store.dispatch('topBxjkMessagePage', page)
			},
			createUrl: function(unit) {
				return unit.page > 1?'#page=' + unit.page:'#'
			}
    }
        
	}
</script>
