<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->db=$this->load->database('default',true); // no need for now
    }

    function getAllBilling(){
        $data = $this->db->select('*')
          ->from('billing_item')
          ->get()
          ->result();
          return $data;

    }  
  
    function getOutputs(){
        $data = $this->db->select('*')
          ->from('datas')
          ->get()
          ->result();
          return $data;

    }    

                  
function getDatas(){
$data = $this->db->select('*')
          ->from('country')
          ->get()
          ->result();
          return $data;


    }
    function getProvin($country_id){
        
              $this->db->where("country_id",$country_id);
                $data =$this->db->get("province");
             
               return $data->result_array();
                           
                  
                   }

                   function getMuni($province_id){
        
                    $this->db->where("province_id",$province_id);
                      $data =$this->db->get("municipality");
                   
                     return $data->result_array();
                                 
                        
                         }
                         function getAllData($patientid){
                            $this->db->select( ' billing_item.samp_no,test_item,qty,price,total,dpercent,id,damount,dpercent,nettotal');
                            $this->db->DISTINCT();
                            $this->db->join('test_item', 'billing_item.samp_no=test_item.samp_no');
                      
                            $data = $this->db->get_where('billing_item',array('billing_item.patientid'=>$patientid));
                            return $data->result_array();
                        
                          
                    
                        }
                      
                        // function  getAllBillingData($id){
                        //     $this->db->select( ' billing_item.patientid,test_item,qty,price,total,dpercent,damount,dpercent,nettotal');
                        //     $this->db->distinct();
                        //     $this->db->join('test_item', 'billing_item.patientid=test_item.patientid');
                      
                        //     $data = $this->db->get_where('billing_item',array('billing_item.patientid'=>$id));
                        //     return $data->result_array();
                        
                        // }

    

  



    function insertData($patientid,$patientname,$phoneNumber,$address, $age, $country, $province, $municipality, $gender, $language,$date){
  
      $alldata =$this->db->set('patientid',$patientid)
                        ->set('patientname',$patientname)
                      ->set('phoneNumber',$phoneNumber)
                      ->set('address',$address)
                       ->set('age',$age)
                      ->set('country',$country)
                      ->set('province',$province)
                      ->set('municipality',$municipality)
                      ->set('gender',$gender)
                    ->set('language',$language)
                    ->set('date',$date)
                      -> insert('datas');



          if($alldata){

        return true;
        }
        else
        {
           return false;
        }
    
        
      
    }
    

 function finalData($arra,$arre){
   
    $alldata = $this->db->insert('billing_item',$arra); 
   
    $last_id = $this->db->insert_id();
     $arre['samp_no'] = $last_id;
     $alldata = $this->db->insert('test_item',$arre);
                 


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



      function inserttotalData($percent,$total,$amount,$nettotal){
        $alldata = $this->db->set('dpercent',$percent)
        ->set('test_item',$total)
         ->set('damount',$amount)
         ->set('nettotal',$nettotal)
         ->insert('billing_item');



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