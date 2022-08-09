<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Reminders extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //=========================== VIEW REMINDERS =================================
    public function view_reminders()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_reminders');
            $data['reminders_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/reminders/view_reminders');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD REMINDER =================================
    public function add_reminder()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->view('admin/common/header_view');
            $this->load->view('admin/reminders/add_reminder');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD REMINDER =================================
    public function add_reminder_data($t, $iw = "")

    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('cname', 'cname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('cphone', 'cphone', 'required|xss_clean|trim');
                $this->form_validation->set_rules('remarks', 'remarks', 'required|xss_clean|trim');
                $this->form_validation->set_rules('date', 'date', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $cname = $this->input->post('cname');
                    $cphone = $this->input->post('cphone');
                    $remarks = $this->input->post('remarks');
                    $date = $this->input->post('date');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $addedby = $this->session->userdata('admin_id');

                    $typ = base64_decode($t);
                    if ($typ == 1) {
                        $data_insert = array(
                            'cname' => $cname,
                            'cphone' => $cphone,
                            'remarks' => $remarks,
                            'date' => $date,
                            'ip' => $ip,
                            'added_by' => $addedby,
                            'created' => $cur_date

                        );

                        $last_id = $this->base_model->insert_table("tbl_reminders", $data_insert, 1);
                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Reminders/view_reminders", "refresh");
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
                            'remarks' => $remarks,
                            'date' => $date,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_reminders', $data_insert);

                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data updates successfully');
                            redirect("dcadmin/Reminders/view_reminders", "refresh");
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
    //=========================== VIEW UPDATE REMINDER =================================
    public function update_reminder($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;

            $this->db->select('*');
            $this->db->from('tbl_reminders');
            $data['reminder_data'] = $this->db->get()->row();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/reminders/update_reminder');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== DELETE  REMINDER =================================
    public function delete_reminder($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            if ($this->load->get_var('position') == "Super Admin") {
                $zapak = $this->db->delete('tbl_reminders', array('id' => $id));
                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Reminders/view_reminders", "refresh");
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
