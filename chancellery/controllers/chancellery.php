<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chancellery extends Public_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('chancellery_m');
        $this->lang->load('chancellery');
        $this->load->library('form_validation');
        
        if (empty($this->current_user))
        {
        	$this->session->set_userdata('redirect_to', base_url('chancellery'));
            redirect('users/login');
        }
    }

    public function index ()
    {
        $settings = $this->chancellery_m->get_settings();
        $items = $this->chancellery_m->get_items($settings[0]->default_contractor);
		$ordered_items = $this->chancellery_m->get_ordered_items($this->current_user->id, date('m'))->result();
		$this->template
			->title($this->module_details['name'])
			->set('items', $items)
			->set('ordered_items', $ordered_items)
			->build('frontend/ordered');
	}

    public function form ()
    {
    	$settings = $this->chancellery_m->get_settings();
        $code = $this->chancellery_m->get_code_by_user($this->current_user->id);
        $limit = $this->chancellery_m->get_limit_by_user($this->current_user->id);
        if ((!isset($code[0]->code) and $settings[0]->sap_codes == 1) or !isset($limit[0]->limit))
        {
            if (!isset($limit[0]->limit))
            {
                $err_message = lang("page:chancellery:messages:no_limit");
                $this->template
                	->title($this->module_details['name'])
                	->set('err_message', $err_message)
                	->build('frontend/error');
            }
            elseif (!isset($code[0]->code) and $settings[0]->sap_codes == 1)
            {
                $err_message = lang("page:chancellery:messages:no_code");
                $this->template
                	->title($this->module_details['name'])
                	->set('err_message', $err_message)
                	->build('frontend/error');
            }
        }
        else
        {
        	$limit = $limit[0]->limit;
            $settings = $this->chancellery_m->get_settings();
            $items = $this->chancellery_m->get_items($settings[0]->default_contractor);
            $ordered_items = $this->chancellery_m->get_ordered_items($this->current_user->id, date('m'))->result();
            if ($ordered_items) 
            {
            	$this->session->set_flashdata('notice', "Вы редактируете ранее сделанный заказ");
            }
            $this->template
            	->title($this->module_details['name'])
            	->set('limit', $limit)
            	->set('items', $items)
            	->set('ordered_items', $ordered_items)
            	->build('frontend/index');
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
            $this->session->set_flashdata('error', "You limit is $max_sum, but you order is $allprice. Please call to the support service 812-991-03-13");
            redirect(base_url('chancellery/form'));
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
            if ($settings[0]->email)
            {
				$this->sendmail($settings[0]->email);
			}
            
            redirect(base_url('chancellery'));
        }

    }
    
    private function sendmail ($mail)
    {
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
        $this->email->from($mail);
        $this->email->subject(lang('email:subject'));
        $this->email->message('<p>'.lang('email:text').'</p>' . $message);
        $this->email->send();
	}
}