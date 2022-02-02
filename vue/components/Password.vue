<template>
  <div class="input-container">
    <section class="label">
        <label for="">{{label}}</label>
        <span v-if="required">*</span>
    </section>
    <div class="inputX">
        <input :id="myobject.name" :type="type ? 'password':'text'" :value="object.value" :class="[myobject.err?'err-input':null]" @input="typed($event.target.value)">
        <p id="err-message" v-text="myobject.err"></p>
        <div class="eye-container">
            <svg v-if="type" @click="type = false" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Eye</title><path d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 00-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 000-17.47C428.89 172.28 347.8 112 255.66 112z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
            <svg v-if="!type" @click="type = true" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Eye Off</title><path d="M432 448a15.92 15.92 0 01-11.31-4.69l-352-352a16 16 0 0122.62-22.62l352 352A16 16 0 01432 448zM255.66 384c-41.49 0-81.5-12.28-118.92-36.5-34.07-22-64.74-53.51-88.7-91v-.08c19.94-28.57 41.78-52.73 65.24-72.21a2 2 0 00.14-2.94L93.5 161.38a2 2 0 00-2.71-.12c-24.92 21-48.05 46.76-69.08 76.92a31.92 31.92 0 00-.64 35.54c26.41 41.33 60.4 76.14 98.28 100.65C162 402 207.9 416 255.66 416a239.13 239.13 0 0075.8-12.58 2 2 0 00.77-3.31l-21.58-21.58a4 4 0 00-3.83-1 204.8 204.8 0 01-51.16 6.47zM490.84 238.6c-26.46-40.92-60.79-75.68-99.27-100.53C349 110.55 302 96 255.66 96a227.34 227.34 0 00-74.89 12.83 2 2 0 00-.75 3.31l21.55 21.55a4 4 0 003.88 1 192.82 192.82 0 0150.21-6.69c40.69 0 80.58 12.43 118.55 37 34.71 22.4 65.74 53.88 89.76 91a.13.13 0 010 .16 310.72 310.72 0 01-64.12 72.73 2 2 0 00-.15 2.95l19.9 19.89a2 2 0 002.7.13 343.49 343.49 0 0068.64-78.48 32.2 32.2 0 00-.1-34.78z"/><path d="M256 160a95.88 95.88 0 00-21.37 2.4 2 2 0 00-1 3.38l112.59 112.56a2 2 0 003.38-1A96 96 0 00256 160zM165.78 233.66a2 2 0 00-3.38 1 96 96 0 00115 115 2 2 0 001-3.38z"/></svg>
        </div>
    </div>
  </div>
</template>

<script>

export default {
  props:{
    label:{},
    required:{default:true},
    object:{defualt:{value:null,err:null,name:null}},
  },
  data(){
      return{
          myobject:this.object,
          type:true,

      }
  },
  methods:{
    typed(value){
        this.myobject.value = value;
        this.myobject.err = null;
        if(this.required && this.myobject.value.length==0){
            this.myobject.err = this.__('Required');
            this.$emit('update:object',this.myobject);
            return null;
        }
        if(this.type == 'number'&& !/^\d+$/.test(value)){
            this.myobject.err = this.__('Has to be a number')
         }
         this.$emit('update:object',this.myobject);
      },
   },
}
</script>

<style lang='scss' scoped>
html[dir='ltr'] .eye-container{
    right:0.2em;
}
html[dir='rtl'] .eye-container{
    left:0.2em;
}
        /* Variables */
$min-width:9em;
$font-size:0.7em;;        /* height depends on font-size */
$border:2px solid #aaa;
$border-radius:4px;
$on-focus-color:dodgerBlue;
        /* End Of Variables */

    .input-container{
        display:inline-block;
        flex:1;
        margin:0.4em;
        font-size:1em;
        .label{
            min-width:max-content;
            span{
                display:inline;
                color:red;
            }
            label{
                display:inline-block;
                min-width:max-content;
            }
        }
        .inputX{
            display:flex;
            position:relative;
            input{
                display:inline-block;
                min-width:$min-width;       width:100%;
                font-size:$font-size;     
                padding:0.3em;
                outline:none;
                padding-inline-end: 2em;
                border-radius:$border-radius;
                border: $border;
                transition:all 0.5s ease;
                width:stretch;
                &:focus{
                    border-color:$on-focus-color;
                    box-shadow:0 0 8px 0 $on-focus-color;
                }
            }
            .err-input{
                border-color:#f00 !important;
                background-color:rgba(255, 99, 71,0.2);
                &:focus{
                    box-shadow:0 0 8px 0 #f00 !important;
                }
            }
            .eye-container{
                position:absolute;
                width:1em;
                top:0;  bottom:0;    margin:unset;
                display:flex;   align-items:center;
            }
            svg{
                width:80%;
                cursor:pointer;
            }
        }
        #err-message{
            color:#f00;
            font-size:0.6em;
            position:absolute;
            top:100%;
        }
        .go-right{
            left:unset;
            right:0;
        }
        .go-left{
            left:0;
            right:unset;
        }
    }
</style>