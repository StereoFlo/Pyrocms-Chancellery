<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller
{
    /**
     * @var string
     */
    public $section = 'setting';

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');
        $this->load->library('form_validation');
        $this->load->model('chancellery_m');
        $this->lang->load('chancellery');
    }

    /**
     * Index action
     */
    public function index()
    {
        $contractors = $this->chancellery_m->get_contrators();
        $chancellery = $this->chancellery_m->get_settings();
        $this->template->title($this->module_details['name'])
            ->set('contractors', $contractors)
            ->set('chancellery', $chancellery)
            ->build('admin/index');

        if (isset($_GET['action']) && $_GET['action'] == 'save') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $this->chancellery_m->update_settings($_POST);
            } else {
                $this->chancellery_m->add_settings($_POST);
            }
            $this->session->set_flashdata('success', lang('message_updated_succesfully'));
            redirect('admin/chancellery');
        }
    }
}