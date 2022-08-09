<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Services extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    //=========================== VIEW SERVIVES =================================
    public function view_services($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('tbl_services');
            $this->db->where('sell_id', $id);
            $data['services_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/services/view_services');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD SERVICE =================================
    public function add_service($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['id'] = $idd;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/services/add_services');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD sell =================================
    public function add_service_data($t, $iw = "")
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('sell_id', 'sell_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('count', 'count', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $sell_id = $this->input->post('sell_id');
                    $count = $this->input->post('count');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $addedby = $this->session->userdata('admin_id');

                    $typ = base64_decode($t);
                    if ($typ == 1) {
                        $count = $this->input->post('count');
                        for ($i = 1; $i <= $count; $i++) {
                            $service = $this->input->post('service_' . $i);
                            if (!empty($service)) {
                                $service_date = $this->input->post('service_date_' . $i);
                                $data_insert = array(
                                    'name' => $service,
                                    'service_date' => $service_date,
                                    'sell_id' => base64_decode($sell_id),
                                    'ip' => $ip,
                                    'added_by' => $addedby,
                                    'date' => $cur_date
                                );
                                $last_id = $this->db->insert("tbl_services", $data_insert, 1);
                            }
                        }
                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            // redirect("dcadmin/Services/view_services/" . $sell_id, "refresh");
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
}
