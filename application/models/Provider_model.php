<?php
class Provider_model extends CI_Model {

    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'providers';
        $this->table_category = 'categories';
    }

    function get_categories()
    {
        $this->db->from($this->table_category);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get($limit=99999)
    {
        $this->db->from($this->table);
        $this->db->limit($limit);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('provider_id', $id);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }
}