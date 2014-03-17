<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chancellery_m extends MY_Model
{

    public function get_settings ()
    {
        return $this->db->get('chancellery_settings')->result();
    }
    
    public function update_settings($input)
    {
	$data = array(
	'default_contractor' => $input['default_contractor']
        );

	$this->db->where('id', $input['id']);
	$this->db->update('chancellery_settings', $data);
    }
    
    public function add_settings($data)
    {
	$this->db->set('default_contractor', $data['default_contractor']);

	$this->db->insert('chancellery_settings');
	return $this->db->insert_id();
    }

    
    public function get_contrators ()
    {
        return $this->db->get('chancellery_contractors')->result();
    }
    
    public function get_contractor ($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('chancellery_contractors')->result();
    }
    
    public function update_contractor ($input)
    {
	$data = array(
            'name' => $input['name'],
            'phone' => $input['phone'],
            'mail' => $input['mail'],
            'address' => $input['address'],
            'active' => $input['active'],
            'comment' => $input['comment']
            );

	$this->db->where('id', $input['id']);
	$this->db->update('chancellery_contractors', $data);
    }
    
    public function add_contractor ($input)
    {
	$this->db->set('name', $input['name']);
        $this->db->set('phone', $input['phone']);
        $this->db->set('mail', $input['mail']);
        $this->db->set('address', $input['address']);
        $this->db->set('active', $input['active']);
        $this->db->set('comment', $input['comment']);
	$this->db->insert('chancellery_contractors');
    }
    
    public function delete_contractor ($id)
    {
	$this->db->where('contractor', $id);
	$this->db->delete('chancellery_list');
	$this->db->where('id', $id);
	$this->db->delete('chancellery_contractors');
    }

    public function get_items_count ()
    {
	return $this->db->get('chancellery_list')->num_rows();
    }

    public function get_items ($contractor = NULL)
    { 
	if ($contractor != NULL) { $this->db->where('contractor', $contractor); }
	return $this->db->get('chancellery_list')->result();
    }
    
    public function get_item ($id)
    {
	$this->db->where('id', $id);
	return $this->db->get('chancellery_list')->result();
    }
    public function update_item ($input)
    {
	$data = array(
            'name' => $input['name'],
            'quote' => $input['quote'],
            'price' => $input['price'],
            'ed' => $input['ed'],
            'contractor' => $input['contractor'],
	    'period' => $input['period'],
	    'kod1' => $input['kod1'],
            'kod2' => $input['kod2']
            );

	$this->db->where('id', $input['id']);
	$this->db->update('chancellery_list', $data);
    }
    
    public function add_item ($input)
    {
	$this->db->set('name', $input['name']);
        $this->db->set('quote', $input['quote']);
        $this->db->set('price', $input['price']);
        $this->db->set('ed', $input['ed']);
        $this->db->set('contractor', $input['contractor']);
        $this->db->set('period', $input['period']);
	$this->db->set('kod1', $input['kod1']);
	$this->db->set('kod2', $input['kod2']);
	$this->db->insert('chancellery_list');
    }
    
    public function delete_item ($id)
    {
	$this->db->where('id', $id);
	$this->db->delete('chancellery_list');
    }    

    
    function check_item ($userid, $item, $month)
    {
        $this->db->where('user', $userid);
        $this->db->where('kanz_id', $item);
        $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);
        return $this->db->get('chancellery_orders')->num_rows();
    }
    
    public function search_item ($search)
    {
	$this->db->where('user', $userid);
    }
    
    
    function insert_order ($data)
    {
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('chancellery_orders', $data);
        return $this->db->affected_rows();
    }
    function update_ordered_item ($kanzid, $userid, $month, $data)
    {
        $this->db->where('user', $userid);
        $this->db->where('kanz_id', $kanzid);
        $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);
        $this->db->update('chancellery_orders', $data);
        return $this->db->affected_rows();
    }
    function get_ordered_items ($userid = '', $month = '')
    {
        if ($userid != '') $this->db->where('user', $userid);
        if ($month != '') $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);
        return $this->db->get('chancellery_orders')->result();
    }
    function get_ordered_items_period ($start_month = '', $start_year = '', $end_month = '', $end_year = '')
    {
        if ($start_month != '' and $start_year != '' and $end_month != '' and $end_year != '') $this->db->where("((date > (LPAD(MONTH(date),2,'0') = $start_month AND LPAD(YEAR(date),4,'0') = $start_year)) AND ((LPAD(MONTH(date),2,'0') = $end_month AND LPAD(YEAR(date),4,'0') = $end_year)) < date)");
        return $this->db->get('chancellery_orders')->result();
    }
    function get_ordered_items_count ($month = null)
    {
        if ($month != null) $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);
        return $this->db->get('chancellery_orders')->num_rows();
    }
    function get_kanz_by_id ($kanzid)
    {
        $this->db->where('id', $kanzid);
        return $this->db->get('chancellery_list')->row();
    }
    function set_to_no_active ($userid, $month)
    {
        if ($userid != '') $this->db->where('user', $userid);
        if ($month != '') $this->db->where("LPAD(MONTH(orders_office_list.date),2,'0')", $month);
        $this->db->set('active', 0);
        return $this->db->update('chancellery_orders');
        return $this->db->affected_rows();
    }
    
    
    function get_codes ()
    {
	return $this->db->get('chancellery_codes')->result();
    }
    function get_code_by_user ($id)
    {
	$this->db->where('user', $id);
	return $this->db->get('chancellery_codes')->result();
    }
    function update_code ($input)
    {
	$this->db->set('code', $input['code']);
	$this->db->where('user', $input['id']);
	return $this->db->update('chancellery_codes');
    }
    public function delete_code ($id)
    {
	$this->db->where('user', $id);
	$this->db->delete('chancellery_codes');
    }
    public function add_code ($input)
    {
	$this->db->set('code', $input['code']);
        $this->db->set('user', $input['user']);
	$this->db->insert('chancellery_codes');
    }
    public function check_code ($id)
    {
	$this->db->where('user', $id);
	return $this->db->get('chancellery_codes')->num_rows();
    }
    
    
    function get_limits ()
    {
	return $this->db->get('chancellery_limit')->result();
    }
    function get_limit_by_user ($id)
    {
	$this->db->where('user', $id);
	return $this->db->get('chancellery_limit')->result();
    }
    function update_limit ($input)
    {
	$this->db->set('limit', $input['limit']);
	$this->db->where('user', $input['user']);
	return $this->db->update('chancellery_limit');
    }
    public function delete_limit ($id)
    {
	$this->db->where('user', $id);
	$this->db->delete('chancellery_limit');
    }
    public function add_limit ($input)
    {
	$this->db->set('limit', $input['limit']);
        $this->db->set('user', $input['user']);
	$this->db->insert('chancellery_limit');
    }
    public function check_limit ($id)
    {
	$this->db->where('user', $id);
	return $this->db->get('chancellery_limit')->num_rows();
    }
}