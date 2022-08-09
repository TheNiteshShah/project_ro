<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Transactions extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    //=========================== VIEW TRANSACTIONS =================================
    public function view_transactions()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_transactions');
            $data['transactions_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/transactions/view_transactions');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD TRANSACTION =================================
    public function add_transaction()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->view('admin/common/header_view');
            $this->load->view('admin/transactions/add_transaction');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD TRANSACTION DATA =================================
    public function add_transaction_data($t, $iw = "")
    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('type', 'type', 'required|xss_clean|trim');
                $this->form_validation->set_rules('amount', 'amount', 'required|xss_clean|trim');
                $this->form_validation->set_rules('remarks', 'remarks', 'required|xss_clean|trim');
                $this->form_validation->set_rules('date', 'date', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $type = $this->input->post('type');
                    $amount = $this->input->post('amount');
                    $remarks = $this->input->post('remarks');
                    $date = $this->input->post('date');

                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");

                    $typ = base64_decode($t);
                    if ($typ == 1) {
                        $data_insert = array(
                            'type' => $type,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'date' => $date,
                            'created' => $cur_date
                        );
                        $last_id = $this->base_model->insert_table("tbl_transactions", $data_insert, 1);
                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Transactions/view_transactions", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {
                        $idw = base64_decode($iw);
                        $data_insert = array(
                          'type' => $type,
                          'amount' => $amount,
                          'remarks' => $remarks,
                          'date' => $date,
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_transactions', $data_insert);

                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'D
                            ata updates successfully');
                            redirect("dcadmin/Transactions/view_transactions", "refresh");

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

    //=========================== VIEW UPDATE TRANSACTION =================================
    public function update_transaction($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('tbl_transactions');
            $this->db->where('id', $id);
            $data['transaction_data'] = $this->db->get()->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/transactions/update_transaction');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== DELETE TRANSACTION =================================

    public function delete_transaction($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {

            $id = base64_decode($idd);
            if ($this->load->get_var('position') == "Super Admin") {

                $zapak = $this->db->delete('tbl_transactions', array('id' => $id));
                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Transactions/view_transactions", "refresh");
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
