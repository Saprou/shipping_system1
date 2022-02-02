<template>
  <div class="reset-password-page">
      <header>
          <img :src="'/photos/logog.jpeg'" alt="Logo">
      </header>
      <div class="page-content">
          <header>{{__('Reset Password')}}</header>
          <div class="content">
            <form method="POST" action="{{ route('password.email') }}">
              <input type="hidden" name="_token" :value="csrf">
                <input id="email" type="email" name="email" required autocomplete="email" autofocus>

                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>  
          </div>
          <footer></footer>
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
.reset-password-page{
    height:100vh;   width:100vw;
    display:flex;   flex-direction:column;  align-items:center;
    padding-top:1em;
    &>header{
        padding-top:1em;
        img{
            margin-top:1em;
            height:6em;
        }
    }
}
</style>