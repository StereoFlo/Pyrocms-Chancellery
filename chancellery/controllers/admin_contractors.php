<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_contractors extends Admin_Controller {

    protected $section = 'contractors';
    
    public function __construct()
    {
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->model('chancellery_m');
	$this->lang->load('chancellery');
    }
    
    public function index ()
    {	
		$contractors = $this->chancellery_m->get_contrators();
		$this->template
			->title($this->module_details['name'])
			->set('contractors', $contractors)
			->build('admin/contractor');
    }
    
    public function add ()
    {
		$this->template
			->title($this->module_details['name'])
			->build('admin/contractor_form');
    }
    
    public function edit ($id = NULL)
    {
    	if (is_null($id))
    	{
    		$this->session->set_flashdata('error', lang('empty_id'));
			redirect ('/admin/chancellery/contractors');
		}
		$contractor = $this->chancellery_m->get_contractor($id);
		$this->template
			->title($this->module_details['name'])
			->set('contractor', $contractor)
			->build('admin/contractor_form');
    }
    
    public function delete ($id = NULL)
    {
    	if (is_null($id))
    	{
    		$this->session->set_flashdata('error', lang('empty_id'));
			redirect ('/admin/chancellery/contractors');
		}
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