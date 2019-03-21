import * as types from './mutation-types'

export const getters = {
  loggedIn(state) {
    return state.loggedIn
  },
  user(state) {
    return state.user
  },
};

// actions
export const actions = {
  async fetchUsers({commit}, payload) {
    try {
      const {data} = await this.$axios.get('/users');

      return data;
    } catch (e) {
      console.error(e)
    }
  },
};
