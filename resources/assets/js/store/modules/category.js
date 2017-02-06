import {
  CATEGORY_GET_iTEMS
} from '../mutation-types'

import categoryApi from '../../api/category'

const category = {
  state: {
    'categories': []
  },
  mutations: {
    [CATEGORY_GET_iTEMS] (state, categories) {
      state.categories = categories
    },
  },
  actions: {
    getCategories ({commit}) {
      categoryApi.getAll(categories => {
        commit('CATEGORY_GET_iTEMS', categories)
      })
    }
  }
}

export default category
