<template>
  <div>
      <header>
          <section style="display:inline-block">
              <label for="search-by">Search For</label>
              <select v-model="searchBy" name="search-by" id="">
                  <option value=0>user</option>
                  <option value=1>item</option>
              </select>
          </section>
        <MySearch @searchClicked="Search()" v-model:modelValue="searchInput" />
        <section class="statuses-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg>
            <section class="statuses">
                <h1>Order</h1>
                <p v-for="status in statuses" :key="status.value">{{status.value}} => {{status.label}}</p>
                <h1>Pickup</h1>
                <p>1 => new</p>
                <p>25 => ready</p>
                <p>2 => courier on way to seller</p>
                <p>3 => in stock</p>
                <p>4 => faild</p>
                <h1>Trip</h1>
                <p>1 => started</p>
                <p>2 => ended</p>
                <p>3 => collected</p>
                <p>4 => paid</p>
            </section>
        </section>
      </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td>User ref</td>
                      <td>status change</td>
                      <td>item awb/id</td>
                      <td>At</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="action in actions" :key="action.id">
                      <td>{{action.user_ref}}</td>
                      <td>{{action.desc}}</td>
                      <td>{{action.on_ref}}</td>
                      <td>{{action.created_at}}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
export default {
data(){
    return{
        searchInput:'',
        searchBy:0,
        actions:[],
        statuses:this.$genStore.getters.orderStatuses,

    }
},
methods:{
    Search(){
        this.$axios({
            method:'post',
            url:'/dashboard/admin/find-actions',
            data:{ref:this.searchInput,on:this.searchBy}
        }).then(res => {
            this.actions = res.data.data
        })
    }
}
}
</script>

<style lang='scss' scoped>
.statuses-container{
    display:inline-block;
    position:relative;
    font-size:0.7em;
    h1{
        margin: 0.2em 0;
    }
    svg:hover ~.statuses{
        display:block;
    }
    .statuses{
        position:absolute;  top:50%;right:0;
        max-width:90vw;
        background-color:#fff;  padding:0.7em;
        z-index:3;  display:none;
        min-width:max-content;
    }
    .statuses:hover{
        display:block;
    }
}
</style>