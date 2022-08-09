<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Stocks extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //=========================== VIEW STOCKS =================================
    public function view_stocks()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_stock');
            $data['stocks_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->where('is_active', 1);
            $data['products_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_sells');
            $data['sells_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/stocks/view_stocks');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== ADD STOCK =================================
    public function add_stock($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/stocks/add_stock');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD STOCK =================================
    public function add_stock_data($t, $iw = "")

    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('pid', 'pid', 'required|xss_clean|trim');
                $this->form_validation->set_rules('qty', 'qty', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $pid = $this->input->post('pid');
                    $qty = $this->input->post('qty');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $addedby = $this->session->userdata('admin_id');

                    $typ = base64_decode($t);
                    if ($typ == 1) {

                        $data_insert = array(
                            'pid' => base64_decode($pid),
                            'qty' => $qty,
                            'date' => $cur_date

                        );


                        $last_id = $this->base_model->insert_table("tbl_stock", $data_insert, 1);
                        if ($last_id != 0) {

                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Stocks/view_stocks", "refresh");
                        } else {

                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {

                        $idw = base64_decode($iw);

                        $data_insert = array(
                            'customer_id' => $customer_id,
                            'products_id' => $products_id,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_stocks', $data_insert);

                        if ($last_id != 0) {

                            $this->session->set_flashdata('smessage', 'Data updates successfully');

                            redirect("dcadmin/Stocks/view_stock", "refresh");
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
}
