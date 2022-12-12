<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="em">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
        <link rel="stylesheet" href="<?php echo base_url();?>jquery/style.js">
        <title>Registration form</title>
</head>
<body>

          
    <div class="container">
        <header>Registration</header>
        
    
    <div id="message"></div>
    <form action="<?php echo base_url('hospital/insert')?>" method='POST' >
    <h2>Basic information</h2>
    <br>
    <div class="user-details">
      
    <div class="input-box">
            <label class ="details" for="name">Name: </label>
            <input  type="text" placeholder="Enter the name" id="patientname" name="patientname" />   
            <p><?php echo form_error('patientname')?></p>  
</div>  
<div class="input-box">
            <label>Phone Number: </label>
            <input type="number" placeholder="Enter Number" id="phoneNumber" name="phoneNumber"/> 
            <p><?php echo form_error('phoneNumber')?></p>          
</div>

<br>
<br>
<br>
<br>
<div class="input-box">
            <label>Address: </label>
            <input type="text" placeholder="Enter Address" id="address" name="address"/>
            <p><?php echo form_error('address')?></p>   
</div>


<div class="input-box">

            <label>Age: </label>
            <input type="number" placeholder="Enter Age"  id="age" name="age"/>
            <p><?php echo form_error('age')?></p>   
</div>

</div>
<br><br>
            <label>Language :</label>
            <input  class="language" type="checkbox" name = language value="English" />
            <label>English</label>
            <input class="language" value="Nepali" name = language type="checkbox" />
            <label>Nepali</label>
            <p><?php echo form_error('language')?></p>  
<br>

            <label>Gender :</label>
            <input  class="gender" value="Male"type="radio" name="gender" />
            <label>Male</label>
            <input  class="gender" value="Female" type="radio" name="gender" />
            <label>Female</label>
<p><?php echo form_error('gender')?></p> 
<br>

</label>Country:</label>
<select id="country" name="country">
    <option value=" "></option>
  
</select>

<br>
<br>
</label>Province:</label>
<select id="province" name="province">
<option value=" "></option>

</select>

<br>
<br>
</label>Municipality:</label>
<select id="muni" name="municipality">
<option value=" "></option>
</select>

<br>
<br>

           <input type="submit" id="submit"  value="save"/>
      


</div>
</form>

</body>












<script>
    
    // calling function
getprovince();
getmunicipality();

//fetch all country name
var url = "<?php echo base_url()."Hospital/fetch"?>";

    $.get({
url,
success:function(data){
    data = JSON.parse(data);
    //console.log(data);

    
    var html = '';
    for(i=0; i<data.length;i++){
       
        html +=  '<option value="' +data[i].id+ '">' +data[i].Country+ '</option>';
    }
    $('#country').html(html);
  
  
    }
  
});

//function to get province
    function getprovince(){

        $("#country").change(function(){
        var countryId = $(this).val();
    

        $.ajax({
            url:'<?php echo base_url()?>Hospital/provins',
            type:"POST",
            datatype:"json",
            data: {
                countryId
            },

            success: function(data){
query =JSON.parse(data);
           
                var html = '';
                for(var i=0; i<query.length;i++){
       
     html +=  '<option value="' +query[i].id+ '">' +query[i].province_name+ '</option>';
                                  
   }
   $("#province").html(html);
 
            }
        });
    });
    
    }



 //function to get Municipality   
function getmunicipality(){

$("#province").click(function(){
 var pid = $(this).val();
 

 $.ajax({
    url:"<?php echo base_url()?>Hospital/municipality",
    type:"POST",
    datatype:"json",
    data: {

    pid

    },
    success: function(data){
        select = JSON.parse(data);
    var html = "";

    for(var i=0; i<select.length;i++){

        html +=  '<option value="' +query[i].id+ '">' +select[i].municipality+ '</option>';

    }
    $('#muni').html(html);


    }
 });

});
}




$(document).ready(function(){
    var patientid = 1;



$('#submit').click(function(){
    var gender =[];
    $(".gender").each(function(){
        if($(this).is(":checked")){

            gender.push($(this).val());
        }
       
    });
    var gender = gender.toString();

    var language =[];
    $(".language").each(function(){
        if($(this).is(":checked")){

            language.push($(this).val());
        }
    });
var language = language.toString();
var patientname = $('#patientname').val();
var phoneNumber =$("#phoneNumber").val();
var address = $('#address').val();
var age = $('#age').val();
var country = $('#country').find(":selected").text();
var province = $('#province').find(":selected").text();
var municipality = $("#muni").find(":selected").text();
var date = new Date();
 var patientid = Math.floor(Math.random() * 10);
// localStorage.setItem('patientid',patientid);



var url = "<?php echo base_url()."hospital/insert" ?>";
$.post(url, {

   patientid,
    patientname,
    phoneNumber,
    address,
    age,
    country,
    province,
    municipality,
    gender,
    language,
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
});













</script> 