<template>
  <div class="window" v-if="status">
      <div class="window-content form-card">
          <header class="window-content-header">
              <h4>Delivery Cash</h4>
          </header>
          <div class="window-content-body" style="padding:0.6em;">
              <input v-model="cash" type="number" class="basic-input">
          </div>
          <div style="text-align:center">
              <button class="sec-button" @click="close()">Cancel</button>
              <button class="basic-button" @click="submit()">Submit</button>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props:['status'],
    data(){
        return{
            cash:''
        }
    },
    methods:{
        submit(){
            this.$emit('submit-cash-window',this.cash)
            this.cash = '';
        },
        close(){
            this.$emit('close-cash-window')
            this.cash = '';
        }
    }
}
</script>

<style>

</style>