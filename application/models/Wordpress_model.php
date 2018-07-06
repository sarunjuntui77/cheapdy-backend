<?php
class Wordpress_model extends CI_Model {

    protected $prefix;
    protected $table_post;
    protected $table_meta;
    protected $table_relate;
    protected $table_tax;
    protected $table_term;


    function __construct()
    {
        parent::__construct();
        $this->prefix = 'si8y_';
        $this->table_post = $this->prefix.'posts';
        $this->table_meta = $this->prefix.'postmeta';
        $this->table_relate = $this->prefix.'term_relationships';
        $this->table_tax = $this->prefix.'term_taxonomy';
        $this->table_term = $this->prefix.'terms';
    }

    function get($limit=50)
    {
        $this->db->from($this->table_post);
        $this->db->where('post_type', 'job_listing');
        $this->db->where('post_status', 'publish');
        $this->db->order_by('ID');
        $this->db->limit($limit);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_by_id($id)
    {
        $this->db->from($this->table_post);
        $this->db->where('ID', $id);
        $this->db->where('post_type', 'job_listing');
        $this->db->where('post_status', 'publish');
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_tax($id)
    {
        $this->db->select("{$this->table_term}.term_id");
        $this->db->select("{$this->table_term}.name");
        $this->db->select("{$this->table_tax}.taxonomy");
        $this->db->from($this->table_post);
        $this->db->join($this->table_relate,
            "{$this->table_relate}.object_id = {$this->table_post}.ID",
            "left");
        $this->db->join($this->table_tax,
            "{$this->table_tax}.term_taxonomy_id = {$this->table_relate}.term_taxonomy_id",
            "left");
        $this->db->join($this->table_term,
            "{$this->table_term}.term_id = {$this->table_tax}.term_id",
            "left");
        $this->db->where("{$this->table_post}.ID", $id);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_categories()
    {
        $this->db->select("name");
        $this->db->from($this->table_tax);
        $this->db->join($this->table_term,
            "{$this->table_term}.term_id = {$this->table_tax}.term_id",
            "left");
        $this->db->where("taxonomy", 'job_listing_category');
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_regions($id)
    {
        $this->db->select("name");
        $this->db->from($this->table_tax);
        $this->db->where("taxonomy", 'job_listing_region');
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_meta($id)
    {
        $this->db->from($this->table_meta);
        $this->db->where('post_id', $id);
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

    function get_images()
    {
        $this->db->from($this->table_post);
        $this->db->where('post_type', 'attachment');
        $this->db->where('post_status', 'inherit');
        $this->db->group_by('post_parent');
        $result = $this->db->get();
        $result = $result->result();
        return  $result;
    }

}