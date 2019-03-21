import * as types from './mutation-types'

// actions
export const actions = {
  async fetchCategories({commit}, payload) {
    try {
      const {data} = await this.$axios.get('/categories');

      return data;
    } catch (e) {
      console.error(e)
    }
  },
};
