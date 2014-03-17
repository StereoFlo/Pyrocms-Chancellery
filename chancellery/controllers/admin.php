<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public $section = 'setting';
    
    public function __construct()
    {
	parent::__construct();
	$this->load->library('excel');
	$this->load->library('form_validation');
	$this->load->model('chancellery_m');
	$this->lang->load('chancellery');
    }

    /*
      General page and main settings
    */
    
    public function index()
    {
	$this->data->contractors = $this->chancellery_m->get_contrators();
        $this->data->chancellery = $this->chancellery_m->get_settings();
        $this->template->title($this->module_details['name'])->build('admin/index', $this->data);
	if(isset($_GET['action']) && $_GET['action']=='save')
        {
		if(isset($_POST['id']) && $_POST['id'] != "")
                {
		    $this->chancellery_m->update_settings($_POST);
		}
		else
                {
		    $this->chancellery_m->add_settings($_POST);
		}	
		$this->session->set_flashdata('success', lang('message_updated_succesfully'));	
		redirect('admin/chancellery');
	}
    }
}