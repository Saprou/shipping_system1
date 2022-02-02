<template>
    <div class="updateable-input-container" @dblclick="disabled = false">
        <span v-if="!disabled" @click="disabled = true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z"/></svg>
        </span>
      <input  
            :class="disabled?'disabled':null" 
            class="updateable-input"  :value="modelValue"
            @blur="disabled = true"
            @keypress.enter="$emit('update:modelValue',$event.target.value);disabled = true"
            type="text">
    </div>
</template>
<script>
export default {
    /*    */
    props:['modelValue'],
    data(){
        return{
            disabled:true
        }
    },
    methods:{
        cc(){
            console.log('sf')
        }
    }
}
</script>

<style lang="scss" scoped>
    .updateable-input-container{
        svg{
            margin:0.2em;
            width:1em;
            height:1em;
            cursor:pointer;
        }
    }
    .disabled{
        pointer-events: none;
        background-color:inherit;
        border:none;
        outline:none;
        font-size:inherit;
        color:inherit;
        cursor:pointer;
    }
</style>