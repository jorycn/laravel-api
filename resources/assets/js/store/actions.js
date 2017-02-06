import {
  OPENMODAL,
  CLOSEMODAL,
  AUTH_SET_INFO,
  LOGOUT,
  LOGIN,
  REGISTER
} from './mutation-types'

//common
export const openModal = ({ commit }) => {
  commit(OPENMODAL)
}
export const closeModal = ({ commit }) => {
  commit(CLOSEMODAL)
}

//Auth
export const authSetInfo = ({ commit }, data) => {
  commit(AUTH_SET_INFO, data)
}
export const logout = ({ commit }) => {
  commit(LOGOUT)
}
export const login = ({ commit }) => {
  commit(LOGIN)
}
export const register = ({ commit }) => {
  commit(REGISTER)
}