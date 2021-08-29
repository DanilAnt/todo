<template>
    <div class="todo-card">
        <h2 class="todo-card__name">{{ name }}</h2>
        <div class="todo-card__description">{{ description }}</div>
        <div class="todo-card__picture" v-if="img">
            <img :src="getImgUrl()" alt="">
        </div>
        
        <!-- <div class="todo-card__status">{{ status }}</div> -->
        <div class="todo-card__footer">
            <button type="button" class="button todo-card__button" @click="$router.push({name : 'edit', params: { id: index }})">Редактировать</button>
        </div>
    </div>
</template>

<script>
export default {
    name : "TodoCard",
    props : ['index', 'name', 'description', 'status','img'],
    methods : {
        getImgUrl(){
            return `/pictures/${this.img}`;
        }
    },
    
}
</script>
<style lang="scss">
.todo-card{
    padding: 15px 0;
    text-align: left;
    border-top: 1px solid  rgba($color: #2c3e50, $alpha: .5);
    border-bottom: 1px solid  rgba($color: #2c3e50, $alpha: .5);
    margin: 5px 0;
}
.todo-card__name{
    padding-left: 10px;
}
.todo-card__picture{
    max-width: 300px;
    max-height: 300px; 
    margin-bottom: 25px;
    img{
        object-fit: cover;
    }
}
.todo-card__description{
    word-wrap: break-word;
    -webkit-hyphens: auto; -ms-hyphens: auto; hyphens: auto;
}
.todo-card__button{
    margin-top: 15px;
    font-size: 12px;
    font-weight: 600;
}
.todo-card__footer{
    text-align: right;
    padding-right: 5px;
}
</style>