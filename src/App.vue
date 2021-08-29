<template>
  <div id="app">
    <router-view 
      v-on:logged-out="saveTodos" 
      v-on:todo-added="saveTodos" 
      v-on:todo-edited="saveTodos"
      v-on:logged-in="loadTodos" 
    />
  </div>
</template>


<script>
export default {
created(){
  this.$store.commit('SET_USER', localStorage.getItem('user'));
  if(this.$store.getters.USER){
    this.loadTodos();
  }
},
beforeUnmount() {
  if(this.$store.getters.USER){
    this.saveTodos();
  }
},
components : {
  
},
methods : {
  saveTodos(){
    const store = {};
            store.todos = this.$store.getters.TODOS;
            store.user = this.$store.getters.USER;
            const str = JSON.stringify(store);
            console.log(str);
            let sendTodos = async () => {
            let response = await fetch('saveTodos.php', {
                method : 'POST',
                headers : {
                'Content-Type' : 'application/json;charset=utf-8'
                },
                mode : 'cors',
                body : str
            });
            let result = await response.text();
            console.log(result);
            }
            sendTodos();
  },
  loadTodos(){
    const user = this.$store.getters.USER;
    let loadTodos = async () => {
      let response = await fetch(`loadTodos.php?user=${user}`);
      let todos = await response.json();
      console.log(todos);
      
      this.$store.commit('LOAD_TODOS', todos);
    }
    loadTodos();
  },
  whatch(){
    this.$store.subscribe(() => {
      alert(342324);
      this.saveTodos();
    })
  }
    
},

}
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  button{
    padding: 5px 10px;
    background-color: white;
    border-radius: 7px;
    border: 2px solid #2c3e50;
    color: #2c3e50;
    transition: linear 0.2s;
    &:hover {
      background-color: lighten($color: #2c3e50, $amount: 65);
    }
  }
}
.container{
        display: block;
        max-width: 1200px;
        margin: 0 auto;
        padding: 25px 0px;
        overflow: hidden;
    }

/* Box sizing rules */
*,
*::before,
*::after {
  box-sizing: border-box;
}

/* Remove default padding */
ul[class],
ol[class] {
  padding: 0;
}

/* Remove default margin */
body,
h1,
h2,
h3,
h4,
p,
ul[class],
ol[class],
li,
figure,
figcaption,
blockquote,
dl,
dd {
  margin: 0;
}

/* Set core body defaults */
body {
  min-height: 100vh;
  scroll-behavior: smooth;
  text-rendering: optimizeSpeed;
  line-height: 1.5;
}

/* Remove list styles on ul, ol elements with a class attribute */
ul[class],
ol[class] {
  list-style: none;
}

/* A elements that don't have a class get default styles */
a:not([class]) {
  text-decoration-skip-ink: auto;
}

/* Make images easier to work with */
img {
  max-width: 100%;
  display: block;
}

/* Natural flow and rhythm in articles by default */
article > * + * {
  margin-top: 1em;
}

/* Inherit fonts for inputs and buttons */
input,
button,
textarea,
select {
  font: inherit;
}

/* Remove all animations and transitions for people that prefer not to see them */
@media (prefers-reduced-motion: reduce) {
  * {
 animation-duration: 0.01ms !important;
 animation-iteration-count: 1 !important;
 transition-duration: 0.01ms !important;
 scroll-behavior: auto !important;
  }
}
</style>
