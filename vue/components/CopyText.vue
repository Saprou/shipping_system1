<template>
  <div class="copy-text-container">
      <section class="title">
          {{__(title)}}
      </section>
      <input :value="value" style="display:none;" type="text">
      <p @click="Copy($event.target)">{{value}}</p>
  </div>
</template>

<script>
export default {
    props:{
        value:{default:'No value'}
    },
    data(){
        return {
            title:'Copy'
        }
    },
    methods:{
        Copy(input){
            input = input.previousSibling;
            input.style.display = 'inline-block';
            input.select();
            if(document.execCommand('copy')){
                this.title= 'Copied !';
            }else{
                this.title= 'Error !';
            }
            input.style.display = 'none';
            setTimeout(() => {
                this.title = 'Copy';
            }, 1000);
        }
    }
}
</script>

<style lang='scss' scoped>
.copy-text-container{
    position:relative;
    &:hover .title{
        display: block;
    }
    .title{
        position:absolute;  display:none;
        bottom:calc(100% + 0.6em);  right:0;    left:0;
        width:min-content;
        margin:auto;
        font-size:0.75em;
        border-radius: 0.3em;
        background-color:#aaa;
        color: #fff;
        padding:3px;
        font-weight: 900;
        &:after{
            content:'';
            border: 0.6em solid transparent;
            border-top-color: #aaa;
            position: absolute;
            top:100%;   right:0;    left:0; width: 0.6em; margin:auto;
        }
    }
    p{
        display:inline-block;
        cursor:pointer;
        user-select: none;
        padding:0.3em;
        border-radius:0.2em;
        &:hover{
            box-shadow:inset 0 0 50px 0 #aaa;
        }
    }
}
</style>