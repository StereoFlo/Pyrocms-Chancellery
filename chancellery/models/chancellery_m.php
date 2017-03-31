<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Chancellery_m
 */
class Chancellery_m extends MY_Model
{
    /**
     * @return mixed
     */
    public function get_settings()
    {
        return $this->db->get('chancellery_settings')->result();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function update_settings($input)
    {
        $data = [
            'default_contractor' => $input['default_contractor'],
            'sap_codes'          => $input['sap_codes'],
            'email'              => $input['email'],
        ];

        $this->db->where('id', $input['id']);
        $this->db->update('chancellery_settings', $data);
        return true;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function add_settings($data)
    {
        $this->db->set('default_contractor', $data['default_contractor']);

        $this->db->insert('chancellery_settings');

        return $this->db->insert_id();
    }

    /**
     * @return mixed
     */
    public function get_contrators()
    {
        return $this->db->get('chancellery_contractors')->result();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function get_contractor($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('chancellery_contractors')->result();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function update_contractor($input)
    {
        $data = [
            'name'    => $input['name'],
            'phone'   => $input['phone'],
            'mail'    => $input['mail'],
            'address' => $input['address'],
            'active'  => $input['active'],
            'comment' => $input['comment'],
        ];

        $this->db->where('id', $input['id']);
        $this->db->update('chancellery_contractors', $data);
        return true;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function add_contractor($input)
    {
        $this->db->set('name', $input['name']);
        $this->db->set('phone', $input['phone']);
        $this->db->set('mail', $input['mail']);
        $this->db->set('address', $input['address']);
        $this->db->set('active', $input['active']);
        $this->db->set('comment', $input['comment']);
        $this->db->insert('chancellery_contractors');
        return true;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete_contractor($id)
    {
        $this->db->where('contractor', $id);
        $this->db->delete('chancellery_list');
        $this->db->where('id', $id);
        $this->db->delete('chancellery_contractors');
        return true;
    }

    /**
     * @return mixed
     */
    public function get_items_count()
    {
        return $this->db->get('chancellery_list')->num_rows();
    }

    /**
     * @param null $contractor
     *
     * @return mixed
     */
    public function get_items($contractor = null)
    {
        if (!is_null($contractor)) {
            $this->db->where('contractor', $contractor);
        }

        return $this->db->get('chancellery_list')->result();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function get_item($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('chancellery_list')->result();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function update_item($input)
    {
        $data = [
            'name'       => $input['name'],
            'quote'      => $input['quote'],
            'price'      => $input['price'],
            'ed'         => $input['ed'],
            'contractor' => $input['contractor'],
            'period'     => $input['period'],
            'kod1'       => $input['kod1'],
            'kod2'       => $input['kod2'],
        ];

        $this->db->where('id', $input['id']);
        $this->db->update('chancellery_list', $data);
        return true;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function add_item($input)
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
        return true;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete_item($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('chancellery_list');
        return true;
    }


    function check_item($userid, $item, $month)
    {
        $this->db->where('user', $userid);
        $this->db->where('kanz_id', $item);
        $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);

        return $this->db->get('chancellery_orders')->num_rows();
    }

    /**
     * @param $search
     *
     * @return bool
     */
    public function search_item($search)
    {
        $this->db->where('user', $search);
        return true;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    function insert_order($data)
    {
        $this->db->set('date', 'NOW()', false);
        $this->db->insert('chancellery_orders', $data);

        return $this->db->affected_rows();
    }

    /**
     * @param $kanzid
     * @param $userid
     * @param $month
     * @param $data
     *
     * @return mixed
     */
    function update_ordered_item($kanzid, $userid, $month, $data)
    {
        $this->db->where('user', $userid);
        $this->db->where('kanz_id', $kanzid);
        $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        $this->db->where('active', 1);
        $this->db->update('chancellery_orders', $data);

        return $this->db->affected_rows();
    }

    /**
     * @param null $userid
     * @param null $month
     *
     * @return mixed
     */
    function get_ordered_items($userid = null, $month = null)
    {
        if (!is_null($userid)) {
            $this->db->where('user', $userid);
        }
        if (!is_null($month)) {
            $this->db->where("LPAD(MONTH(date),2,'0')", $month);
        }
        $this->db->where('active', 1);

        return $this->db->get('chancellery_orders');
    }

    /**
     * @param string $start_day
     * @param string $start_month
     * @param string $start_year
     * @param string $end_day
     * @param string $end_month
     * @param string $end_year
     *
     * @return mixed
     */
    function get_ordered_items_period(
        $start_day = '',
        $start_month = '',
        $start_year = '',
        $end_day = '',
        $end_month = '',
        $end_year = ''
    ) {
        if ($start_day != '' and $start_month != '' and $start_year != '' and $end_day != '' and $end_month != '' and $end_year != '') {
            $this->db->where("date BETWEEN '$start_year-$start_month-$start_day' AND '$end_year-$end_month-$end_day'");
        }

        return $this->db->get('chancellery_orders');
    }

    /**
     * @param $kanzid
     *
     * @return mixed
     */
    function get_kanz_by_id($kanzid)
    {
        $this->db->where('id', $kanzid);

        return $this->db->get('chancellery_list')->row();
    }

    /**
     * @param $userid
     * @param $month
     *
     * @return mixed
     */
    function set_to_no_active($userid, $month)
    {
        if ($userid != '') {
            $this->db->where('user', $userid);
        }
        if ($month != '') {
            $this->db->where("LPAD(MONTH(orders_office_list.date),2,'0')", $month);
        }
        $this->db->set('active', 0);
        $this->db->update('chancellery_orders');

        return $this->db->affected_rows();
    }

    /**
     * @return mixed
     */
    function get_codes()
    {
        return $this->db->get('chancellery_codes')->result();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function get_code_by_user($id)
    {
        $this->db->where('user', $id);

        return $this->db->get('chancellery_codes')->result();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    function update_code($input)
    {
        $this->db->set('code', $input['code']);
        $this->db->where('user', $input['user']);
        $this->db->update('chancellery_codes');
        return true;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete_code($id)
    {
        $this->db->where('user', $id);
        $this->db->delete('chancellery_codes');
        return true;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function add_code($input)
    {
        $this->db->set('code', $input['code']);
        $this->db->set('user', $input['user']);
        $this->db->insert('chancellery_codes');
        return true;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function check_code($id)
    {
        $this->db->where('user', $id);

        return $this->db->get('chancellery_codes')->num_rows();
    }

    /**
     * @return mixed
     */
    function get_limits()
    {
        return $this->db->get('chancellery_limit')->result();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function get_limit_by_user($id)
    {
        $this->db->where('user', $id);

        return $this->db->get('chancellery_limit')->result();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    function update_limit($input)
    {
        $this->db->set('limit', $input['limit']);
        $this->db->where('user', $input['user']);
        $this->db->update('chancellery_limit');
        return true;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete_limit($id)
    {
        $this->db->where('user', $id);
        $this->db->delete('chancellery_limit');
        return true;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function add_limit($input)
    {
        $this->db->set('limit', $input['limit']);
        $this->db->set('user', $input['user']);
        $this->db->insert('chancellery_limit');
        return true;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function check_limit($id)
    {
        $this->db->where('user', $id);

        return $this->db->get('chancellery_limit')->num_rows();
    }
}