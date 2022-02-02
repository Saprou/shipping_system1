<template>
  <div class="filter-container">
      <select @input="Selected($event.target.value)"  :value="modelValue" name="">
          <slot></slot>
      </select>
  </div>
</template>

<script>
export default {
props:['modelValue'],
data(){
    return{
    }
},
methods:{
    Selected(v){
        this.$emit('update:modelValue',v);
    }
}

}
</script>

<style lang='scss' scoped>
.filter-container{
    display:inline-block;
    position:relative;
    margin:0.4em;
    select{
        width:100px;
        height:40px;
        padding-inline-start: 16px;
        outline:none;
        border-radius:0;    border:2px solid #aaa;
        background-color:#fff;
        cursor:pointer;
        font-size:0.6em;
        option{
            border-radius:0;
        }
    }
}
.filter-container:after{
    top: 3px;
}
html[dir='ltr'] .filter-container:after{
    position:absolute;
    left:4px;
    width:12px;
    content:url('data:image/svg+xml; utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M1 0h22l-9 14.094v9.906l-4-2v-7.906z"/></svg>')
    }
html[dir='rtl'] .filter-container:after{
    position:absolute;
    right:4px;
    width:12px;
    content:url('data:image/svg+xml; utf8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M1 0h22l-9 14.094v9.906l-4-2v-7.906z"/></svg>')

    }
</style>