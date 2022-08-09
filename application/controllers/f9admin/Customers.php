<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Customers extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    //=========================== VIEW CUSTOMERS =================================
    public function view_customers()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_customers');
            //$this->db->where('id',$usr);
            $data['customers_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/customers/view_customers');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== VIEW ADD CUSTOMERS =================================
    public function add_customer()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->view('admin/common/header_view');
            $this->load->view('admin/customers/add_customers');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD CUSTOMERS =================================
    public function add_customer_data($t, $iw = "")
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
                //$this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
                $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');

                if ($this->form_validation->run() == TRUE) {
                    $name = $this->input->post('name');
                    $phone = $this->input->post('phone');
                    $email = $this->input->post('email');
                    $address = $this->input->post('address');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d H:i:s");
                    $addedby = $this->session->userdata('admin_id');

                    $typ = base64_decode($t);
                    if ($typ == 1) {
                        $data_insert = array(
                            'name' => $name,
                            'phone' => $phone,
                            'email' => $email,
                            'address' => $address,
                            'ip' => $ip,
                            'added_by' => $addedby,
                            'is_active' => 1,
                            'date' => $cur_date
                        );
                        $last_id = $this->base_model->insert_table("tbl_customers", $data_insert, 1);
                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Customers/view_customers", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {
                        $idw = base64_decode($iw);
                        $data_insert = array(
                            'name' => $name,
                            'phone' => $phone,
                            'email' => $email,
                            'address' => $address
                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('tbl_customers', $data_insert);

                        if ($last_id != 0) {
                            $this->session->set_flashdata('smessage', 'Data updates successfully');
                            redirect("dcadmin/Customers/view_customers", "refresh");
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
    //=========================== VIEW UPDATE CUSTOMERS =================================
    public function update_customers($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('tbl_customers');
            $this->db->where('id', $id);
            $data['customer_data'] = $this->db->get()->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/customers/update_customers');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== UPDATE STATUS CUSTOMERS =================================
    public function updateCustomerStatus($idd, $t)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            if ($t == "active") {
                $data_update = array(
                    'is_active' => 1
                );
                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_customers', $data_update);

                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect("dcadmin/Customers/view_customers", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            if ($t == "inactive") {
                $data_update = array(
                    'is_active' => 0
                );

                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_customers', $data_update);

                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect("dcadmin/Customers/view_customers", "refresh");
                } else {
                    $this->session->set_flashdata('emessage', 'Sorry error occured');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== DELETE CUSTOMERS =================================

    public function delete_Customer($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {

            $id = base64_decode($idd);
            if ($this->load->get_var('position') == "Super Admin") {

                $zapak = $this->db->delete('tbl_customers', array('id' => $id));
                if ($zapak != 0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Customers/view_customers", "refresh");
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
