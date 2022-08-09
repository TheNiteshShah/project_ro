<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Open_services extends CI_finecontrol
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    //=========================== VIEW OPEN SERVICES =================================
    public function view_open_services()
    {

        if (!empty($this->session->userdata('admin_data'))) {

            $this->db->select('*');
            $this->db->from('open_service');
            $this->db->order_by('id', 'desc');
            $data['services_data'] = $this->db->get();
            $data['heading'] = "View Open Services";
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/open_services/view_open_services');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== ADD OPEN SERVICES =================================
    public function add_open_service()
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->where('is_active', 1);
            $data['products_data'] = $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/open_services/add_open_services');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }

    //=========================== ADD OPEN SERVICES DATA =================================
    public function add_open_service_data($t, $iw = "")

    {

        if (!empty($this->session->userdata('admin_data'))) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {

                $this->form_validation->set_rules('cus_name', 'cus_name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('cus_mobile', 'cus_mobile', 'required|xss_clean|trim');
                $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');
                $this->form_validation->set_rules('service_date', 'service_date', 'required|xss_clean|trim');
                $this->form_validation->set_rules('remarks', 'remarks', 'required|xss_clean|trim');
                $this->form_validation->set_rules('sprov_name', 'sprov_name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('sprov_mobile', 'sprov_mobile', 'required|xss_clean|trim');
                $this->form_validation->set_rules('count', 'count', 'required|xss_clean|trim');


                if ($this->form_validation->run() == TRUE) {
                    $cus_name = $this->input->post('cus_name');
                    $cus_mobile = $this->input->post('cus_mobile');
                    $address = $this->input->post('address');
                    $service_date = $this->input->post('service_date');
                    $remarks = $this->input->post('remarks');
                    $sprov_name = $this->input->post('sprov_name');
                    $sprov_mobile = $this->input->post('sprov_mobile');
                    $count = $this->input->post('count');

                    $ip = $this->input->ip_address();

                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date = date("Y-m-d");
                    $typ = base64_decode($t);
                    if ($typ == 1) {

                        $data_insert = array(
                            'cus_name' => $cus_name,
                            'cus_mobile' => $cus_mobile,
                            'address' => $address,
                            'service_date' => $service_date,
                            'remarks' => $remarks,
                            'sprov_name' => $sprov_name,
                            'sprov_mobile' => $sprov_mobile,
                            'created' => $cur_date

                        );


                        $last_id = $this->base_model->insert_table("open_service", $data_insert, 1);
                        if ($last_id != 0) {
                            for ($i = 1; $i <= $count; $i++) {
                                $part_id = $this->input->post('part_id_' . $i);
                                if (!empty($part_id)) {
                                    $qty = $this->input->post('part_qty_' . $i);
                                    if (!empty($qty)) {
                                        $data_insert = array(
                                            'service_id' => $last_id,
                                            'products_id' => $part_id,
                                            'qty' => $qty,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_id2 = $this->db->insert("tbl_sells", $data_insert, 1);
                                    }
                                }
                            }
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Open_services/view_open_services", "refresh");
                        } else {

                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ == 2) {

                        $idw = base64_decode($iw);

                        $data_insert = array(
                            'cus_name' => $cus_name,
                            'cus_mobile' => $cus_mobile,
                            'address' => $address,
                            'service_date' => $service_date,
                            'remarks' => $remarks,
                            'sprov_name' => $sprov_name,
                            'sprov_mobile' => $sprov_mobile,

                        );
                        $this->db->where('id', $idw);
                        $last_id = $this->db->update('open_service', $data_insert);

                        if ($last_id != 0) {
                            $delete = $this->db->delete('tbl_sells', array('service_id' => $idw));
                            for ($i = 1; $i <= $count; $i++) {
                                $part_id = $this->input->post('part_id_' . $i);
                                if (!empty($part_id)) {
                                    $qty = $this->input->post('part_qty_' . $i);
                                    if (!empty($qty)) {
                                        $data_insert = array(
                                            'service_id' => $idw,
                                            'products_id' => $part_id,
                                            'qty' => $qty,
                                            'ip' => $ip,
                                            'date' => $cur_date
                                        );
                                        $last_id2 = $this->db->insert("tbl_sells", $data_insert, 1);
                                    }
                                }
                            }
                            $this->session->set_flashdata('smessage', 'Data updates successfully');

                            redirect("dcadmin/Open_services/view_open_services", "refresh");
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
    //=========================== VIEW UPDATE OPEN SERVICE =================================
    public function update_open_service($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $this->db->select('*');
            $this->db->from('open_service');
            $this->db->where('id', $id);
            $data['services_data'] = $this->db->get()->row();

            $this->db->select('*');
            $this->db->from('tbl_products');
            $this->db->where('is_active', 1);
            $data['products_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_sells');
            $this->db->where('service_id', $id);
            $data['sells_data'] = $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_sells');
            $this->db->where('service_id', $id);
            $data['count'] = $this->db->count_all_results();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/open_services/update_open_services');
            $this->load->view('admin/common/footer_view');
        } else {

            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== DELETE OPEN Service =================================

    public function delete_open_service($idd)
    {

        if (!empty($this->session->userdata('admin_data'))) {

            $id = base64_decode($idd);

            if ($this->load->get_var('position') == "Super Admin") {

                $zapak = $this->db->delete('open_service', array('id' => $id));
                if ($zapak != 0) {

                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Open_services/view_open_services", "refresh");
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
                    $this->db->from('open_service');
                    $this->db->where('created >=', $from_date);
                    $this->db->where('created <=', $to_date);
                    $data['services_data'] = $this->db->get();

                    $from_date = new DateTime($from_date);
                    $to_date = new DateTime($to_date);
                    $data['heading'] = 'Showing results from ' . $from_date->format('d/m/Y') . ' To ' . $to_date->format('d/m/Y');

                    $this->load->view('admin/common/header_view', $data);
                    $this->load->view('admin/open_services/view_open_services');
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
