<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="tab">
<!doctype html>
<html>
  <head>
</head>
<body>
  <h1>Registered Patient</h1>  
  
  <table style="border:1px solid black;">
    <thead>
    <tr >
    <td >S.N</td>
        <td >Patient ID</td>
        <td >Patient Name</td>
        <td >Age/Sex</td>
        <td>District</td>
        <td>Gender</td>
        <td >Address</td>
        <td>Reg.Date</td>
        <td>Action</td>
        


    <tr>

</thead>
<tbody  id="datas">


</tbody>

<table>
</div>
<body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

   
  </body>
</html>
<style>
  body{
    background-color:white;
  }
    table{
        width:1000px;
        font-size:20px;
        margin:auto;
    }

    table,td,th{
        border:1px solid black;
        border-collapse:collapse;
        text-align:center;
    }
    th,td{
      padding:20px;
    }
    thead{
      background-color:rgb(33, 33, 105);
      color:white;
    }


</style>


<script>

    var url = "<?php echo base_url()."hospital/fetchOutput"?>";

$.get({
url,
success:function(data){
data = JSON.parse(data);

var html = '';
for(i=0; i<data.length;i++){
    html += '<tr>'+'<td class ="stud_id">'+data[i].patientid+'</td>'+
    '<td >'+data[i].id+'</td>'+
    '<td >'+data[i].patientname+'</td>'+
    '<td >'+data[i].age+'</td>'+
    '<td >'+data[i].province+'</td>'+
    '<td >'+data[i].gender+'</td>'+
    '<td >'+data[i].address+'</td>'+
    '<td >'+data[i].date+'</td>'+
   '<td><button type="button" value="' +data[i].id+ '"  id = "review">view</button><br><button type="button" value="' +data[i].patientid+ '" class="billing">RegBill</button></td>'  + 
    '</tr>'
}
$("#datas").html(html);


}

});


$('#datas').on("click","#review" ,function(){
 var pid = $(this).closest('tr').find('.stud_id').text();
 
 localStorage.setItem('id',pid);
 
      window.location.replace(<?php base_url()?>"hospital/preview");
    }
  
    );
     

    $('#datas').on("click",".billing" ,function(){
 var pid = $(this).closest('tr').find('.stud_id').text();
 localStorage.setItem('rid',pid);

 window.location.replace(<?php base_url('html')?>"hospital/billing");


});



</script>