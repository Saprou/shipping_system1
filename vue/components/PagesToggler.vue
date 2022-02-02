<template>
  <div class="pages-toggler-container">
    <section class="next-pre">
        <section @click="next()">
          <svg viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M11.039 17.692a.857.857 0 01-1.317-1.098L13.55 12 9.722 7.406a.857.857 0 111.317-1.098l4.276 5.132a.848.848 0 01.208.56.854.854 0 01-.208.56l-4.276 5.132z" style="animation:slide-17 1s infinite alternate both cubic-bezier(1,-.01,0,.98)"/></svg>
        </section>
        <section>
            {{counter}} / {{Math.ceil(arrayLength/10)}}
        </section>
        <section @click="pre()">
        <svg viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M14.008 17.692a.857.857 0 001.317-1.098L11.495 12l3.829-4.594a.857.857 0 00-1.317-1.098L9.73 11.44a.85.85 0 00-.208.56.854.854 0 00.208.56l4.277 5.132z" style="animation:slide-14 1s infinite alternate both cubic-bezier(1,-.01,0,.98)"/></svg>
        </section>
    </section>
  </div>
</template>

<script>
export default {
    props:{
        arrayLength:{default:0},
        from:{default:0},
    },
    data(){
        return{
            counter:1
        }
    },
    methods:{
        next(){
            if((this.counter)*10 <= this.arrayLength){
                this.counter++;
                this.$emit('update:from',this.counter*10-10);
            }

        },
        pre(){
            if(!(this.counter <= 1)){
                this.counter--;
                this.$emit('update:from',this.counter*10-10);
            }
        },
    },
}
</script>

<style lang='scss' scoped>
.pages-toggler-container{
    text-align:center;
    padding:0.2em 0.4em;
    direction: rtl;
    .next-pre{
        display:inline-flex;
        align-items: center;
        background-color:#4d4d4d;
        border-radius:4px;
        overflow:hidden;
        border:1px solid #aaa;
        color:#fff;fill:#fff;
        section{
            display:inline-flex;   align-items: center; 
            padding:0.2em 0.4em;
            border:1px solid #aaa;
            cursor:pointer;
        }
        section:nth-of-type(2){
            border:none;
            cursor:unset;
            font-size:0.8em;
        }
    }

}

</style>