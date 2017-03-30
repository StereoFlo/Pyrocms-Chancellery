<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_items extends Admin_Controller
{

    protected $section = 'items';

    /**
     * @var string
     */
    private $chancelleryItemUrl = '/admin/chancellery/items';

    /**
     * Admin_items constructor.
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
        $pagination = create_pagination('admin/chancellery/items/index', $this->chancellery_m->get_items_count(), null, 4);
        $contractors = $this->chancellery_m->get_contrators($pagination["per_page"], $pagination["current_page"]);
        $items = $this->chancellery_m->get_items();
        $this->template
            ->title($this->module_details['name'])
            ->set('pagination', $pagination)
            ->set('contractors', $contractors)
            ->set('items', $items)
            ->build('admin/items');
    }

    /**
     * Add action
     */
    public function add()
    {
        $contractors = $this->chancellery_m->get_contrators();
        $this->template
            ->title($this->module_details['name'])
            ->set('contractors', $contractors)
            ->build('admin/item_form');
    }

    /**
     * Edit action
     *
     * @param null $id
     */
    public function edit($id = null)
    {
        $contractors = $this->chancellery_m->get_contrators();
        $item = $this->chancellery_m->get_item($id);
        $this->template
            ->title($this->module_details['name'])
            ->set('contractors', $contractors)
            ->set('item', $item)
            ->build('admin/item_form', $this->data);
    }

    /**
     * Delete action
     *
     * @param null $id
     */
    public function delete($id = null)
    {
        $this->chancellery_m->delete_item($id);
        $this->session->set_flashdata('success', lang('message_deleted_succesfully'));
        redirect($this->chancelleryItemUrl);
        return;
    }

    /**
     * Save action
     */
    public function save()
    {
        if (!empty($_POST) && isset($_POST['id'])) {
            $this->chancellery_m->update_item($_POST);
            $this->session->set_flashdata('success', lang('message_updated_succesfully'));
            redirect($this->chancelleryItemUrl);
            return;
        }
        $this->chancellery_m->add_item($_POST);
        $this->session->set_flashdata('success', lang('message_added_succesfully'));
        redirect($this->chancelleryItemUrl);
        return;
    }
}