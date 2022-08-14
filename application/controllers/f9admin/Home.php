<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Home extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    function index()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name'] = $this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_admin_sidebar');
            $data['sidebar_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_customers');
            $data['count_costomers'] = $this->db->count_all_results();

            $this->db->select('*');
            $this->db->from('tbl_products');
            $data['count_products'] = $this->db->count_all_results();

            $this->db->select('*');
            $this->db->from('tbl_sells');
            $sells_data = $this->db->get();
            $total_sell = 0;
            if (!empty($sells_data->row())) {
                foreach ($sells_data->result() as $dataa) {
                    $sell = 0;
                    $this->db->select('*');
                    $this->db->from('tbl_products');
                    $this->db->where('id', $dataa->products_id);
                    $pro_data = $this->db->get()->row();
                    $sell = $pro_data->price *  $dataa->qty;
                    $total_sell = $total_sell + $sell;
                }
            }
            $data['count_sells'] = $total_sell;

            $this->db->select('*');
            $this->db->from('open_service');
            $data['count_services'] = $this->db->count_all_results();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/dash');
            $this->load->view('admin/common/footer_view');
        } else {
            $this->load->view('admin/login/index');
        }
    }


//======================= view Report =========================================
public function view_report(){
  if (!empty($this->session->userdata('admin_data'))) {
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if ($this->input->post()) {
      $this->form_validation->set_rules('from_date', 'from_date', 'required|xss_clean|trim');
      $this->form_validation->set_rules('to_date', 'to_date', 'required|xss_clean|trim');


      if ($this->form_validation->run() == TRUE) {

          $from_date = $this->input->post('from_date');
          $to_date = $this->input->post('to_date');

          $this->db->select('*');
          $this->db->from('tbl_sells');
          $this->db->where('date >=', $from_date);
          $this->db->where('date <=', $to_date);
          $sells_data = $this->db->get();

          $this->db->select('*');
          $this->db->from('open_service');
          $this->db->where('created >=', $from_date);
          $this->db->where('created <=', $to_date);
          $services_data = $this->db->get();

          $this->db->select('*');
          $this->db->from('tbl_transactions');
          $this->db->where('date >=', $from_date);
          $this->db->where('date <=', $to_date);
          $transactions_data = $this->db->get();

          $this->db->select('*');
          $this->db->from('tbl_stock');
          $this->db->where('date >=', $from_date);
          $this->db->where('date <=', $to_date);
          $purchasing_data = $this->db->get();

          $from_date = new DateTime($from_date);
          $to_date = new DateTime($to_date);
          $data['heading'] = 'Showing results from ' . $from_date->format('d/m/Y') . ' To ' . $to_date->format('d/m/Y');

          $total_sells=0;
          $total_services=0;
          $total_transIncome=0;
          $total_transExp=0;
          $total_purchasing=0;
          //---- calculating total sells amount --------
          foreach($sells_data->result() as $sells) {
          if(empty($sells->service_id)){
          $sell=0;
          $pro_data = $this->db->get_where('tbl_products', array('id =' => $sells->products_id))->result_array();
          $sell=$sells->qty * $pro_data[0]['mrp'];
          $total_sells = $total_sells + $sell;
          }
         }
         //---- calculating total services amount --------
          foreach($services_data->result() as $services) {
          $sell_data = $this->db->get_where('tbl_sells', array('service_id =' => $services->id))->result();
          foreach($sell_data as $selll) {
          $pro_data2 = $this->db->get_where('tbl_products', array('id =' => $selll->products_id))->result_array();
          $total_services = $total_services + $pro_data2[0]['mrp']*$selll->qty;
          }
         }
         //---- calculating total transaction income and expense amount --------
          foreach($transactions_data->result() as $trans) {
          if($trans->type=='income'){
            $total_transIncome = $total_transIncome + $trans->amount;
          }else{
            $total_transExp = $total_transExp + $trans->amount;
          }
          }
         //---- calculating total purchasing expense amount --------
          foreach($purchasing_data->result() as $puchase) {
          $pro_data3 = $this->db->get_where('tbl_products', array('id =' => $puchase->pid))->result_array();
          $total_purchasing = $total_purchasing + $pro_data3[0]['price']*$puchase->qty;
          }

          $data['total_sells'] = $total_sells;
          $data['total_services'] = $total_services;
          $data['total_transIncome'] = $total_transIncome;
          $data['total_transExp'] = $total_transExp;
          $data['total_purchasing'] = $total_purchasing;
          $this->load->view('admin/common/header_view', $data);
          $this->load->view('admin/view_report');
          $this->load->view('admin/common/footer_view');
      } else {

          $this->session->set_flashdata('emessage', validation_errors());
          redirect($_SERVER['HTTP_REFERER']);
      }
  } else {

      $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
      redirect($_SERVER['HTTP_REFERER']);
  }
} else {

  redirect("login/admin_login", "refresh");
}
}

}
