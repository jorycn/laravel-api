import {
  BXJK_GET_MESSAGE,
  BXJK_MESSAGE_PAGE
} from '../../mutation-types'

import bxjkApi from '../../../api/bxjk'

const category = {
  state: {
    'items': [],
    'paginate': {
      current_page: 1,
      pageSize: 10,
      total: 0
    }
  },
  mutations: {
    [BXJK_GET_MESSAGE] (state, items) {
      state.items = items
      state.paginate.total = items.length
    },
    [BXJK_MESSAGE_PAGE] (state, page) {
      state.paginate.current_page = page
    },
  },
  actions: {
    getBxjkMessage ({commit}) {
      bxjkApi.getMessage(items => {
        commit('BXJK_GET_MESSAGE', items)
      })
    },
    topBxjkMessagePage ({commit}, page) {
      commit('BXJK_MESSAGE_PAGE', page)
    }
  }
  
}

export default category
