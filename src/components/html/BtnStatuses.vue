<script setup>
import {useTodoList} from "@/stores";

const props = defineProps({
    statuses: Number,
    id: [String, Number]
})

let todoListStorage = useTodoList()

const statusesClick = (id) => {
    todoListStorage.modal = true
    todoListStorage.alert = true
    let body = {
        actions: 'edit',
        table: 'todo_list',
        data: [{
            'statuses': props.statuses ? 0 : 1,
            'id': id,
        }]
    }
    todoListStorage.actionTodoListFetch(body)
}
</script>

<template>
<a
    href="#"
    :class="{'btn-statuses__end' : props.statuses}" class="btn-statuses"
    :title="props.statuses ? 'Задача выполнена' : 'Пометить выполненным'"
    @click.prevent="statusesClick(id)"
>
</a>
</template>

<style lang="scss">
.btn-statuses{
    &::before{
        content: "";
        width: 9px;
        height: 9px;
        display: block;
        background-color: var(--todo-color);
        opacity: 1;
        position: relative;
        //z-index: 1;
        border-radius: 50%;
        transition: background-color 0.25s linear 0s;
    }

    &__end:before{
        background-color: white;
        opacity: 0;
    }
}
</style>