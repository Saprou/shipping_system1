<template>
  <section class="status" :style="'background-color:'+background_color">
      <slot></slot>
  </section>
</template>

<script>
export default {
props:{
    background_color:{default:'black'}
}
}
</script>

<style lang='scss' scoped>
.status{
    display:inline-block;
    border-radius: 0.4em;
    border:1px solid #000;
    color:#fff;
    padding:0.2em 0.4em;
    font-weight: 500;
}
</style>