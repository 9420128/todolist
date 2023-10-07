<script setup>
import BtnSmall from '@/components/html/BtnSmall.vue'
</script>

<template>
    <BtnSmall class="add-todo"> Добавить задачу </BtnSmall>
</template>

<style lang="scss">
.add-todo {
    padding: 1em;
    margin: 1em 0;
    font-size: 16px;
    background: white;
    border: 1px solid var(--solid);
}
</style>
