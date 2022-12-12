<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<table>
<thead>
    <tr>
        <td>Test Name</td>
        <td>price</td>
        <td>Qty</td>
        <td>Total price</td>
        <td>Discount%</td>
        <td>Discount</td>
        <td>Net Total</td>
       
       
    
</tr>

</thead>
<tbody id="datas">

</tbody>
</table>
<style>
  body{
    background-color:white;
  }
    table{
        width:1500px;
        font-size:20px;
        margin:auto;
    }

    table,td,th{
        border:1px solid black;
        border-collapse:collapse;
       
    }
    th,td{
      padding:10px;
    }
    thead{
      background-color:rgb(33, 33, 105);
      color:white;
    }


</style>

<script>
   var id = localStorage.getItem('id');
   $(document).ready(function(){

  

    $.ajax({
        url: "<?php echo base_url()."hospital/allDatas"?>",
        type:"POST",
        datatype:"json",
        data:{
            id

        },
        success:function(data){
            data = JSON.parse(data);
            
var html = '';
for(i=0; i<data.length;i++){
    html += '<tr>'+'<td class="stud_id" >'+data[i].test_item+'</td>'+
    '<td >'+data[i].price+'</td>'+
    '<td >'+data[i].qty+'</td>'+
    '<td >'+data[i].total+'</td>'+
    '<td >'+data[i].dpercent+'</td>'+
    '<td>'+data[i].damount+'</td>'+
    '<td>'+data[i].nettotal+'</td>'+
  
   
    

 
    '</tr>'
}
$("#datas").html(html);


}
            
        });
    });



</script>