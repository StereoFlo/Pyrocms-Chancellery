<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_contractors extends Admin_Controller
{

    protected $section = 'contractors';

    /**
     * @var string
     */
    private $chancelleryUrl = '/admin/chancellery/contractors';

    /**
     * @var string
     */
    private $chancelleryFormTpl = 'admin/contractor_form';

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
            ->build($this->chancelleryFormTpl);
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
            redirect($this->chancelleryUrl);
            return;
        }
        $contractor = $this->chancellery_m->get_contractor($id);
        $this->template
            ->title($this->module_details['name'])
            ->set('contractor', $contractor)
            ->build($this->chancelleryFormTpl);
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
            redirect($this->chancelleryUrl);
            return;
        }
        $this->chancellery_m->delete_contractor($id);
        $this->session->set_flashdata('success', lang('message_deleted_succesfully'));
        redirect($this->chancelleryUrl);
    }

    /**
     * Save action
     */
    public function save()
    {
        if (!empty($_POST) && isset($_POST['id'])) {
            $this->chancellery_m->update_contractor($_POST);
            $this->session->set_flashdata('success', lang('message_updated_succesfully'));
            redirect($this->chancelleryUrl);
            return;
        }
        if (!empty($_POST) && empty($_POST['id'])) {
            $this->chancellery_m->add_contractor($_POST);
            $this->session->set_flashdata('success', lang('message_added_succesfully'));
            redirect($this->chancelleryUrl);
            return;
        }
    }
}