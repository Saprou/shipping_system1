<template>
  <div class="button-container">
      <button>{{label}}</button>
  </div>
</template>

<script>
export default {
    props:{
        label:{default:'Button'}
    }
}
</script>

<style lang='scss' scoped>
.button-container{
    margin:0.8em;
    display:inline-block;
    button{
        padding: 0.6em 0.8em;
        border-radius:0.4em;
        background-color:rgba(128, 128, 128, 0.5);
        color:#fff;     font-size:0.7em;    font-weight:900;
        outline:none;     border:none;
        cursor:not-allowed;
        transition:padding 0.3s ease;
    }
}
</style>