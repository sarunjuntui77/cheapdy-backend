<?php
class User_model extends CI_Model {

    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function update_status_verify($data)
    {
        $this->db->where('user_status', 'register');
        $this->db->where('user_email', $data['user_email']);
        $this->db->where('user_email_verify', $data['user_email_verify']);
        return $this->db->update($this->table, [
            'user_status' => 'verify',
            // 'user_email_verify' => '',
        ]);
    }

    function by_verifyemail($data)
    {
        $this->db->where('user_email', $data['user_email']);
        $this->db->where('user_email_verify', $data['user_email_verify']);
        $this->db->from($this->table);
        $result = $this->db->get();
        $result = $result->result();
        return $result; 
    }

    function count_email($email)
    {
        $this->db->where('user_email', $email);
        $this->db->from($this->table);
        $result = $this->db->count_all_results(); 
        return $result; 
    }

}