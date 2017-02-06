import {
  BXJK_GET_VOTE_DATA
} from '../../mutation-types'

import bxjkApi from '../../../api/bxjk'

const category = {
  state: {
    'items': [],
    'subjects': []
  },
  mutations: {
    [BXJK_GET_VOTE_DATA] (state, data){
      // for(let i=0;i<data.length;i++){
      //     let $_field = JSON.parse(data[i].field);
      //     for(let n=0;n<$_field.length;n++){
      //       $_field[n] = []
      //     }
      //   }
      state.items = data
    }
  },
  actions: {
    bxjkGetVoteData ({commit}, voteid) {
      bxjkApi.getVoteData(voteid, (res) => {
        commit('BXJK_GET_VOTE_DATA', res)
      })
    }
  }
}

export default category
