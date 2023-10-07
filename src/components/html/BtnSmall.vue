<script>

</script>

<template>
    <button class="btn-small">
        <slot></slot>
    </button>
</template>

<style lang="scss">
.btn-small{
    height: 28px;
    display: flex;
    align-items: center;
    font-size: .8em;
    border-radius: .64em;
    padding: .64em;
    font-weight: 600;
    color: #4a4a4a;

    &.primary{
        background: var(--todo-color);
        color: white;

        &:hover{
            background: rgb(9 54 194);
        }
    }

    &:hover{
        background: #f1efef;
    }

    svg{
        margin-right: .5em;
    }
}
</style>