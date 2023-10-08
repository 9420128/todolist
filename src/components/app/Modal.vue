<script setup>
import {useTodoList} from "@/stores";
import BtnSmall from "@/components/html/BtnSmall.vue";
import TodoInput from "@/components/html/TodoInput.vue";
import Close from "@/components/btnIcons/Close.vue";
import TodoAlert from "@/components/app/TodoAlert.vue";

let todoListStorage = useTodoList()
const formSubmit = (e) => {

    const form = e.target.closest('form')
    const formData = new FormData(form);

    formData.append("actions", "add");
    formData.append("table", "todo_list");

    todoListStorage.actionTodoListFetch(formData)

    todoListStorage.alert = true
}

const closeModal = (e) => {
    if(e.target.classList.contains('modal') && todoListStorage.modal){
        todoListStorage.actionModalSwitch()
    }
}

</script>

<template>
    <div class="modal" @click="closeModal">
        <TodoAlert v-if="todoListStorage.alert"/>
        <div v-else class="modal__container">
            <Close @click="todoListStorage.actionModalSwitch()"/>
            <form @submit.prevent="formSubmit" method="post" action="/php/controller/PostController.php">
                <h3>Новая задача</h3>
                <input v-if="Object.keys(todoListStorage.modalItem).length" type="hidden" name="id" :value="todoListStorage.modalItem.id">
                <TodoInput name="name" placeholder="Название" :value="todoListStorage.modalItem?.name ?? ''"/>
                <label for="desc" class="label">
                    <textarea
                        name="title"
                        id="desc"
                        placeholder="Описание"
                        :value="todoListStorage.modalItem?.title ?? ''"
                        required
                    ></textarea>
                </label>
                <TodoInput type="date" name="date" :value="todoListStorage.modalItem?.date ?? ''"/>
                <div class="modal__footer">
                    <BtnSmall type="submit" class="primary">{{ Object.keys(todoListStorage.modalItem).length ? 'Изменить' : 'Добавить' }}</BtnSmall>
                    <BtnSmall @click.prevent="todoListStorage.actionModalSwitch()">Отменить</BtnSmall>
                </div>
            </form>
        </div>
    </div>
</template>

<style lang="scss">
.modal{
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);

    &__container{
        background-color: #fefefe;
        width: 100%;
        max-width: 600px;
        border-radius: 1em;
        box-sizing: border-box;
        margin: 1em;
        position: relative;

        h3{
            display: block;
            padding: .84em;
            margin: 0;
            font-size: 1.1em;
            font-weight: bold;
            border-bottom: 1px solid var(--solid);

            &.reset{
                border: none;
            }
        }
    }

    &__footer{
        display: flex;
        align-items: center;
        gap: .5em;
        margin-top: 1em;
        height: 3em;
        border-top: 1px solid var(--solid);
        padding: 0 1em;

        .btn-small{
            font-size: 17px;
        }
    }
}

</style>