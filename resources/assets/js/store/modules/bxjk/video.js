import {
  BXJK_GET_VIDEO,
  BXJK_ADD_VIDEO,
  BXJK_UPDATE_VIDEO,
  BXJK_DELETE_VIDEO,
  BXJK_TOP_VIDEO,
  BXJK_DOWN_VIDEO,
  BXJK_VIDEO_PAGE,
  CLOSEMODAL
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
    [BXJK_VIDEO_PAGE] (state, page) {
      state.paginate.current_page = page
    },
    [BXJK_GET_VIDEO] (state, items) {
      state.items = items
      state.paginate.total = items.length
    },
    [BXJK_ADD_VIDEO] (state, data) {
      state.items.unshift(data)
    },
    [BXJK_UPDATE_VIDEO] (state, data) {
      let idx = _.findIndex(state.items, { 'id': data.id })
      state.items.splice(idx, 1, data)
    },
    [BXJK_DELETE_VIDEO] (state, id) {
      let idx = _.findIndex(state.items, { 'id': id })
      state.items.splice(idx, 1)
    },
    [BXJK_TOP_VIDEO] (state, id) {
      let idx = _.findIndex(state.items, {'id': id})
      let _item = state.items[idx]
      
      _item.top = 1
      state.items.splice(idx, 1)
      state.items.unshift(_item)
    },
    [BXJK_DOWN_VIDEO] (state, id) {
      let idx = _.findIndex(state.items, {'id': id})
      let _item = state.items[idx]
      
      _item.top = 0
      state.items.splice(idx, 1)
      state.items.push(_item)
    }
  },
  actions: {
    getBxjkVideo ({commit}) {
      bxjkApi.getVideo(items => {
        commit('BXJK_GET_VIDEO', items)
      })
    },
    addBjkVideo ({commit}, data) {
      if(!data.id) {
        bxjkApi.addVideo(data, (res) => {
          commit('BXJK_ADD_VIDEO', res)
          commit('CLOSEMODAL')
        })
      }else{
        bxjkApi.updateVideo(data, (res) => {
          commit('BXJK_UPDATE_VIDEO', res)
          commit('CLOSEMODAL')
        })
      }
    },
    deleteBxjkVideo ({commit}, id) {
      bxjkApi.deleteVideo(id, (res) => {
        commit('BXJK_DELETE_VIDEO', id)
      })
    },
    topBxjkVideo ({commit}, option) {
      bxjkApi.topVideo(option, (res) => {
        commit('BXJK_TOP_VIDEO', option.id)
      })
    },
    downBxjkVideo ({commit}, option) {
      bxjkApi.topVideo(option, (res) => {
        commit('BXJK_DOWN_VIDEO', option.id)
      })
    },
    topBxjkVideoPage ({commit}, page) {
      commit('BXJK_VIDEO_PAGE', page)
    }
  }
}

export default category
