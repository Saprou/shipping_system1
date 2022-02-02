<template>
  <div id="message" class="message-container">
      <section class="message">
        <section class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill='#FFFFFF'><path d="M12 0L0 23h24L12 0zm0 21c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm0-5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2s2 .9 2 2v6c0 1.1-.9 2-2 2z"></path></g></svg>
        </section>
        <section class="content">
            {{message}}
        </section>
      </section>
  </div>
</template>

<script>
export default {
    props:{
        message:{default:'no message'}
    },
    mounted(){
        this.fadeIn();
        this.closee();
    },
    methods:{
        fadeIn(){
            setTimeout(function(){
                let loader = document.querySelector('#message');
                loader.style.top = '5px';
            },1);
        },
        closee(){
            let self = this;
            setTimeout(function(){
                let loader = document.querySelector('#message');
                loader.style.top = '-3em';
            },4000);
            setTimeout(function(){
                self.$emit('close',false);
            },5000);
        }
    }
}
</script>

<style lang='scss' scoped>
.message-container{
    position:absolute;  display:inline-block;
    top:-2em;    left:0; right:0;
    margin:auto;
    background-color:#d63031;
    box-shadow:0 0 2px 0 #aaa;
    border-radius:0.3em;
    padding:0.4em 1em;
    z-index:100;
    width:max-content;
    border:3px solid #fff;
    transition:top 0.3s ease-out;
    box-shadow:0 0 3px 0 #999;
    .message{
        fill:#fff;
        color:#fff;
        display:flex;
        svg{
            height:1em; width:1em;
            margin: 0 0.3em;
        }
    }
}

</style>