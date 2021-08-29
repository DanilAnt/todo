<template>
    <div class="add-todo container">
        <div class="add-todo__inner">
            <button type="button" @click="$router.push({name : 'main'})">На главную</button>
        </div>
        <form class="add-todo__form" id="formElem">
            <div class="add-todo__item">
                <span class="add-todo__name">Наименование задачи:</span> <input  type="text" v-model="form.name" placeholder="введите название">
            </div>
            <div class="add-todo__item">
                <span class="add-todo__name">Описание:</span> <textarea class="add-todo__description" type="text" v-model="form.description" placeholder="опишите задачу"></textarea>
            </div>
            <div class="add-todo__item">
                <span class="add-todo__name">Статус:</span>
                <div class="add-todo__input">
                    <input type="radio" id="for_execution" value="К выполнению" v-model="form.status">  
                    <label for="for_execution">К выполнению</label>
                </div> 
                <div class="add-todo__input">
                    <input type="radio" id="in_progress" value="В процессе" v-model="form.status"> 
                    <label for="in_progress">В процессе</label>
                </div>
                <div class="add-todo__input">
                    <input type="radio" id="done" value="Выполнено" v-model="form.status"> 
                    <label for="done">Выполнено</label>
                </div> 
            </div>
            
            <div class="add-todo__item add-todo__item--column">
                <div class="add-todo__preview" id="preview"></div>
                <input class="add-todo__input--hide" type="file" name="picture" id="formImage" accept="image/*" @change="showPicture">
                <label class="add-todo__button" for="formImage">Загрузите изображение</label>
                
            </div>
            
            <div class="add-todo__item">
                <button type="submit" class="main__button" @click="addTodo">Добавить задачу</button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            form : {
                name : "",
                description : "",
                status : "К выполнению",
                img : ""
            },
            formImage : document.getElementById("formImage"),
        }
    },
    methods : {
        addTodo() {
            if (document.getElementById("formImage").files[0]) {
                this.savePicture();
                // this.form.img = this.savePicture();
            }
            this.$store.commit('ADD_TODO', this.form);
            this.$router.push({name : 'main'});
            this.$emit('todoAdded');
        },
        showPicture() {
            const container = document.getElementById('preview');
            const formImage = document.getElementById("formImage");
            let file = formImage.files[0];
            let reader = new FileReader();
            reader.onload = function (e) {
                container.innerHTML = `<img src="${e.target.result}" alt="photo">`;
            }
            reader.onerror = function(e){
                alert(`ERROR ${e}`);
            }
            reader.readAsDataURL(file);
        },
        savePicture() {
            const formElem = document.getElementById('formElem');
            const formData = new FormData(formElem);
            formData.append('user', this.$store.getters.USER);
            let sendForm = async () => {
                let response = await fetch('saveFile.php', {
                    method: 'POST',
                    body: formData
                });
                let result = await response.text();
                
                this.form.img = result;
            }
            sendForm();
        }
    }
}
</script>

<style lang="scss">
.add-todo__inner{
   display: flex;
   justify-content: flex-start;
}
.add-todo__form{
    display: flex;
    flex-direction: column;
}
.add-todo__item{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0;
    &--column{
        flex-direction: column;
    }
    @media (max-width: 700px) {
        flex-direction: column;
    }
}
.add-todo__name{
    margin-right: 20px;
    font-weight: 600;
}
.add-todo__input{
    margin: 5px 6px;
    &--hide{
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
}
.add-todo__description{
    width: 100%;
    max-width: 500px;
    height: 100px;
}
.add-todo__button{
    padding: 5px 10px;
    background-color: white;
    border-radius: 7px;
    border: 2px solid #2c3e50;
    color: #2c3e50;
    transition: linear 0.2s;
    margin: 5px;
    &:hover {
      background-color: lighten($color: #2c3e50, $amount: 65);
    }
}
.add-todo__preview{
    width: 300px;
    max-height: 300px; 
    margin-bottom: 25px;
    img{
        object-fit: cover;
    }
}
</style>