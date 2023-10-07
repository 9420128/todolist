<script setup>
import Close from "@/components/btnIcons/Close.vue";
import {useTodoList} from "@/stores";

let todoListStorage = useTodoList()

</script>

<template>
    <div class="modal__container" :class="todoListStorage.alertOption.type">
        <Close @click="todoListStorage.actionModalSwitch()"/>
        <h3 class="reset">{{ todoListStorage.alertOption.message ? todoListStorage.alertOption.message : 'Отправка ...' }}</h3>
    </div>
</template>

<style lang="scss">
.modal__container {
    &.success {
        background: rgba(0, 128, 0, 0.99);
        color: white;
        font-weight: 400;

        .close{
            color: white;
        }
    }

    &.error {
        background: rgba(255, 0, 0, 0.99);
        color: white;
        font-weight: 400;

        .close{
            color: white;
        }
    }
}
</style>