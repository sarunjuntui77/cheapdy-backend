<?php
class Coupon_model extends CI_Model {

    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'coupons';
    }

    function get($limit)
    {
        $this->db->from($this->table);
        $this->db->order_by('coupon_number', 'DESC');
        $this->db->limit($limit);
        $result = $this->db->get();
        $result = $result->result();
        return $result; 
    }

    function insert_coupon($coupon)
    {
        return $this->db->insert($this->table,$coupon); 
    }

    function count_ip_date($ip)
    {
        $date = date('Y-m-d');
        $this->db->where('coupon_ip', $ip);
        $this->db->where('coupon_date', $date);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    function count_ip_date_number($ip, $number)
    {
        $date = date('Y-m-d');
        $this->db->where('coupon_ip', $ip);
        $this->db->where('coupon_date', $date);
        $this->db->where('promotion_number', $number);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    function count_email_promotion($email, $number)
    {
        $date = date('Y-m-d');
        $this->db->where('coupon_date', $date);
        $this->db->where('coupon_email', $email);
        $this->db->where('promotion_number', $email);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    function count_code($code, $email)
    {
        $date = date('Y-m-d');
        $this->db->where('coupon_code', $code);
        $this->db->where('coupon_date', $date);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    function count_email_date($email)
    {
        $date = date('Y-m-d');
        $this->db->where('coupon_date', $date);
        $this->db->where('coupon_email', $email);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    function get_by_encrypt_number($encrypt, $number)
    {
        $this->db->from($this->table);
        $this->db->where('coupon_encrypt', $encrypt);
        $this->db->where('coupon_number', $number);
        $result = $this->db->get();
        $result = $result->result();
        return $result; 
    }

    function update_status($coupon, $status)
    {
        $this->db->where('coupon_number', $coupon->coupon_number);
        $set = [
            'coupon_status' => $status
        ];
        $result = $this->db->update($this->table, $set);
        return $result; 
    }

    function sumscore_email($email)
    {
        $this->db->select_sum('coupon_score');
        $this->db->where('coupon_email', $email);
        $this->db->group_by('coupon_email', $email);
        $this->db->from($this->table);
        $result = $this->db->get();
        $result = $result->result();
        return $result; 
    }

}