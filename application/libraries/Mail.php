<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for mail function
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail {

    protected $email;
    protected $name;
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->email = 'no-reply@cheapdy.com';
        $this->name = 'Cheapdy';
    }

    public function send_verify_register($user)
    {
        try {
            $subject = "Verify register your email";
            $message = $this->ci->load->view('emails-form/verify_register', $user , true);
            $this->ci->email->set_mailtype("html");
            $this->ci->email->from($this->email, $this->name);
            $this->ci->email->to($user['user_email']);
            $this->ci->email->subject($subject);
            $this->ci->email->message($message);
            $email = $this->ci->email->send();
        } catch (Exception $e) {
        }
        
        return true;
    }

    public function send_coupon($coupon, $insert_id)
    {
        try {
            $data['coupon'] = $coupon;
            $data['coupon']['coupon_number'] = $insert_id;
            $subject = "Your Cheapdy's code (RefNo: $insert_id)";
            $message = $this->ci->load->view('emails-form/get_code', $data, true);
            $this->ci->email->set_mailtype("html");
            $this->ci->email->from($this->email, $this->name);
            $this->ci->email->to($coupon['coupon_email']);
            $this->ci->email->subject($subject);
            $this->ci->email->message($message);
            $email = $this->ci->email->send();
        } catch (Exception $e) {
        }
        return $email;
    }

    public function send_cancel($coupon, $insert_id)
    {
        $data['coupon'] = $coupon;
        $data['coupon']['coupon_number'] = $insert_id;
        $subject = "Your Cheapdy's code (RefNo: $insert_id)";
        $message = $this->ci->load->view('emails-form/get_code', $data, true);
        $this->ci->email->set_mailtype("html");
        $this->ci->email->from($this->email, $this->name);
        $this->ci->email->to($coupon['coupon_email']);
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        $email = $this->ci->email->send();
        return $email;
    }
}