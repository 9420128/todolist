<template>
    <div class="container">
        <div class="img__container">
            <img alt="Vue logo" src="./assets/logo.png">
            <img alt="Pinia logo" src="./assets/Pinia.png">
            <img alt="Php logo" src="./assets/lgo-php.jpeg">
            <img alt="Mysql logo" src="./assets/Mysql.png">
        </div>
        <h1>Веб-приложение для учета задач (To-Do List)</h1>
        <AddTodo @click="todoListStorage.actionModalSwitch()"/>
        <div v-if="todoListStorage.getTodoList.length">
          <TopLine/>
          <div class="row">
              <TodoTable/>
          </div>
          <BottomLine/>
        </div>
        <div class="empty-block" v-else>
          <h2>Список задач пуст</h2>
        </div>
        <AddTodo @click="todoListStorage.actionModalSwitch()"/>
    </div>
    <Modal v-if="todoListStorage.modal"/>
    <Footer/>
</template>

<script setup>
import {useTodoList} from "@/stores";
import {onMounted} from "vue";
import TodoTable from "@/components/app/TodoTable.vue";
import TopLine from "@/components/app/TopLine.vue";
import AddTodo from "@/components/btnIcons/AddTodo.vue";
import BottomLine from "@/components/app/BottomLine.vue";
import Modal from "@/components/app/Modal.vue";
import Footer from "@/components/app/Footer.vue";

let todoListStorage = useTodoList()

onMounted(() => {
    let formData = new FormData();
    formData.append('actions', 'get');
    todoListStorage.actionTodoListFetch(formData)
})
</script>

<style lang="scss">
body{
    background: #f6f7f8;
    margin: 0;
    padding: 0;
}

#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    margin-top: 60px;
    font-size: 18px;
}

.container{
    display: block;
    margin: 5% auto;
    box-sizing: border-box;
    padding: 0 2em;
    min-height: calc(100vh - 180px);
    max-width: 1240px;
    width: 100%;
}

.margin{
    display: block;
    margin-top: 2em;
}

input, textarea{
    width: 100%;
    border: 1px solid var(--solid);
    //border: none;
    font-size: 16px;
    color: #2c3e50;
    padding: .5em 1em;
    border-radius: .64em;
    box-sizing: border-box;
    margin: 0;
    font-family: inherit;
    outline:none;
}

button{
    white-space: nowrap;
    border: none;
    background: transparent;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    color: #2c3e50;

    &:not([disable]){
        cursor: pointer;
    }
}

::placeholder {
    color: #999;
    opacity: 1;
    font-size: 14px;
    letter-spacing: 0.05em
}

::-ms-input-placeholder {
    color: #999;
    font-size: 14px;
    letter-spacing: 0.05em
}

svg{
    color: inherit;
    fill: currentColor;
}

.row{
    background: white;
    padding: 0 .64em;
    overflow: hidden;
}

.empty-block{
    padding: 2em;
    box-sizing: border-box;
    border-radius: 1em;
    background: white;
}

.img__container{
    display: flex;
    justify-content: space-around;
    >img{
        max-height: 60px;
    }
}

:root{
    --solid: #e4e4e4;
    --todo-color: rgb(9, 65, 236);
}
</style>
