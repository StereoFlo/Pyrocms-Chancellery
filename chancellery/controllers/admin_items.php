<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_items extends Admin_Controller {

    protected $section = 'items';
    
    public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('chancellery_m');
		$this->lang->load('chancellery');
    }
    
    public function index ($action = NULL, $id = NULL)
    {
		$pagination = create_pagination('admin/chancellery/items/index', $this->chancellery_m->get_items_count(), NULL, 4);
		$contractors = $this->chancellery_m->get_contrators($pagination["per_page"], $pagination["current_page"]);
		$items = $this->chancellery_m->get_items();
	    $this->template
	    	->title($this->module_details['name'])
	    	->set('pagination', $pagination)
	    	->set('contractors', $contractors)
	    	->set('items', $items)
	    	->build('admin/items');	
    }
    
    public function add ()
    {
        $contractors = $this->chancellery_m->get_contrators();
        $this->template
        	->title($this->module_details['name'])
        	->set('contractors', $contractors)
        	->build('admin/item_form');
    }
    
    public function edit ($id = NULL)
    {
        $contractors = $this->chancellery_m->get_contrators();
		$item = $this->chancellery_m->get_item($id);
		$this->template
			->title($this->module_details['name'])
			->set('contractors', $contractors)
			->set('item', $item)
			->build('admin/item_form', $this->data);
    }
    
    public function delete ($id = NULL)
    {
		$this->chancellery_m->delete_item($id);
		$this->session->set_flashdata('success', lang('message_deleted_succesfully'));
		redirect ('/admin/chancellery/items');
    }
    
    public function save ()
    {
		if (isset($_POST) and isset($_POST['id']))
		{
		    $this->chancellery_m->update_item($_POST);
		    $this->session->set_flashdata('success', lang('message_updated_succesfully'));
		    redirect ('/admin/chancellery/items');
		}
		elseif (isset($_POST) and empty($_POST['id']))
		{
		    $this->chancellery_m->add_item($_POST);
		    $this->session->set_flashdata('success', lang('message_added_succesfully'));
		    redirect ('/admin/chancellery/items');
		}
    }
}