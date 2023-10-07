<script setup>

</script>

<template>
    <footer class="footer">
        2023 —
        <a rel="nofollow" href="79052088078" class="btn btn__dark" onclick="event.preventDefault(); window.open((/android|webos|iphone|ipad|ipod|blackberry|eimobile|opera mini/i.test(navigator.userAgent) ? 'whatsapp://send?phone=' : 'https://web.whatsapp.com/send/?phone=') + this.getAttribute('href'), '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes')">
            Kotkov</a>
    </footer>
</template>

<style scoped lang="scss">
.footer{
    display: flex;
    margin-top: 20px;
    padding: 1.8em;
    box-sizing: border-box;
    justify-content: center;
    align-items: center;
    background-color: #999;
    box-shadow: 6px 11px 12px 4px #797979 inset;
    color: white;
    font-size: .9rem;
    z-index: 3;
    flex: 0 0 auto;

    a{
        margin-left: 4px;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
}
</style>