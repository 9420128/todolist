<script setup>
import {useTodoList} from "@/stores";
import OkIcon from "@/components/btnIcons/OkIcon.vue";

const data = [
    {id: 'dateUp', name: 'Сначала новые'},
    {id: 'dateDown', name: 'Сначала старые'},
    {id: 'statusesUp', name: 'Выполненые'},
    {id: 'statusesDown', name: 'Не выполненые'},
    {id: 'sortClean', name: 'Сбросить', hr: true}
]

let todoListStorage = useTodoList()

const sortItemClick = id => {
    todoListStorage.actionSortItemClick(id)
    todoListStorage.sort = false
}


</script>

<template>
    <div class="nav">
        <div
            v-for="item in data" :key="item.id"
            class="nav__item"
            :class="{'nav__item-hr' : item.hr}"
            @click="sortItemClick(item.id)"
        >
            <OkIcon v-if="item.id === todoListStorage.sortItemValue && item.id !== 'sortClean'"/>
            <span class="nav__item-text">
                {{ item.name }}
            </span>
        </div>
    </div>
</template>

<style lang="scss">
.nav{
    position: absolute;
    right: 0;
    top: 2em;
    min-width: 160px;
    width: max-content;
    background: white;
    display: flex;
    flex-direction: column;
    box-shadow: rgba(0, 16, 61, 0.16) 0px 4px 32px 0px;
    border-radius: .64em;
    padding: .64em 0;

    &__item{
        position: relative;
        padding: .64em .2em;
        font-size: .84em;
        cursor: pointer;

        &:hover{
            background: #f6f7f8;
        }

        &-text{
            padding: 0 1.4em;

        }
    }

    &__item-hr{
        border-top: 1px solid var(--solid);
    }
}
</style>