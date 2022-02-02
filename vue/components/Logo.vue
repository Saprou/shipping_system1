<template>
<a href="/">
    <img @click="clicked()" src="photos/logo.png" alt="Logo" >
</a>
</template>

<script>
export default {
}
</script>

<style lang='scss' scoped>
    a{
        display:inline-block;
        max-height:100%;
        img{
            max-width:6em;
        }
    }
</style>