<template>
    <div class="container">
        <div class="centerize column-direction">
        <header>
            <img class="logo" :src="'/photos/logog.jpeg'" alt="Logo">
        </header>
        <div class="card" :style="'direction:' + $genStore.getters.getDir">
            <div class="card-header">
                <h2>{{__('Verify Email')}}</h2>
                <p v-if="$genStore.getters.getLocale == 'ar'" @click="$genStore.commit('setLocale','en')" style="margin:0 0.8em;cursor:pointer;">En</p> 
                <p v-if="$genStore.getters.getLocale == 'en'" @click="$genStore.commit('setLocale','ar')" style="margin:0 0.8em;cursor:pointer;">ألعربية</p>
            </div>
            <div class="card-body">
                {{__('verify message')}}
                <form action="/email/resend" method="POST" class="d-inline">
                    <input type="hidden" name="_token" :value="csrf">
                    <button type="submit" class="btn primary-btn">
                        {{__('Resend')}}
                    </button>
                </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }),
    }
</script>

<style lang='scss' scoped>

</style>