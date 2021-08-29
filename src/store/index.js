import { createStore } from 'vuex'

export default createStore({
  state: {
    todos : [
      // {
      //   name : "",
      //   description : "",
      //   status : "",
      //   img : ""
      // },
    ],
    user : "",
  },
  
  mutations: {
    ADD_TODO : (state, payload) => {
      state.todos.push(payload);
    },
    LOAD_TODOS : (state, payload) => {
      state.todos = payload;
    },
    EDIT_TODO : (state, payload) => {
      let id = payload.id;
      state.todos[id] = payload; 
    },
    DELETE_TODO : (state, payload) => {
      let id = payload;
      state.todos.splice(id, 1);
    },
    CLEAR : (state) => {
      state.todos = [];
      state.user = "";
    },
    SET_USER : (state, payload) => {
      state.user = payload;
    }
  },
  getters : {
    TODOS : state => {return state.todos},
    TODO : state => id => {return state.todos[id]},
    USER : state => {return state.user},
    STORE : state => {return state},
  },
  actions: {
  },
  modules: {
  }
})
