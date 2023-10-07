<script setup>
import {useTodoList} from "@/stores";

const props = defineProps({
    id: [Number, String]
})

let todoListStorage = useTodoList()

const checkboxChange = id => {
    todoListStorage.actionCheckboxChange(id)
}
</script>

<template>
    <div class="checkbox">
        <label :for="id" @change="checkboxChange(id)">
            <input type="checkbox" class="checkbox__input" name="" :id="id"/>
            <span class="checkbox__box"><svg class="" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.4 7.5998c-.4-.4-1-.4-1.4 0l-4.00001 4-2-2c-.4-.4-1-.4-1.4 0-.4.4-.4 1 0 1.4l2.7 2.7c.2.2.4.3.7.3.3 0 .5-.1.7-.3l4.70001-4.7c.4-.4.4-1 0-1.4z"></path></svg></span>
        </label>
    </div>
</template>

<style lang="scss">
.checkbox{
    position: relative;
    top: .4em;
    left: -.3em;

    label{
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        user-select: none;
    }

    &__input{
        display: none;

        &:checked ~ .checkbox__box{
            background: var(--todo-color);

            > svg {
                visibility: visible;
                fill: rgb(255, 255, 255);
            }
        }
    }

    &__box{
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        width: 16px;
        height: 16px;
        background: white;
        border-radius: 4px;
        border: 1px solid rgba(0, 16, 61, 0.12);

        > svg {
            visibility: hidden;
            fill: #333;
            width: 16px;
        }
    }
}
</style>