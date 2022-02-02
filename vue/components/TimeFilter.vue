<template>
  <div class="filter-container">
      <section>
          <label for="">{{ __('from') }}</label>
          <input type="date"  @input="From($event.target.value)"  :value="from" name="" />
      </section>
      <section>
          <label for="">{{ __('to')}}</label>
        <input type="date"  @input="To($event.target.value)"  :value="to" name="" />
      </section>
  </div>
</template>

<script>
export default {
props:{
    from:{default:''},
    to:{default:''}
},
methods:{
    From(v){
        v = v == ''? '2021-01-01':v;
        this.$emit('update:from',v);
    },
    To(v){
        v = v == ''? '2050-01-01':v;
        this.$emit('update:to',v);
    },
}
}
</script>

<style lang='scss' scoped>
.filter-container{
    display:inline-block;
    position:relative;
    margin:0.4em;
    border:2px solid #aaa;
    section{
        display:inline-block;
        position:relative;
        label{
            position:absolute;
            font-size:0.6em;
            padding:0.2em 0.4em;
            border-radius:0.3em;
            background-color:#fff;
            top:-1.2em;
            right:0.5em;
            color:#000;
        }
        input{
            width:max-content;
            height:40px;
            border-left:1px solid #eee;
            padding-inline-start: 0;
            outline:none;
            border-radius:0;    
            background-color:#fff;
            cursor:pointer;
            font-size:0.6em;
            option{
                border-radius:0;
            }
        }
    }
}
</style>