<template>
  <div class="filters">
      <svg class="FilterIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M1 0h22l-9 15.094v8.906l-4-3v-5.906z"/></svg>
        <div class="filters-container">
            <slot></slot>
        </div>
  </div>
</template>

<script>
export default {
mounted(){
    let Filters = document.querySelectorAll('.filters-container');
    let FilterIcons = document.querySelectorAll('.FilterIcon');
    let FilterContainers = document.querySelectorAll('.filters-container');
    FilterIcons.forEach(icon => {
        icon.addEventListener('click',function(e){
            e.stopPropagation();
            icon.nextElementSibling.classList.toggle('fadeIn');
        })
    })
    FilterContainers.forEach(icon => {
        icon.addEventListener('click',function(e){
            e.stopPropagation();
        })
    })
    document.body.addEventListener('click',function(){
        Filters.forEach(filter => {
            filter.classList.remove('fadeIn');
        })
    })
}
}
</script>

<style lang='scss' scoped>
.filters{
    position:relative;
    display:inline-block;
    svg{
        max-height:1.5em; max-width:1.5em;  cursor:pointer;
    }
    .filters-container{
        z-index:20;
        background-color:#fff;
        display:none;
        position:absolute;
        border-radius: 0.4em;
        box-shadow:0 0 4px 0 #7e7b7bb7;
        top:100%;   left:-1em;
        padding:0.6em;
    }
    .fadeIn{
        display:block !important;
        animation:FadeIn 0.4s ease-in-out;
    }
}
@keyframes FadeIn {
    0%{
        opacity: 0;
    }
    100%{
        opacity: 1;
    }
}
</style>