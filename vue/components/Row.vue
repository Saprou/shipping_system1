<template>
  <div class="row">
      <slot></slot>
  </div>
</template>

<script>
export default {

}
</script>

<style lang='scss' scoped>
    .row{
        flex:1;
        padding:0.1em 0.3em;
        display:flex;
        justify-content: center;
        gap:0.3em;
    }
    @media screen and (max-width:800px){
        .row{
            flex-direction:column;
        }
    }
</style>