import * as types from './mutation-types'

// actions
export const actions = {
  async fetchComments({commit}, payload) {
    try {
      const {data} = await this.$axios.get('/comments');

      return data;
    } catch (e) {
      console.error(e)
    }
  },
};
