<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Products extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
}

//=========================== VIEW PRODUCTS =================================
public function view_products(){

if(!empty($this->session->userdata('admin_data'))){

$this->db->select('*');
$this->db->from('tbl_products');
//$this->db->where('id',$usr);
$data['products_data']= $this->db->get();
$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/products/view_products');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//=========================== VIEW ADD PRODUCTS =================================
public function add_product(){

if(!empty($this->session->userdata('admin_data'))){

$this->load->view('admin/common/header_view');
$this->load->view('admin/products/add_products');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

//=========================== ADD PRODUCTS =================================
public function add_product_data($t,$iw="")

{

if(!empty($this->session->userdata('admin_data'))){


$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{

$this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
$this->form_validation->set_rules('mrp', 'mrp', 'required|xss_clean|trim');
$this->form_validation->set_rules('price', 'price', 'required|xss_clean|trim');
$this->form_validation->set_rules('description', 'description', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{
$name=$this->input->post('name');
$mrp=$this->input->post('mrp');
$price=$this->input->post('price');
$description=$this->input->post('description');

$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$addedby=$this->session->userdata('admin_id');

$typ=base64_decode($t);
if($typ==1){

$data_insert = array('name'=>$name,
'mrp'=>$mrp,
'price'=>$price,
'description'=>$description,
'ip' =>$ip,
'added_by' =>$addedby,
'is_active' =>1,
'date'=>$cur_date

);


$last_id=$this->base_model->insert_table("tbl_products",$data_insert,1) ;
if($last_id!=0){

$this->session->set_flashdata('smessage','Data inserted successfully');

redirect("dcadmin/Products/view_products","refresh");

}

else

{

$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);


}

}
if($typ==2){

$idw=base64_decode($iw);

$data_insert = array('name'=>$name,
'mrp'=>$mrp,
'price'=>$price,
'description'=>$description
);
$this->db->where('id', $idw);
$last_id=$this->db->update('tbl_products', $data_insert);

if($last_id!=0){

$this->session->set_flashdata('smessage','Data updates successfully');

redirect("dcadmin/Products/view_products","refresh");

}

else

{

$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);


}

}





}
else{

$this->session->set_flashdata('emessage',validation_errors());
redirect($_SERVER['HTTP_REFERER']);

}

}
else{

$this->session->set_flashdata('emessage','Please insert some data, No data available');
redirect($_SERVER['HTTP_REFERER']);

}
}
else{

redirect("login/admin_login","refresh");


}

}
//=========================== VIEW UPDATE PRODUCTS =================================
public function update_product($idd){

if(!empty($this->session->userdata('admin_data'))){
$id=base64_decode($idd);
$data['id']=$idd;
$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$id);
$data['product_data']= $this->db->get()->row();
$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/products/update_products');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
//=========================== UPDATE STATUS PRODUCTS =================================
public function updateProductStatus($idd,$t){

if(!empty($this->session->userdata('admin_data'))){

$id=base64_decode($idd);

if($t=="active"){

$data_update = array(
'is_active'=>1

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_products', $data_update);

if($zapak!=0){
$this->session->set_flashdata('smessage','Status updated successfully');
redirect("dcadmin/Products/view_products","refresh");
     }
     else
     {
$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);
     }
}
if($t=="inactive"){
$data_update = array(
'is_active'=>0

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_products', $data_update);

if($zapak!=0){
 $this->session->set_flashdata('smessage','Status updated successfully');
 redirect("dcadmin/Products/view_products","refresh");

      }
      else
      {

$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);
      }
}



}
else{

redirect("login/admin_login","refresh");

}

}

//=========================== DELETE PRODUCTS =================================

public function delete_product($idd){

if(!empty($this->session->userdata('admin_data'))){

$id=base64_decode($idd);

if($this->load->get_var('position')=="Super Admin"){

$zapak=$this->db->delete('tbl_products', array('id' => $id));
if($zapak!=0){

$this->session->set_flashdata('smessage','Data deleted successfully');
redirect("dcadmin/Products/view_products","refresh");
}
else
{
$this->session->set_flashdata('emessage','Sorry error occured');
redirect($_SERVER['HTTP_REFERER']);
}
}
else{
$this->session->set_flashdata('emessage','Sorry you not a super admin you dont have permission to delete anything');
redirect($_SERVER['HTTP_REFERER']);
}


}
else{

redirect("login/admin_login","refresh");

}

}





}
