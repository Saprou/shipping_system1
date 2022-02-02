<template>
  <div class="input-container">
    <section class="label">
        <label for="">{{label}}</label>
        <span v-if="required">*</span>
    </section>
    <div class="inputX">
        <select :id="myobject.name" :value="myobject.value" :class="[myobject.err?'err-input':null]" @input="typed($event.target.value)">
            <slot></slot>
        </select>
        <p id="err-message" v-text="myobject.err"></p>
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
          myobject:this.object
      }
  },
    methods:{
        typed(value){
            this.myobject.value = value;
            this.myobject.err = null;
            if(this.required && this.myobject.value=='empty'){
                this.myobject.err = this.__('Required');
            }
            this.$emit('update:object',this.myobject);
        },
    },
}
</script>

<style lang='scss' scoped>
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
        font-size:1em;
        margin:0.4em;
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
            select{
                background-color:#fff;
                display:inline-block;
                min-width:$min-width;       width:100%;
                font-size:$font-size;     
                padding:0.3em;
                outline:none;
                border-radius:$border-radius;
                border: $border;
                transition:all 0.5s ease;
                width:stretch;
                cursor:pointer;
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