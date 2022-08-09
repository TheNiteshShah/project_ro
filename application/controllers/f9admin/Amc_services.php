<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Amc_services extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //=========================== VIEW AMC SERVICES =================================
    public function view_amc_services()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_amc_services');
            $data['amc_services_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/amc_services/view_amc_services');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD AMC SERVICE =================================
    public function add_amc_service()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->view('admin/common/header_view');
            $this->load->view('admin/amc_services/add_amc_service');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD AMC SERVICE =================================
    public function add_amc_service_data($t, $iw = "")

    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('cname', 'cname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('cphone', 'cphone', 'required|xss_clean|trim');
                $this->form_validation->set_rules('scharge', 'scharge', 'required|xss_clean|trim');
                $this->form_validation->set_rules('from_date', 'from_date', 'required|xss_clean|trim');
                $this->form_validation->set_rules('to_date', 'to_date', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $cname = $this->input->post('cname');
                    $cphone = $this->input->post('cphone');
                    $scharge = $this->input->post('scharge');
                    $from_date = $this->input->post('from_date');
                    $to_date = $this->input->post('to_date');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $addedby = $this->session->userdata('admin_id');
                    $typ = base64_decode($t);
                    if ($typ == 1) {
                        $data_insert = array(
                            'cname' => $cname,
                            'cphone' => $cphone,
                            'scharge' => $scharge,
                            'from_date' => $from_date,
                            'to_date' => $to_date,
                            'ip' => $ip,
                            'added_by' => $addedby,
                            'created' => $cur_date

                        );

                        $last_id = $this->base_model->insert_table("tbl_amc_services", $data_insert, 1);
                        if ($last_id != 0) {
                            $ts1 = strtotime($from_date);
                            $ts2 = strtotime($to_date);

                            $year1 = date('Y', $ts1);
                            $year2 = date('Y', $ts2);

                            $month1 = date('m', $ts1);
                            $month2 = date('m', $ts2);

                            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                            // echo $diff;
                            $date = $from_date;
                            for ($i = 1; $i <= $diff; $i++) {
                                $time = strtotime($date);
                                $date = date("Y-m-d", strtotime("+1 month", $time));
                                $data_insert2 = array(
                                    'amc_id' => $last_id,
                                    'date' => $date,
                                    'is_active' => 0,
                                    'created' => $cur_date,
                                );

                                $last_id2 = $this->base_model->insert_table("tbl_amc_details", $data_insert2, 1);
                            }
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Amc_services/view_amc_services", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {
                        $idw = base64_decode($iw);
                        $data_insert = array(
                            'cname' => $cname,
                            'cphone' => $cphone,
                            'scharge' => $scharge,
                            'from_date' => $from_date,
                            'to_date' => $to_date,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_amc_services', $data_insert);

                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data updates successfully');
                            redirect("dcadmin/Amc_services/view_amc_services", "refresh");
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
    //=========================== VIEW AMC DETAILS =================================
    public function view_amc_details($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;

            $this->db->select('*');
            $this->db->from('tbl_amc_details');
            $this->db->where('amc_id', $id);
            $data['details_data'] = $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/amc_services/view_amc_details');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== UPDATE STATUS AMC  =================================
    public function updateAmcStatus($idd, $t)
    {

        if (!empty($this->session->userdata('admin_data'))) {

            $id = base64_decode($idd);

            if ($t == "complete") {

                $data_update = array(
                    'is_active' => 1

                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_amc_details', $data_update);

                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    $this->session->set_flashdata('emessage', 'Some error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== VIEW UPDATE AMC SERVICE =================================
    public function update_amc_service($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;

            $this->db->select('*');
            $this->db->from('tbl_amc_services');
            $data['amc_data'] = $this->db->get()->row();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/amc_services/update_amc_service');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== DELETE AMC SERVICES =================================
    public function delete_amc_service($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            if ($this->load->get_var('position') == "Super Admin") {
                $zapak = $this->db->delete('tbl_amc_services', array('id' => $id));
                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Amc_services/view_amc_services", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Sorry you not a super admin you dont have permission to delete anything');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
}
