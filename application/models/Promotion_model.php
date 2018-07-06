<?php
class Promotion_model extends CI_Model {

    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'promotions';
    }

    function get()
    {
        $date = date('Y-m-d');
        $this->db->where('promotion_date', $date);
        $this->db->group_by('provider_id');
        $result = $this->db->get($this->table);
        $result = $result->result();
        return $result;
    }

    function get_by_id($number)
    {
        $this->db->where('promotion_number', $number);
        $result = $this->db->get($this->table);
        $result = $result->result();
        return $result;
    }

    function get_by_provider_date($provider)
    {
        $date = date('Y-m-d');
        $this->db->where('provider_id', $provider);
        $this->db->where('promotion_date', $date);
        $result = $this->db->get($this->table);
        $result = $result->result();
        return $result;
    }

    function get_by_provider_month($provider, $month)
    {
        $this->db->where('provider_number', $provider);
        $this->db->like('promotion_date', $month);
        $result = $this->db->get($this->table);
        $result = $result->result();
        return $result;
    }

    function qty_by_number($number)
    {
        $this->db->select('promotion_qty');
        $this->db->where('promotion_number', $number);
        $result = $this->db->get($this->table);
        $result = $result->result();
        $result = $result[0]->promotion_qty;
        return $result;
    }

    function update_qty($number)
    {
        $this->db->set('promotion_qty', 'promotion_qty - 1', FALSE);
        $this->db->where('promotion_number', $number);
        return $this->db->update($this->table);
    }

    function get_like_category($data)
    {
        $date = date('Y-m-d');
        $this->db->from($this->table);
        $this->db->where('promotion_date', $date);
        $this->db->where('provider_id !=', $data['number']);
        $this->db->like('provider_category', $data['category']);
        $this->db->order_by('rand()');
        $this->db->limit(2);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }
}