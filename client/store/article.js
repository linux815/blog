import * as types from './mutation-types'

// state
export const state = {
  article: null,
};

// getters
export const getters = {
  article: state => state.article,
};

// mutations
export const mutations = {
  [types.FETCH_ARTICLES_SUCCESS](state, {article}) {
    state.article = article;

  },

  [types.FETCH_ARTICLES_FAILURE](state) {
    console.error('fail!');
  },
};

// actions
export const actions = {
  async fetchArticles({commit}, payload) {
    try {
      const {data} = await this.$axios.get('/articles');

      commit(types.FETCH_ARTICLES_SUCCESS, {article: data});

      return data;
    } catch (e) {
      commit(types.FETCH_ARTICLES_FAILURE)
    }
  },

  async fetchArticle({commit}, payload) {
    try {
      return await this.$axios.get('/articles/' + payload.id);
    } catch (e) {
      commit(types.FETCH_ARTICLES_FAILURE)
    }
  },
};
