import {
  CLOSEMODAL,
  BXJK_GET_VOTE,
  BXJK_ADD_VOTE,
  BXJK_UPDATE_VOTE,
  BXJK_DELETE_VOTE,
  BXJK_SET_VOTE_SUBJECTS,
  BXJK_ADD_VOTE_SUBJECT,
  BXJK_ADD_VOTE_OPTION,
  BXJK_DELETE_VOTE_SUBJECT,
  BXJK_DELETE_VOTE_OPTION,
  BXJK_VOTE_PAGE
} from '../../mutation-types'

import bxjkApi from '../../../api/bxjk'

const category = {
  state: {
    'items': [],
    'subjects': [],
    'paginate': {
      current_page: 1,
      pageSize: 10,
      total: 0
    }
  },
  mutations: {
    [BXJK_GET_VOTE] (state, items) {
      state.items = items
      state.paginate.total = items.length
    },
    [BXJK_VOTE_PAGE] (state, page) {
      state.paginate.current_page = page
    },
    [BXJK_ADD_VOTE] (state, data) {
      state.items.unshift(data)
    },
    [BXJK_UPDATE_VOTE] (state, data) {
      let idx = _.findIndex(state.items, { 'id': data.id })
      state.items.splice(idx, 1, data)
    },
    [BXJK_DELETE_VOTE] (state, id) {
      let idx = _.findIndex(state.items, { 'id': id })
      state.items.splice(idx, 1)
    },
    [BXJK_SET_VOTE_SUBJECTS] (state, subjects) {
      state.subjects = subjects
    },
    [BXJK_ADD_VOTE_SUBJECT] (state, voteid) {
      state.subjects.push({'options': [], 'vote_id': voteid, 'type': 1})
    },
    [BXJK_ADD_VOTE_OPTION] (state, idx) {
      state.subjects[idx].options.push({})
    },
    [BXJK_DELETE_VOTE_SUBJECT] (state, subjectIdx) {
      state.subjects.splice(subjectIdx, 1)
    },
    [BXJK_DELETE_VOTE_OPTION] (state, opt) {
      state.subjects[opt.sidx].options.splice(opt.oidx, 1)
    }
  },
  actions: {
    getBxjkVote ({commit}) {
      bxjkApi.getVote(items => {
        commit('BXJK_GET_VOTE', items)
      })
    },
    addBjkVote ({commit}, data) {
      if(!data.id) {
        bxjkApi.addVote(data, (res) => {
          commit('BXJK_ADD_VOTE', res)
          commit('CLOSEMODAL')
        })
      }else{
        bxjkApi.updateVote(data, (res) => {
          commit('BXJK_UPDATE_VOTE', res)
          commit('CLOSEMODAL')
        })
      }
    },
    deleteBxjkVote ({commit}, id) {
      bxjkApi.deleteVote(id, (res) => {
        commit('BXJK_DELETE_VOTE', id)
      })
    },
    saveBxjkVoteSubject ({commit}, subjects) {
      bxjkApi.saveVoteSubject(subjects, (res) => {
        commit('BXJK_SET_VOTE_SUBJECTS', res)
      })
    },
    getBxjkVoteSubject ({commit}, voteid) {
      bxjkApi.getVoteSubject(voteid, (res) => {
        commit('BXJK_SET_VOTE_SUBJECTS', res)
      })
    },
    addBxjkVoteSubject ({commit}, voteid) {
      commit('BXJK_ADD_VOTE_SUBJECT', voteid)
    },
    addBxjkVoteOption ({commit}, idx) {
      commit('BXJK_ADD_VOTE_OPTION', idx)
    },
    deleteBxjkVoteSubject ({commit}, option) {
      if(!option.needAjax){
          commit('BXJK_DELETE_VOTE_SUBJECT', option.subjectIdx)
      }else{
        bxjkApi.deleteVoteSubject(option.subjectId, (res) => {
            commit('BXJK_DELETE_VOTE_SUBJECT', option.subjectIdx)
        })
      }
    },
    deleteBxjkVoteOption ({commit}, option) {
      if(!option.needAjax){
        commit('BXJK_DELETE_VOTE_OPTION', {'oidx': option.optionIdx, 'sidx': option.subjectIdx})
      }else{
        bxjkApi.deleteVoteOption(option.optionId, (res) => {
            commit('BXJK_DELETE_VOTE_OPTION', {'oidx': option.optionIdx, 'sidx': option.subjectIdx})
        })
      }
    },
    topBxjkVotePage ({commit}, page) {
      commit('BXJK_VOTE_PAGE', page)
    }
  }
}

export default category
