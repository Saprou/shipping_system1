<template>
  <div id="print-page" class="print-page">
      
      <div style="text-align:center">
          <h2>{{order.awb}}</h2>
      </div>
      <table style="width:100%" class="receiver-details" >
          <h2 style="border-top:3px solid #000;border-bottom:3px solid #000;padding:8px 0">Receiver Details/ تفاصيل ألمرسل إليه</h2>
          <thead><td style="font-weight: 900;">Name</td><td style="font-weight: 900;">Mobile</td > <td style="font-weight: 900;">Sec Mobile</td></thead>
          <tr><td>{{order.name}}</td> <td>{{order.mobile}}</td> <td>{{order.sec_mobile}}</td></tr>
      </table>
      <table style="width:100%" class='order-details' >
          <h2 style="border-top:3px solid #000;border-bottom:3px solid #000;padding:8px 0">Order Details/تفاصيل الطلب</h2>
          <thead> <td style="font-weight: 900;">Total Cash</td> <td style="font-weight: 900;">Order AWB</td> </thead>
          <tr>  <td>{{order.total_cash}} L.E</td> <td>{{order.awb}}</td></tr>
      </table>
      <table class='order-details' >
          <h2 style="border-top:3px solid #000;border-bottom:3px solid #000;padding:8px 0">Location Details/تفاصيل الموقع</h2>
          <tr > <td style="font-weight: 900;">City:</td> <td>{{order.city}}</td></tr>
          <tr style="height:10px"></tr>
          <tr > <td style="font-weight: 900;">Area:</td> <td>{{order.area}}</td></tr>
          <tr style="height:10px"></tr>
          <tr > <td style="font-weight: 900;">Street:</td> <td>{{order.street}}</td></tr>
          <tr style="height:10px"></tr>
          <tr > <td style="font-weight: 900;">Building:</td> <td>{{order.building}}</td></tr>
          <tr style="height:10px"></tr>
          <tr > <td style="font-weight: 900;">Floor:</td> <td>{{order.floor}}</td></tr>
          <tr style="height:10px"></tr>
          <tr > <td style="font-weight: 900;">Landmarks:</td> <td>{{order.landmarks}}</td></tr>
      </table>
  </div>
</template>

<script>
import Barcode from 'vue-barcode';
export default {
    props:['order'],
    components:{
        Barcode
    }
}
</script>

<style lang='scss' scoped>
</style>