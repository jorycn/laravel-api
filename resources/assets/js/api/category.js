import Vue from 'vue';

const category =  {

  getAll (cb) {
    setTimeout(() => {
        Vue.http.get('/data/category')
          .then(response => {
            let data = response.data
            cb(data)
          })
    }, 100)
  },
}

export default category