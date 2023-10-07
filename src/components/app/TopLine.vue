<script setup>
import SelectAll from "@/components/btnIcons/SelectAll.vue";
import Delete from "@/components/btnIcons/Delete.vue";
import Pencil from "@/components/btnIcons/Pencil.vue";
import Sort from "@/components/btnIcons/Sort.vue";
import {useTodoList} from "@/stores";
import {ref} from "vue";
import SortNav from "@/components/app/SortNav.vue";

let todoListStorage = useTodoList()

let selectAllClickFlag = ref(false)
const selectAllClick = () => {
    selectAllClickFlag = !selectAllClickFlag
    let selectAllId = []
    document.querySelectorAll('input[type=checkbox]').forEach((item) => {
        if(!selectAllClickFlag) {
            if (!item.checked) item.checked = true
            selectAllId.push(String(item.id))
        }else{
            item.checked = false
        }
    })
    todoListStorage.actionCheckboxChange(selectAllId)
}

const deleteClick = () => {
    if(todoListStorage.checkboxChange.length){
        todoListStorage.modal = true
        todoListStorage.alert = true

        let body = {
            actions: 'delete',
            table: 'todo_list',
            data: todoListStorage.checkboxChange
        }

        todoListStorage.actionTodoListFetch(body)
    }
}

const editClick = () => {
    const todoItem = todoListStorage.getTodoList.filter(item => item.id === +todoListStorage.checkboxChange[0])
    todoListStorage.actionModalSwitch(todoItem)

}

const sortClick = () => {
    todoListStorage.actionSortSwitch()
}
</script>

<template>
<div class="top-line">
    <div class="top-line__col-1">
        <SelectAll @click="selectAllClick"/>
        <Pencil @click="editClick" v-show="todoListStorage.checkboxChange.length === 1"/>
        <Delete @click="deleteClick" v-show="todoListStorage.checkboxChange.length"/>
    </div>
    <div class="top-line__col-2">
        <Sort @click="sortClick"/>
        <SortNav v-if="todoListStorage.sort"/>
    </div>
</div>
</template>

<style lang="scss">
.top-line{
    position: sticky;
    top: 0;
    z-index: 1;
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: white;
    padding-top: .54em;
    box-sizing: border-box;
    border-top-left-radius: 1em;
    border-top-right-radius: 1em;
    border-bottom: 1px solid var(--solid);

    &__col-1{
        margin-left: 1.9em;
        display: flex;
    }

    &__col-2{
        margin-right: .5em;
        display: flex;
        position: relative;
    }
}
</style>