import Vue from 'vue'
import Vuex from 'vuex'

import mutations from './mutations'
import * as actions from './actions'

import Category from './modules/category'
import BxjkVideo from './modules/bxjk/video'
import BxjkVote from './modules/bxjk/vote'
import BxjkVoteData from './modules/bxjk/voteData'
import BxjkMessage from './modules/bxjk/message'

Vue.use(Vuex)
Vue.config.debug = true

const debug = process.env.NODE_ENV !== 'production'
const state = {
  modal: {
    open: false
  },
  user: {
    authenticated: false,
    id: 0,
    name: '',
    email: ''
  },
  cases: [
    {
      'name': '百姓健康',
      'route': 'bxjk'
    }
  ]
}

export default new Vuex.Store({
  state,
  mutations,
  actions,
  modules: {
    Category,
    BxjkVideo,
    BxjkVote,
    BxjkVoteData,
    BxjkMessage
  },
  strict: debug
})
