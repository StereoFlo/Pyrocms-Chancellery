<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_limit extends Admin_Controller {

    protected $section = 'limit';
    
    public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('chancellery_m');
		$this->lang->load('chancellery');
		$this->load->model('users/user_m');
		$this->data = new stdClass();
    }
    public function index ()
    {
	if (isset($_GET['q']))
	{
	    $this->data->users = $this->db->select('users.id, users.username, profiles.display_name')->
				    from('profiles')->
				    join('users', 'profiles.user_id = users.id')->
				    like('username', $_GET['q'])->
				    or_like('profiles.display_name', $_GET['q'])->
				    get()->result();
	}
	else
	{
	    $this->data->users = $this->db->select('id, username')->get('users')->result();
	}
	
		$this->data->limit = $this->chancellery_m->get_limits();
		$this->template->title($this->module_details['name'])->build('admin/limit', $this->data);
    }
    
    public function edit ($id = NULL)
    {
        $this->data->limit = $this->chancellery_m->get_limit_by_user($id);
        $this->data->display_name = $this->db->where('user_id', $id)->get('profiles')->row()->display_name;
		$this->data->active_id = $id;
		$this->template->title($this->module_details['name'])->build('admin/limit_form', $this->data);
    }
    
    public function delete ($id = NULL)
    {
	$this->chancellery_m->delete_limit($id);
	$this->session->set_flashdata('success', lang('message_deleted_succesfully'));
	redirect ('/admin/chancellery/limit');
    }
    
    public function save ()
    {
	if (isset($_POST) and isset($_POST['user']))
	{
	    $check = $this->chancellery_m->check_limit($_POST['user']);
	    if ($check == 0)
	    {
		$this->chancellery_m->add_limit($_POST);
		$this->session->set_flashdata('success', lang('message_added_succesfully'));
	    }
	    else
	    {
		$this->chancellery_m->update_limit($_POST);
		$this->session->set_flashdata('success', lang('message_updated_succesfully'));
	    }
	    redirect ('/admin/chancellery/limit#'.$_POST['user']);
	}
    }
}