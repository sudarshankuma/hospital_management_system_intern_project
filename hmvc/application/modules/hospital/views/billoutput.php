<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<h2>Billing </h2>
<h4>patientid</h4>
<div id="patientid"></div>
<hr>

        <form>
           <div class="inp">
        <td><input type="text" id="item" placeholder="Test items" name="item"/>
    </td>
        <td><input type="text" placeholder="Qty" id="qty" name="quantity"/></td>
        <td><input type="text" placeholder="Unit price" id="price"/></td>
        <td><input type="text" placeholder="Discount%" id="percent"/></td>

        
        <td><input type="button" value="Add" id="add"/> || <input type="button" value="Clear"/></td>   
        </div>

</form>
<table  style="border:1px solid black;">
    <thead >
 <tr id="header" style="border:1px solid black;" >
    </td>
  
        <td>Test items</td>
       <td>Unitprice</td>
       <td>Qty</td>
       <td>TotalPrice</td>
        <td>Discount%</td>
        <td>Discount</td>
        <td>Net Total</td>
        
       
</tr>
</thead>
<tbody id="data">


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
    h2{
        background-color:rgb(33, 33, 105);
        color:white;
        padding:10px;
    }
   form  .inp input{
    height:50px;
    width:200px;
   }


</style>

<script>

    $(document).ready(function(){
       
   
    $('#add').click(function(){
        var patientid = localStorage.getItem('rid');
        var item = $('#item').val();
        var qty = $('#qty').val();
        var price = $('#price').val();
        var total = qty * price;
        var percent = $('#percent').val();
    
         var amount = parseFloat(percent/100) * total;
         var nettotal = total-amount;
       var date = new Date();
    
var url='<?php echo base_url()."Hospital/finaloutput"?>'
        $.post(url,{
 patientid,
item,
qty,
price,
total,
percent,
amount,
nettotal,
date

        },
        function(checkdata){
            
            checkdata=JSON.parse(checkdata);
   if (checkdata.status == "success") {
                alert(" Data save");
            } else {
                alert("failed");
            }

        }
        
        );
        
        
    });

    get();
});
    function get(){
        var patientid = localStorage.getItem('rid');
    $.ajax({
            url:'<?php echo base_url()?>Hospital/getbillingData',
            type:"POST",
            datatype:"json",
            data: {
                patientid
            },

            success: function(data){
    data =JSON.parse(data);
          console.log(data);
                var html = '';
                for(var i=0; i<data.length;i++){
                    html += '<tr>'+'<td class ="stud_id">'+data[i].test_item+'</td>'+
    '<td >'+data[i].price+'</td>'+
    
    '<td >'+data[i].qty+'</td>'+
    '<td >'+data[i].total+'</td>'+
    '<td >'+data[i].dpercent+'</td>'+
    '<td >'+data[i].damount+'</td>'+
    +data[i].patientid+
    '<td >'+data[i].nettotal+'</td>'+
      '</tr>' ;
                                  
  }
  $("#data").html(html);
  $("#patientid").html(patientid);
 
            }
        });
  

    
    }






</script>





