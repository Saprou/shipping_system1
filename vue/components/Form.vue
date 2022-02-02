<template>
<div>
  <div>
    <Logo/>
  </div>
  <form action="">
    <header v-if="title">
      <h3>{{__(title)}}</h3>
    </header>
    <div>
      <slot></slot>
    </div>
    <footer>
      <LangPicker />
    </footer>
  </form>
</div>
</template>

<script>
export default {
  props:{
    title:{default:null}
  }
}
</script>

<style lang='scss' scoped>
div{
  text-align:center;
form{
  &>header{
    padding:0.5em 0.6em;
    border-bottom:1px solid #aaaaaa88;
  }
  &>footer{
    padding:0.5em 0.8em;
    border-top:1px solid #aaaaaa22;
  }
  &>div{
    padding:1em 0;
    text-align: start;
  }
  text-align: start;
  display:inline-block;
  background-color:#fff;
  border-radius:0.8em;
  box-shadow:-0.1em 0.1em 0.2em 0 #aaaddd55;
  margin:1em;
  max-width: 80vw;
}
}
</style>