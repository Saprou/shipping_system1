<template>
  <div :style="'width:'+width" class="button-container" :class="notAllowed ?'not-allowed' :null">
      <section v-if="svg" v-html="svg">
      </section>
      <p><slot></slot></p>
  </div>
</template>

<script>
export default {
    props:{
        width:{default:'unset'},
        svg:{default:null},
        notAllowed:false
    }
}
</script>

<style lang='scss' scoped>
.button-container{
    margin:0.8em;
    display:inline-flex;
    align-items: center;
    padding: 0.5em 0.6em;
    border-radius:0.4em;
    background-color:transparent;
    border:2px solid #ff6600;
    cursor:pointer;
    transition:padding 0.3s ease;
    height:max-content;
    &:hover{
        background-color:#b6281e;
    }
    svg{
        width:0.4em; 
    }
    p{
        display:inline-block;
        outline:none;     border:none;
        color:#ff6600;     font-size:0.7em;    font-weight:900;
        background-color:transparent;
        margin:0 0.3em;
        text-align: center;
        flex:1;

    }
}
.not-allowed{
    cursor:not-allowed;
    background-color:rgba(128, 128, 128, 0.5) !important;
}
</style>