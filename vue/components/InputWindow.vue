<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
        <header>{{__(title)}}</header>
            <input v-model="modelValue" type="text" class="basic-input"/>
            <MyButton @click="submit()" :label="__('Submit')"/>
      </div>
      <section class="X" @click="close()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
      </section>
  </div>
</template>

<script>
export default {
    props:{
        title:{default:'No Title'},
        modelValue:{default:null}
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            this.$emit('submit',this.modelValue);
        },
        close(){
            this.$emit('close',false);
        },
        fadeIn(){
            setTimeout(function(){
                let popups = document.getElementsByClassName('popup-container');
                popups[0].style.opacity = '1';
            },1);
        }
    },
}
</script>

<style lang='scss' scoped>
    .popup-container{
        transition:opacity 0.3s ease-in;
        position:fixed;
        inset:0;
        display:flex;
        opacity:0;
        align-items: center;    justify-content: center;
        z-index:20;
        .popup-background{
            position: absolute;
            inset: 0;
            background-color:rgba($color: #504b4b, $alpha: .7);
            z-index:-1;
        }
        .popup-content{
            max-height:100%;
            max-width:69vw;
            background-color:#fff;
            border-radius:0.4em;
            overflow:auto;
            display:flex;   flex-direction:column;
            input{
                font-size:1em;
                min-width:270px;
                margin:0.2em;

            }
            header{
                padding:0.2em 0.7em;
                border-bottom:1px solid #aaa;
            }
        }
        .X{
            position:absolute;
            top:1em;        right:1em;
            fill:tomato;
            cursor:pointer;
        }
    }
</style>