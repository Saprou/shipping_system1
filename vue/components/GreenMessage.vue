<template>
  <div id="message" class="message-container">
      <section class="message">
        <section class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill='#FFFFFF'><path d="M22 13.5c0-.8-.7-1.5-1.5-1.5h-1c.8 0 1.5-.7 1.5-1.5S20.3 9 19.5 9H13s1-3 1-5c0-1-.5-2-1.5-2S11 3 11 4s-.5 4.5-4 8c-1 1-1 2-1 2v5c0 1.1.9 2 2 2h10.5c.8 0 1.5-.7 1.5-1.5s-.7-1.5-1.5-1.5h1c.8 0 1.5-.7 1.5-1.5s-.7-1.5-1.5-1.5h1c.8 0 1.5-.7 1.5-1.5zM5 21H2v-9h3z"></path></g></svg>
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
    background-color:#00b894;
    box-shadow:0 0 2px 0 #aaa;
    border-radius:0.3em;
    padding:0.4em 0.4em;
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
            margin: 0 0.7em;
        }
    }
}

</style>