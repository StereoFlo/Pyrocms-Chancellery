<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chancellery extends Public_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('chancellery_m');
        $this->lang->load('chancellery');
        $this->load->library('form_validation');
        
        $this->data = new stdClass();
        
        if (empty($this->current_user))
        {
        	$this->session->set_userdata('redirect_to', base_url('chancellery'));
            redirect('users/login');
        }
    }

    public function index ()
    {
        $settings = $this->chancellery_m->get_settings();
        if (empty($settings))
        {
        	$this->session->set_flashdata('error', "The module not configured");
			redirect('/');
		}
        $this->data->items = $this->chancellery_m->get_items($settings[0]->default_contractor);
		$this->data->ordered_items = $this->chancellery_m->get_ordered_items($this->current_user->id, date('m'))->result();
		$this->template->title($this->module_details['name'])->build('frontend/ordered', $this->data);
	}

    public function form ()
    {
        $code = $this->chancellery_m->get_code_by_user($this->current_user->id);
        $limit = $this->chancellery_m->get_limit_by_user($this->current_user->id);
        if (!isset($code[0]->code) or !isset($limit[0]->limit))
        {
            if (!isset($limit[0]->limit))
            {
                $this->data->err_message = lang("page:chancellery:messages:no_limit");
                $this->template->title($this->module_details['name'])->build('frontend/error', $this->data);
            }
            elseif (!isset($code[0]->code))
            {
                $this->data->err_message = lang("page:chancellery:messages:no_code");
                $this->template->title($this->module_details['name'])->build('frontend/error', $this->data);
            }
        }
        else
        {
        	$this->data->limit = $limit[0]->limit;
            $settings = $this->chancellery_m->get_settings();
            $this->data->items = $this->chancellery_m->get_items($settings[0]->default_contractor);
            $this->data->ordered_items = $this->chancellery_m->get_ordered_items($this->current_user->id, date('m'))->result();
            if ($this->data->ordered_items) $this->session->set_flashdata('notice', "Вы редактируете ранее сделанный заказ");
            $this->template->title($this->module_details['name'])->build('frontend/index', $this->data);
        }
    }
    public function order ()
    {
        $settings = $this->chancellery_m->get_settings();
        $limit = $this->chancellery_m->get_limit_by_user($this->current_user->id);
        $data = array();
        $allprice = 0;
        $max_sum = $limit[0]->limit;
        foreach ($_POST as $kanz_id => $kolvo)
        {
            $item = $this->chancellery_m->get_item($kanz_id);
            $allprice = $allprice + $kolvo * $item[0]->price;
        }
        
        if ($allprice > $max_sum)
        {
            $this->session->set_flashdata('error', "You limit is $max_sum, but you order is $allprice. Please call to the support service");
            redirect(base_url('chancellery'));
        }
        else
        {
            foreach ($_POST as $kanz_id => $kolvo1)
            {
                $check_item = $this->chancellery_m->check_item($this->current_user->id, $kanz_id, date('m'));
                if ($check_item == 0)
                {
                    $data = array(
                            'kanz_id' => $kanz_id,
                            'user' => $this->current_user->id,
                            'contractor' => $settings[0]->default_contractor,
                            'active' => 1
                                  );
                    $data['kolvo'] = (int)$kolvo1;
                    $this->chancellery_m->insert_order($data);
                }
                else
                {
                    $data['kolvo'] = $kolvo1;
                    $this->chancellery_m->update_ordered_item($kanz_id, $this->current_user->id, date('m'), $data);
                }
            }
           
            $this->session->set_flashdata('success', lang('message_saved_succesfully'));
            $this->sendmail();
            redirect(base_url('chancellery'));
        }

    }
    
    private function sendmail ()
    {
        $settings = $this->chancellery_m->get_settings();
        $items = $this->chancellery_m->get_items($settings[0]->default_contractor);
		$ordered_items = $this->chancellery_m->get_ordered_items($this->current_user->id, date('m'))->result();
		$message = "<table>";
		foreach ($items as $item) {
					foreach ($ordered_items as $ordered_item) {
						if ($item->id == $ordered_item->kanz_id) {
							if ($ordered_item->kolvo != 0) {
									$message .= "<tr>";
									$message .= "<td>" . $item->name . "</td>";
									$message .= "<td>" . $ordered_item->kolvo . "</td>";
									$message .= "<td>" . $item->ed . "</td>";
									$message .= "<td>" . $item->quote . "</td>";
									$message .= "<td>" . $item->price . "</td>";
									$message .= "</tr>";
							} else {
									$message .= "<tr>";
									$message .= "<td>" . $item->name . "</td>";
									$message .= "<td><b>Не заказано</b></td>";
									$message .= "<td>" . $item->ed . "</td>";
									$message .= "<td>" . $item->quote . "</td>";
									$message .= "<td>" . $item->price . "</td>";
									$message .= "</tr>";			
							}
						}
					}
		}
		$message .= "</table>";
        $this->email->set_mailtype("html");
        $this->email->to($this->current_user->email);
        $this->email->from('sz.support.list@megafon-retail.ru');
        $this->email->subject(lang('email:subject'));
        $this->email->message('<p>Вы успешно сделали заказ. Если у вас есть вопросы, вы можете обратиться к менеджеру.</p>' . $message);
        $this->email->send();
	}
}