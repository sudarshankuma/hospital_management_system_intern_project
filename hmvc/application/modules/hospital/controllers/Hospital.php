<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends MX_Controller {

    public function __construct(){
        parent:: __construct();
       $this->load->library('form_validation');
     //  $this->load->library(array('form_validation','session'));
        
        
        $this->load->Model('hospital_model');
    }





    // function index(){
  
    //     $this->load->view('hospitalview');
        
    // }
    function output(){
        $this->load->view('output');
    }
    function billoutput(){
        $this->load->view('billoutput');
    }
    function preview(){
       // $idd =  $this->input->post('id');
       //$data =  $this->hospital_model->getAllData($idd);
        $this->load->view('preview');
    }
    function billing(){
        
        $data = $this->input->post('html');
        $this->load->view('billoutput',$data);
    }
    function fetch(){
 
        $data = $this->hospital_model->getDatas();
        echo json_encode($data);



    }

    // function allData(){
        
    //     $idd = $this->input->post('pid');
    //     $data =  $this->hospital_model->getAllData($idd);
          
    // }
     function allDatas(){

        $idd =  $this->input->post('id');
        $data =  $this->hospital_model->getAllData($idd);
         echo json_encode($data);
       
    
        
    }

    function getbillingData(){
        
        
        $idd =  $this->input->post('patientid');
        $data =  $this->hospital_model->getAllData($idd);
     
         echo json_encode($data);
       //  var_dump($data);

    }
    function billing_item(){

        $data =  $this->hospital_model->getAllBilling();
         echo json_encode($data);
  
    }
    function fetchoutput(){

        
        $data = $this->hospital_model->getOutputs();
        echo json_encode($data);
        


    }

    function provins(){
    
 $idd = $this->input->post('countryId');
 $query = $this->hospital_model->getProvin($idd);
 echo json_encode($query);
 
     
    }
function municipality(){
$idd = $this->input->post('pid');
$select = $this->hospital_model->getMuni($idd);
echo json_encode($select);


}


function index(){
         //  $this->form_validation->load('form_validation');
         $this->form_validation->set_rules('patientname',"patientname",'required');
         $this->form_validation->set_rules('phoneNumber',"phoneNumber",'required');
         $this->form_validation->set_rules('address',"address",'required');
         $this->form_validation->set_rules('age',"age",'required');
         $this->form_validation->set_rules('language',"language",'required');
         $this->form_validation->set_rules('gender',"gender",'required');
         if($this->form_validation->run() == false){
 
         $this->load->view('hospitalview');
        }
         else{
    
    $patientid = rand(2000,1000);
    $patientname = $this->input->post('patientname');
    $phoneNumber = $this->input->post('phoneNumber');
    $address = $this->input->post('address');
    $age = $this->input->post('age');
    $country = $this->input->post('country');
    $province = $this->input->post('province');
    $municipality = $this->input->post('municipality');
    $language = $this->input->post('language');
    $gender = $this->input->post('gender');
    $date= date('Y-m-d H:i:s');
     
    $alldata = $this->hospital_model->insertData($patientid,$patientname,$phoneNumber,$address, $age, $country, $province, $municipality, $gender, $language,$date);
    $this->load->view('hospitalview',$alldata);
  
    if ($alldata){
        $status='success';
    }else{
        $status='Failed';
    }

 echo json_encode(
    array(
       'status'=> $status
    )
);


}   

         }
          


function addtotal(){
    $percent = $this->input->post('percent');
    $total = $this->input->post('total');
    $amount = $this->input->post('amount');
    $nettotal = $this->input->post('nettotal');
    $alldata = $this->hospital_model->inserttotalData($percent,$total,$amount,$nettotal);
    
        
    if ($alldata){
        $status='success';
    }else{
        $status='Failed';
    }
   
echo json_encode(
        array(
           'status'=>$status
        )
    );




}


function finaloutput(){
    $arra = array(
        
        'patientid' => $this->input->post('patientid'),
        'total' => $this->input->post('total'),
        'dpercent' => $this->input->post('percent'),
        'damount' => $this->input->post('amount'),
        'nettotal' => $this->input->post('nettotal'),
        'date' => $this->input->post('date'),
       
     
    );
    
                   $arre = array(
  
    'patientid' => $this->input->post('patientid'),
    'test_item' => $this->input->post('item'),
 'qty'=> $this->input->post('qty'),
 'price' => $this->input->post('price')
);

$alldata = $this->hospital_model->finalData($arra,$arre);

if ($alldata){
    $status='success';
}else{
    $status='Failed';
}

echo json_encode(
    array(
       'status'=>$status
    )
);


 
}
}
  


?>