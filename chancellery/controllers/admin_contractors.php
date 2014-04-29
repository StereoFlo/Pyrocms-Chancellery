<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_contractors extends Admin_Controller {

    protected $section = 'contractors';
    
    public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('chancellery_m');
		$this->lang->load('chancellery');
		$this->data = new stdClass();
    }
    
    public function index ()
    {	
	$this->data->contractors = $this->chancellery_m->get_contrators();
	$this->template->title($this->module_details['name'])->build('admin/contractor', $this->data);
    }
    
    public function add ()
    {
	$this->template->title($this->module_details['name'])->build('admin/contractor_form', $this->data);
    }
    
    public function edit ($id = NULL)
    {
	$this->data->contractor = $this->chancellery_m->get_contractor($id);
	$this->template->title($this->module_details['name'])->build('admin/contractor_form', $this->data);
    }
    
    public function delete ($id = NULL)
    {
	$this->chancellery_m->delete_contractor($id);
	$this->session->set_flashdata('success', lang('message_deleted_succesfully'));
	redirect ('/admin/chancellery/contractors');
    }
    
    public function save ()
    {
	if (isset($_POST) and isset($_POST['id']))
	{
	    $this->chancellery_m->update_contractor($_POST);
	    $this->session->set_flashdata('success', lang('message_updated_succesfully'));
	    redirect ('/admin/chancellery/contractors');
	}
	elseif (isset($_POST) and empty($_POST['id']))
	{
	    $this->chancellery_m->add_contractor($_POST);
	    $this->session->set_flashdata('success', lang('message_added_succesfully'));
	    redirect ('/admin/chancellery/contractors');
	}
    }
}