<template>
  <div class="page-header">
      <div class="page-header-content">
          <slot></slot>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang='scss' scoped>
.page-header{
    text-align:center;
    display:flex;   justify-content: center;    align-items: center;
    .page-header-content{
        margin:0.4em;
        display:inline-block;
        box-shadow:0 0 3px 0 #aaa;
        border-radius:0.4em;
    }
}
</style>