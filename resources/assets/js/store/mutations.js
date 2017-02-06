import {
  OPENMODAL,
  CLOSEMODAL,
  AUTH_SET_INFO,
  LOGOUT,
  LOGIN,
  REGISTER
} from './mutation-types'

const mutations = {
  // modal
  [OPENMODAL] (state) {
    state.modal.open = true
  },
  [CLOSEMODAL] (state) {
    state.modal.open = false
  },
  // auth
  [AUTH_SET_INFO] (state, data) {
    state.user.authenticated = data.authenticated;
    state.user.id = data.id;
    state.user.name = data.name;
    state.user.email = data.email;
  },
  [LOGOUT] (state) {
    state.user.authenticated = false;
    state.user.id = '';
    state.user.name = '';
    state.user.email = '';
    localStorage.removeItem('jwt-token');
  },
  [LOGIN] (state) {
    location.href = OAUTH.host + '/oauth/authorize?response_type=code&client_id='+OAUTH.client_id+'&client_secret='+OAUTH.secret+'&redirect_uri='+OAUTH.redirect_url+'&state='+laravel.csrf;
  },
  [REGISTER] (state) {
    location.href = OAUTH.host+'/auth/register';
  }
}
export default mutations

