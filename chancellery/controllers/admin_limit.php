<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_limit extends Admin_Controller
{

    protected $section = 'limit';

    /**
     * Admin_limit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('chancellery_m');
        $this->lang->load('chancellery');
        $this->load->model('users/user_m');
    }

    /**
     * Index action
     */
    public function index()
    {
        if (isset($_GET['q'])) {
            //todo move it to model!!
            $users = $this->db->select('users.id, users.username, profiles.display_name')->
            from('profiles')->
            join('users', 'profiles.user_id = users.id')->
            like('username', $_GET['q'])->
            or_like('profiles.display_name', $_GET['q'])->
            get()->result();
        } else {
            $users = $this->db->select('id, username')->get('users')->result();
        }

        $limit = $this->chancellery_m->get_limits();
        $this->template
            ->title($this->module_details['name'])
            ->set('users', $users)
            ->set('limit', $limit)
            ->build('admin/limit');
    }

    /**
     * @param null $id
     */
    public function edit($id = null)
    {
        $limit = $this->chancellery_m->get_limit_by_user($id);
        $display_name = $this->db->where('user_id', $id)->get('profiles')->row()->display_name;
        $this->template
            ->title($this->module_details['name'])
            ->set('limit', $limit)
            ->set('display_name', $display_name)
            ->set('active_id', $id)
            ->build('admin/limit_form', $this->data);
    }

    /**
     * @param null $id
     */
    public function delete($id = null)
    {
        $this->chancellery_m->delete_limit($id);
        $this->session->set_flashdata('success', lang('message_deleted_succesfully'));
        redirect('/admin/chancellery/limit');
    }

    /**
     * Save action
     */
    public function save()
    {
        if (!empty($_POST) && isset($_POST['user'])) {
            $check = $this->chancellery_m->check_limit($_POST['user']);
            if (!$check) {
                $this->chancellery_m->add_limit($_POST);
                $this->session->set_flashdata('success', lang('message_added_succesfully'));
                redirect('/admin/chancellery/limit#' . $_POST['user']);

                return;
            }
            $this->chancellery_m->update_limit($_POST);
            $this->session->set_flashdata('success', lang('message_updated_succesfully'));
        }
    }
}