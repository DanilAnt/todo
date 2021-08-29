<template>
    <div class="edit-todo container">
        <div class="edit-todo__inner">
            <button type="button" @click="$router.push({name : 'main'})">На главную</button>
        </div>
        <form id="edit-todo__form" class="edit-todo__form">
            <div class="edit-todo__item">
                <span class="edit-todo__name">Наименование задачи:</span>  <input type="text" v-model="todo.name" placeholder="введите название">
            </div>
            <div class="edit-todo__item">
                <span class="edit-todo__name">Описание:</span> <textarea class="edit-todo__description" type="text" v-model="todo.description" placeholder="опишите задачу"></textarea>
            </div>
            <div class="edit-todo__item">
                <span class="edit-todo__name">Статус:</span>
                <div class="edit-todo__input">
                    <input type="radio" id="for_execution" value="К выполнению" v-model="todo.status"> 
                    <label for="for_execution">К выполнению</label>
                </div>
                <div class="edit-todo__input">
                    <input type="radio" id="in_progress" value="В процессе" v-model="todo.status"> 
                    <label for="in_progress">В процессе</label>
                </div>
                <div class="edit-todo__input">
                    <input type="radio" id="done" value="Выполнено" v-model="todo.status"> 
                    <label for="done">Выполнено</label>
                </div>
            </div>
            
            <div class="edit-todo__item">
                <button type="button" class="edit-todo__button" @click="editTodo">Изменить</button>
                <button type="button" class="edit-todo__button" @click="deleteTodo">Удалить</button>
            </div>
        </form>
        <span class="edit-todo__message" v-if="isDelited">Удалено!</span>
        <span class="edit-todo__message" v-else-if="isEdited">Изменено!</span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            index : this.$route.params.id,
            todo : this.$store.getters.TODO(this.$route.params.id),
            isEdited : false,
            isDelited : false,
        }
    },
    methods : {
        editTodo() {
            this.todo.id = this.index;
            this.$store.commit('EDIT_TODO', this.todo);
            this.isEdited = true;
            this.$emit('todoEdited');
        },
        deleteTodo(){
            this.$store.commit('DELETE_TODO', this.index);
            this.isDelited = true;
            this.$emit('todoEdited');
        },
        changeEditStatus() {
            this.isEdited = false;
        }
    },
    watch : {
        'todo.name' : 'changeEditStatus',
        'todo.description' : 'changeEditStatus',
        'todo.status' : 'changeEditStatus',
        'todo.img' : 'changeEditStatus'
    }

}
</script>

<style lang="scss">
.edit-todo__inner{
   display: flex;
   justify-content: flex-start;
}
.edit-todo__form{
    display: flex;
    flex-direction: column;
}
.edit-todo__item{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0;
    @media (max-width: 700px) {
        flex-direction: column;
    }
}
.edit-todo__description{
    width: 100%;
    max-width: 500px;
    height: 100px;
}
.edit-todo__name{
    margin-right: 20px;
    font-weight: 600;
}
.edit-todo__button{
    margin: 5px 20px;
}
.edit-todo__input{
    margin: 5px 6px;
}
.edit-todo__message{
    font-size: 24px;
}
</style>