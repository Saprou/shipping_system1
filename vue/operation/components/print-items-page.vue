<template>
  <div id="print-items" v-if="$store.state.printPageToggler">
      <div class="page" style="width:100%" v-for="item in $store.getters.selectedCourier.items" :key="item.awb">
        <div style="text-align:center;">
          <p>{{$store.getters.selectedCourier.name}}</p>
          <Barcode :value="$store.getters.selectedCourier.ref" fontSize="15" format="CODE128" width="1" height=30></Barcode>
        </div>
        <table  v-if="item.kind == 'o'">
          <h2 style="border-top:3px solid #000;border-bottom:3px solid #000;padding:8px 0">
            {{item.awb}} <Barcode :displayValue="false" :value="item.awb" fontSize="15" format="CODE128" width="1" height=30></Barcode>/ Seller Name : {{item.seller.f_name}} {{item.seller.l_name}}
          </h2>
            <thead>
                <tr>
                  <td style="font-weight: 900;font-size:1.6em;">Price & Shipping</td>
                  <td style="font-weight: 900;font-size:1.6em;">Amount</td>
                  <td style="font-weight: 900;font-size:1.6em;">Address</td>
                </tr>
            </thead>
            <tbody>
              <tr>
                    <td>{{item.total_cash}}</td>
                    <td>{{item.number_of_items}}</td>
                    <td>{{item.city}}/{{item.area}} /{{item.street}} / {{item.landmarks}}/{{item.building}} /{{item.floor}} /</td>
                </tr>
          </tbody>
            <thead>
                <tr>
                  <td style="font-weight: 900;font-size:1.6em;">customer name</td>
                  <td style="font-weight: 900;font-size:1.6em;">customer mobiles</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{item.name}}</td>
                    <td>{{item.mobile}}/{{item.sec_mobile}}</td>
                </tr>
          </tbody>
        </table>
        <!-- PICKUP -->
        <table v-if="item.kind == 'p'">
          <h2 style="border-top:3px solid #000;border-bottom:3px solid #000;padding:8px 0">
            {{item.awb}} <Barcode :displayValue="false" :value="item.awb" fontSize="15" format="CODE128" width="1" height=30></Barcode>/ Seller Name : {{item.seller.f_name}} {{item.seller.l_name}}
          </h2>
          <thead>
            <tr>
              <td style="font-weight: 900;font-size:1.6em;">Seller Name :</td><td>{{item.seller.name}}</td>
            </tr>
            <tr>
              <td style="font-weight: 900;font-size:1.6em;">Seller Mobiles :</td><td>{{item.seller.mobile}}/{{item.seller.sec_mobile}}</td>
            </tr>
            <tr>
              <td style="font-weight: 900;font-size:1.6em;">Seller Address :</td><td>{{item.seller.locations[0].city}} / {{item.seller.locations[0].area}}</td>
            </tr>
            <tr>
              <td style="font-weight: 900;font-size:1.6em;">Number Of Orders :</td><td>{{item.orders.length}}</td>
            </tr>
            <tr><td style="font-weight: 900;font-size:1.6em;border:1px solid #aaa;">Customer Address</td> <td style="font-weight: 900;font-size:1.6em;border:1px solid #aaa;">Customer Name</td> <td style="font-weight: 900;font-size:1.6em;border:1px solid #aaa;">Amount</td> <td style="font-weight: 900;font-size:1.6em;border:1px solid #aaa;">Order Code</td></tr>
          </thead>
          <tbody>
            <tr v-for="order in item.orders" :key="order.id" style="border-top:1px solid #aaa;">
              <td>{{order.city}}/{{order.area}}/{{order.street}}/{{order.landmarks}}/{{order.building}}/{{order.floor}}</td>
              <td>{{order.name}}</td>
              <td>{{order.number_of_items}}</td>
              <td><Barcode :value="order.awb" fontSize="15" format="CODE128" width="1" height=22></Barcode></td>
            </tr>
          </tbody>
        </table>
        <div>
            <h2 style="background-color:#ccc;border-top:3px solid #000;padding:8px 0">
              printed by : {{$store.state.user.ref}} / {{$store.state.user.f_name}} {{$store.state.user.l_name}}
            </h2>
        </div>
      </div>

  </div>
</template>

<script>
export default {
}
</script>

<style>

</style>