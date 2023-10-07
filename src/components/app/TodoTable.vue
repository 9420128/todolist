<template>
    <table class="table">
        <tbody>
        <tr v-for="item in todoListStorage.getTodoList" :key="item.id">
            <td><BtnStatuses :statuses="item.statuses ? +item.statuses : 0" :id="item.id"/></td>
            <td><Checkbox :id="item.id"/></td>
            <td>
                <h4>{{ item.name }}</h4>
                <p class="mobile">
                    <small>{{ datePars(item.date) }}</small>
                    {{ item.title }}
                </p>
            </td>
            <td class="desktop">{{ item.title }}</td>
            <td class="desktop">{{ datePars(item.date) }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {useTodoList} from "@/stores";
import BtnStatuses from "@/components/html/BtnStatuses.vue";
import Checkbox from "@/components/html/Checkbox.vue";

let todoListStorage = useTodoList()

const datePars = date =>{
    return new Date(date).toLocaleString('ru-Ru', {
        month: 'long',
        day: 'numeric',
    })
}


</script>

<style lang="scss">
.table{
    width: 100%;
    text-align: left;
    border-collapse: collapse;
    background: white;
    box-sizing: border-box;
    font-family: inherit;

    tbody tr:not(:first-child){
        border-top: 1px solid var(--solid);
    }

    td,th{
        vertical-align: baseline;
        padding-top: .64em;
        padding-bottom: .64em;

        &:not(:last-child) {
            padding-right: 1em;
        }
    }

    td{
        font-size: 16px;
    }

    td:nth-child(3n){
        width: 20%;
    }

    td:nth-child(4n){
        width: 1000%;
    }

    td:last-child{
        white-space: nowrap;
        text-align: right;
    }

    h4{
        padding: 0;
        margin: 1em 0;
    }

    small{
        display: block;
        color: #797979;
        margin-bottom: .8em;

    };
}

.mobile{
    display: none;
}

@media only screen and (max-width: 940px) {
    .desktop {
        display: none;
    }

    .mobile{
        display: block;
    }

    .table td:nth-child(3n) {
        width: 100%;
    }

    .top-line {
        align-items: normal!important;
        padding-bottom: .64em;

        .top-line__col-1 {
            margin-left: .5em;
            flex-direction: column;
            gap: 1em;
        }
    }
}
</style>