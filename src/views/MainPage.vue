<template>
    <div class="main container">
        
        <div v-if="$store.getters.USER" class="main__inner">
            <div class="main_user">Ваши задачи, {{$store.getters.USER}}:</div>
            <button class="button" type="submit" @click="logOut">Выйти</button>
        </div>
        <form v-else class="main__inner">
            <input type="text" v-model="user" placeholder="Введите ник">
            <button class="button" type="submit" @click="logIn">Войти</button>
        </form>
        <button type="button" class="main__button button" @click="$router.push({name : 'add'})">Добавить задачу</button>

        <div class="main__table">
            <div class="main__table-collumn " >
                <h2 class="main__header">К выполнению:</h2>
                <div class="main__table-data"  v-for="(todo, index) in this.$store.getters.TODOS" :key="index">
                    <todo-card v-if="todo.status==='К выполнению'" :index="index" :name="todo.name" :description="todo.description" :status="todo.status" :img="todo.img"/>
                </div>
            </div>
            <div class="main__table-collumn " >
                <h2 class="main__header">В процессе:</h2>
                <div class="main__table-data" v-for="(todo, index) in this.$store.getters.TODOS" :key="index">
                    <todo-card v-if="todo.status==='В процессе'" :index="index" :name="todo.name" :description="todo.description" :status="todo.status" :img="todo.img"/>
                </div>
            </div>
            <div class="main__table-collumn " >
                <h2 class="main__header">Выполнено:</h2>
                <div class="main__table-data" v-for="(todo, index) in this.$store.getters.TODOS" :key="index">
                    <todo-card v-if="todo.status==='Выполнено'" :index="index" :name="todo.name" :description="todo.description" :status="todo.status" :img="todo.img"/>
                </div>
            </div>
        </div>
        

    </div>
</template>

<script>
import TodoCard from "../components/TodoCard.vue";
export default {
    data()  {
        return {
            user : "",
        }
    },
    components : {
        TodoCard,
    },
    methods:{
        logIn() {
            this.$store.commit('SET_USER', this.user);
            localStorage.setItem('user', this.user);
            if(this.$store.getters.USER){
                this.$emit('loggedIn');
            }
        },
        logOut() {        
            if(this.$store.getters.USER){
                this.$emit('loggedOut');
            }
            localStorage.clear();
            this.$store.commit('CLEAR');
        },
    },
}
</script>

<style lang="scss">
    .container{
        display: block;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 5px;
    }
    
    .main__inner{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 24px;
        margin-bottom: 20px;
        @media (max-width: 400px) {
            font-size: 18px;
        }
        
    }
    .main__header{
        text-align: left;
        border-bottom: 1px solid #2c3e50;
        padding: 5px 10px;
        margin: 0;
    }
    .main__button{
        font-size: 18px;
    }
    .main__table{
        display: flex;
        width: 100%;
        @media (max-width: 700px) {
            flex-direction: column;
        }
        .main__table-collumn{
            border: 1px solid #2c3e50;
            border-radius: 15px;
            margin: 20px 5px;
            padding: 5px 0;
            display: flex;
            flex-grow: 1;
            max-width: 50%;
            min-height: 70px;
            flex-direction: column;
            @media (max-width: 700px) {
                max-width: 100%;
            }
        }
        .main__table-data{
            width: 100%;
            padding: 0 5px;
        }
    }
</style>