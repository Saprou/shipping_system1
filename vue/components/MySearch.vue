<template>
  <div class="input-container" >
      <input @keydown.enter="$emit('searchClicked')"  type="text" @input="typed($event.target.value)">
      <svg @click="$emit('searchClicked')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.111 20.058l-4.977-4.977c.965-1.52 1.523-3.322 1.523-5.251 0-5.42-4.409-9.83-9.829-9.83-5.42 0-9.828 4.41-9.828 9.83s4.408 9.83 9.829 9.83c1.834 0 3.552-.505 5.022-1.383l5.021 5.021c2.144 2.141 5.384-1.096 3.239-3.24zm-20.064-10.228c0-3.739 3.043-6.782 6.782-6.782s6.782 3.042 6.782 6.782-3.043 6.782-6.782 6.782-6.782-3.043-6.782-6.782zm2.01-1.764c1.984-4.599 8.664-4.066 9.922.749-2.534-2.974-6.993-3.294-9.922-.749z"/></svg>
  </div>
</template>

<script>
export default {
  methods:{
    typed(value){
        this.$emit('update:modelValue',value);
        this.$emit('searchTyped');
    }
  }
}
</script>

<style lang="scss" scoped>
.input-container{
  order:1;
  display: inline-flex;
  box-shadow: 0 5px 7px rgba(128, 128, 128, 0.25);
  margin: 0.3em;
  border-radius: 300px;
  border: 1px solid rgba(128, 128, 128, 0.5);
  padding: 0.3em;
  align-items: center;
  direction:ltr;
  background-color:#fff;
  &:hover{
    border:1px solid #db291d; 
  }
  &:focus{
    border:3px solid #db291d; 
    box-shadow:0 0 4px 1px #db291d;
  }
  &>input{
    border: none;
    outline: none;
    height: 100%;
    flex: 1;
    text-indent: 1em;
    font-size: 0.7em;
    background-color:inherit;
  }
  &>svg{
    border-left:1px solid #999;
    padding: 2px 4px;
    cursor:pointer;
    &:hover{
        transform:scale(1.1);
    }
  }
}
@media screen and (max-width:400px) {
  .input-container{
    width:calc(100% - 0.6em);
  }
}
</style>