<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_contractors extends Admin_Controller
{

    protected $section = 'contractors';

    /**
     * @var string
     */
    private $chancelleyUrl = '/admin/chancellery/contractors';

    /**
     * Admin_contractors constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
        $this->template
            ->title($this->module_details['name'])
            ->set('contractors', $contractors)
            ->build('admin/contractor');
    }

    /**
     * Add action
     */
    public function add()
    {
        $this->template
            ->title($this->module_details['name'])
            ->build('admin/contractor_form');
    }

    /**
     * Edit action
     *
     * @param null $id
     */
    public function edit($id = null)
    {
        if (is_null($id)) {
            $this->session->set_flashdata('error', lang('empty_id'));
            redirect($this->chancelleyUrl);
        }
        $contractor = $this->chancellery_m->get_contractor($id);
        $this->template
            ->title($this->module_details['name'])
            ->set('contractor', $contractor)
            ->build('admin/contractor_form');
    }

    /**
     * Delete action
     *
     * @param null $id
     */
    public function delete($id = null)
    {
        if (is_null($id)) {
            $this->session->set_flashdata('error', lang('empty_id'));
            redirect($this->chancelleyUrl);
        }
        $this->chancellery_m->delete_contractor($id);
        $this->session->set_flashdata('success', lang('message_deleted_succesfully'));
        redirect($this->chancelleyUrl);
    }

    /**
     * Save action
     */
    public function save()
    {
        if (!empty($_POST) and isset($_POST['id'])) {
            $this->chancellery_m->update_contractor($_POST);
            $this->session->set_flashdata('success', lang('message_updated_succesfully'));
            redirect($this->chancelleyUrl);
        } elseif (isset($_POST) and empty($_POST['id'])) {
            $this->chancellery_m->add_contractor($_POST);
            $this->session->set_flashdata('success', lang('message_added_succesfully'));
            redirect($this->chancelleyUrl);
        }
    }
}