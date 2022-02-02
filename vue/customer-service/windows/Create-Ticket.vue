<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <form action="" method="post">
              <Row>
                  <MyInput v-model:object="ticket.agent_name" :label="'Agent Name'" />
                  <MyInput v-model:object="ticket.agent_ref" :label="'Agent Ref'" />
              </Row>
              <Row>
                  <MyInput v-model:object="ticket.mobile" :label="'Mobile'" />
                  <MyInput v-model:object="ticket.AWB" :label="'AWB'" />
              </Row>
              <Row>
                  <MySelect v-model:object="ticket.subject" :label="'Subject'">
                    <option value=0>Select</option>
                    <option value=1>Where is the shipment</option>
                    <option value=2>General Question</option>
                    <option value=3>Cancel Delivery</option>
                    <option value=4>Wrong Update</option>
                    <option value=5>Misbehavior</option>
                    <option value=6>Refund Delay</option>
                    <option value=7>Reschedule Delivery</option>
                    <option value=8>Shipment Damaged</option>
                    <option value=9>Change Pickup Address</option>
                    <option value=10>Change Tel/Mob Number</option>
                    <option value=11>Urgent Pickup</option>
                    <option value=12>Shipment Missing</option>
                    <option value=13>Delay Pickup</option>
                    <option value=14>Customer Follow-Up</option>
                  </MySelect>
                  <MySelect v-model:object="ticket.area" :label="'Area'">
                    <option value=0>Select</option>
                    <option value=1>Cairo</option>
                    <option value=2>Giza</option>
                    <option value=3>Qalyubia</option>
                  </MySelect>
              </Row>
              <Row>
                  <MySelect v-model:object="ticket.group" :label="'Group'">
                    <option value=0>Select</option>
                    <option value=1>Inbound Team</option>
                    <option value=2>Outbound Team</option>
                    <option value=3>Operation Team</option>
                  </MySelect>
                  <MyInput v-model:object="ticket.description" :label="'Description'" />
              </Row>
              <Row>
                  <MyButton @click.prevent="submit()" :label="'Create'" />
              </Row>
          </form>
      </div>
      <section class="X" @click="close()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
      </section>
  </div>
</template>

<script>
export default {
    data(){
        return{
            ticket:{
                agent_name:{value:null,err:null,name:'err_naem'},
                agent_ref:{value:null,err:null,name:'segsegf'},
                subject:{value:0,err:null,name:'err_nsefgfsaem'},
                area:{value:0,err:null,name:'easffeaw'},
                AWB:{value:null,err:null,name:'err_awasdq54naem'},
                mobile:{value:null,err:null,name:'eFAWD52rr_naem'},
                group:{value:0,err:null,name:'err_AW987naem'},
                description:{value:null,err:null,name:'AWDA2'},
            }
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            if(!this.check()){return null;}
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/accountant/create-ticket',
                data:{ticket:this.Ticket()}
            }).then(res => {
                this.$store.state.tickets.unshift(res.data);
                this.close();
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        close(){
            this.$emit('close',false);
        },
        fadeIn(){
            setTimeout(function(){
                let popups = document.getElementsByClassName('popup-container');
                popups[0].style.opacity = '1';
            },1);
        },
        check(){
            let Ticket = this.ticket;
            /* agent_name */
            if(!Ticket.agent_name.value || Ticket.agent_name.value.length < 3){
                this.errorFound(this.__('Required'),Ticket.agent_name);
                return false;
            }else{Ticket.agent_name.err = null;}
            /* agent_ref */
            if(!Ticket.agent_ref.value || Ticket.agent_ref.value.length < 3){
                this.errorFound(this.__('Required'),Ticket.agent_ref);
                return false;
            }else{Ticket.agent_ref.err = null;}
            /* mobile */
            if(!Ticket.mobile.value || Ticket.mobile.value.length != 11){
                this.errorFound(this.__('Mobile length is 11'),Ticket.mobile);
                return false;
            }else{Ticket.mobile.err = null;}
            /* AWB */
            if(!Ticket.AWB.value || Ticket.AWB.value.length <3){
                this.errorFound(this.__('Required'),Ticket.AWB);
                return false;
            }else{Ticket.AWB.err = null;}
            /* subject */
            if(!Ticket.subject.value || Ticket.subject.value == 0){
                this.errorFound(this.__('Required'),Ticket.subject);
                return false;
            }else{Ticket.subject.err = null;}
            /* area */
            if(!Ticket.area.value || Ticket.area.value == 0){
                this.errorFound(this.__('Required'),Ticket.area);
                return false;
            }else{Ticket.area.err = null;}
            /* group */
            if(!Ticket.group.value || Ticket.group.value == 0){
                this.errorFound(this.__('Required'),Ticket.group);
                return false;
            }else{Ticket.group.err = null;}
            /* group */
            if(!Ticket.description.value || Ticket.description.value.length <3){
                this.errorFound(this.__('Required'),Ticket.description);
                return false;
            }else{Ticket.description.err = null;}
            return true;
        },
        errorFound(message,object){
            object.err = message;
            let input = document.getElementById(object.name);
            input.scrollIntoView(false);
            input.focus();
        },
        Ticket(){
            let ticket = {};
            Object.entries(this.ticket).forEach(([key, value]) => {
                ticket[`${key}`] = value.value
            });
            return ticket;
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
            max-height:70%;
            max-width:96%;
            overflow:auto;
            form{
                background-color:#fff;  padding:0.7em 1em;
                border-radius:0.4em;
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