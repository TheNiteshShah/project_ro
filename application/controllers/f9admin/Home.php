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
}
