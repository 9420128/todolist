<script setup>
const props = defineProps({
    name: String,
    type: String,
    placeholder: String,
    value: [String, Number]
})
</script>

<template>
    <label :for="name" class="label">
        <input :type="props.type ?? 'text'"
               :name="name"
               class="input"
               :placeholder="placeholder"
               :value="props.value"
               required
        >
    </label>
</template>

<style lang="scss">
.label{
    margin: 1em;
    display: block;
}

.input{

}
</style>