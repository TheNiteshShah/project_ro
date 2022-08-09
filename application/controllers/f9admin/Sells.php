<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Sells extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //=========================== VIEW SELLS =================================
    public function view_sells()
    {

        if (!empty($this->session->userdata('admin_data'))) {

            $this->db->select('*');
            $this->db->from('tbl_sells');
            $data['sells_data'] = $this->db->get();
            $data['heading'] = 'View Sells';
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/sells/view_sells');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== ADD SELL =================================
    public function add_sell()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_customers');
            $this->db->where('is_active', 1);
            $data['customers_data'] = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->where('is_active', 1);
            $data['products_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/sells/add_sells');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD sell =================================
    public function add_sell_data($t, $iw = "")

    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('customer_id', 'customer_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('products_id', 'products_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('qty', 'qty', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $customer_id = $this->input->post('customer_id');
                    $products_id = $this->input->post('products_id');
                    $qty = $this->input->post('qty');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d");
                    $addedby = $this->session->userdata('admin_id');
                    $typ = base64_decode($t);
                    if ($typ == 1) {

                        $this->db->select('*');
                        $this->db->from('tbl_stock');
                        $stocks_data = $this->db->get();

                        $this->db->select('*');
                        $this->db->from('tbl_sells');
                        $sells_data = $this->db->get();

                        $stock = 0;
                        $sell_stock = 0;
                        $total = 0;
                        $available = 0;
                        foreach ($stocks_data->result() as $stocks) {
                            if ($stocks->pid == $products_id) {
                                $stock = $stock + $stocks->qty;
                            }
                        }
                        foreach ($sells_data->result() as $sells) {
                            if ($sells->products_id == $products_id) {
                                $sell_stock = $sell_stock + $sells->qty;
                            }
                        }
                        $available = $stock - $sell_stock;
                        $total = $sell_stock + $available;
                        if ($qty <= $available) {
                            $data_insert = array(
                                'customer_id' => $customer_id,
                                'products_id' => $products_id,
                                'qty' => $qty,
                                'ip' => $ip,
                                'added_by' => $addedby,
                                'date' => $cur_date

                            );


                            $last_id = $this->base_model->insert_table("tbl_sells", $data_insert, 1);
                            if ($last_id != 0) {

                                $this->session->set_flashdata('smessage', 'Data inserted successfully');

                                redirect("dcadmin/Sells/view_sells", "refresh");
                            } else {

                                $this->session->set_flashdata('emessage', 'Sorry error occured');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        } else {
                            $this->session->set_flashdata('emessage', 'Please reduce quantity. Available quantity is ' . $available);
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {

                        $idw = base64_decode($iw);

                        $data_insert = array(
                            'customer_id' => $customer_id,
                            'products_id' => $products_id,
                            'qty' => $qty,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_sells', $data_insert);

                        if ($last_id != 0) {

                            $this->session->set_flashdata('smessage', 'Data updates successfully');

                            redirect("dcadmin/Sells/view_sells", "refresh");
                        } else {

                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
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
    //=========================== VIEW UPDATE SELLS =================================
    public function update_sell($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('tbl_sells');
            $this->db->where('id', $id);
            $data['sell_data'] = $this->db->get()->row();

            $this->db->select('*');
            $this->db->from('tbl_customers');
            $this->db->where('is_active', 1);
            $data['customers_data'] = $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->where('is_active', 1);
            $data['products_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/sells/update_sells');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //======================= SORT DATEWISE ===================
    public function sort_datewise()
    {
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
                    $data['sells_data'] = $this->db->get();
                    $from_date = new DateTime($from_date);
                    $to_date = new DateTime($to_date);
                    $data['heading'] = 'Showing results from ' . $from_date->format('d/m/Y') . ' To ' . $to_date->format('d/m/Y');;

                    $this->load->view('admin/common/header_view', $data);
                    $this->load->view('admin/sells/view_sells');
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
