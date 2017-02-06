import Vue from 'vue'

import util from './util'

const bxjk =  {

  //视频管理
  getVideo (cb) {
    setTimeout(() => {
        Vue.http.get('/data/bxjk/video')
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  addVideo (data, cb) {
    setTimeout(() => {
        Vue.http.post('/data/bxjk/video/create', data)
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  updateVideo (data, cb) {
    setTimeout(() => {
        Vue.http.post('/data/bxjk/video/update', data)
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  deleteVideo (id, cb) {
    setTimeout(() => {
      Vue.http.delete('/data/bxjk/video/delete', {'params': {'id': id}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  topVideo (option, cb) {
    setTimeout(() => {
      Vue.http.get('/data/bxjk/video/top', {'params': {'id': option.id, 'top': option.top}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  
  //活动管理
  getVote (cb) {
    setTimeout(() => {
        Vue.http.get('/data/bxjk/vote')
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  addVote (data, cb) {
    setTimeout(() => {
        Vue.http.post('/data/bxjk/vote/create', data)
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  updateVote (data, cb) {
    setTimeout(() => {
        Vue.http.post('/data/bxjk/vote/update', data)
          .then(response => {
            let res = response.data
            if(res.errcode !== 0){
              util.handleError(res.msg, res.errcode)
            }else{
              cb(res.data)
            }
          }, (response) => {
            util.handleError('网络异常，稍后重试', 408)
          })
    }, 100)
  },
  deleteVote (id, cb) {
    setTimeout(() => {
      Vue.http.delete('/data/bxjk/vote/delete', {'params': {'id': id}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  saveVoteSubject (subjects, cb) {
    setTimeout(() => {
      Vue.http.post('/data/bxjk/vote/subject', subjects)
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  getVoteSubject (voteid, cb) {
    setTimeout(() => {
      Vue.http.get('/data/bxjk/vote/subject', {'params': {'voteid': voteid}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  deleteVoteSubject (subjectid, cb) {
    setTimeout(() => {
      Vue.http.delete('/data/bxjk/vote/subject', {'params': {'subjectid': subjectid}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb()
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  deleteVoteOption (optionid, cb) {
    setTimeout(() => {
      Vue.http.delete('/data/bxjk/vote/option', {'params': {'optionid': optionid}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb()
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  getVoteData (voteid, cb) {
    setTimeout(() => {
      Vue.http.get('/data/bxjk/vote/data', {'params': {'voteid': voteid}})
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  },
  getMessage (cb) {
    setTimeout(() => {
      Vue.http.get('/data/bxjk/message')
        .then(response => {
          let res = response.data
          if(res.errcode !== 0){
            util.handleError(res.msg, res.errcode)
          }else{
            cb(res.data)
          }
        }, (response) => {
          util.handleError('网络异常，稍后重试', 408)
        })
    }, 100)
  }
}

export default bxjk
