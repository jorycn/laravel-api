<template>
    <div>
        <div class="head">
            <button class="ui button primary">新增</button>
        </div>
        <div class="cont">
            <table class="ui celled table">
                <thead>
                    <tr><th width="10%">#</th>
                    <th>标题</th>
                    <th>路径</th>
                    <th>级别</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr></thead>
                <tbody>
                    <tr v-for="(v, i) in categories">
                        <td><div class="ui ribbon label">{{ v.id }}</div></td>
                        <td>{{ v.name }}</td>
                        <td>{{ v.path }}</td>
                        <td>{{ v.level }}</td>
                        <td>{{ v.created_at | fromNow }}</td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <div class="ui right floated pagination menu">
                                <a class="icon item">
                                <i class="left chevron icon"></i>
                                </a>
                                <a class="item">1</a>
                                <a class="item">2</a>
                                <a class="item">3</a>
                                <a class="item">4</a>
                                <a class="icon item">
                                <i class="right chevron icon"></i>
                                </a>
                            </div>
                        </th>
                </tr></tfoot>
                </table>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
	import categoryApi from '../api/category'

	export default{
		computed: mapState({
			categories: state => state.Category.categories
		}),
		mounted () {
			this.getCategory()
		},
		methods: {
			getCategory() {
				this.$store.dispatch('getCategories')
			}
		}
	}
</script>

<style scoped>
    .head{
        margin-bottom:20px;
    }
</style>