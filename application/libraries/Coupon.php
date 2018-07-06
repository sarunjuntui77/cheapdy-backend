<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for coupon function
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Coupon {

    protected $code_length;
    protected $ci;
    protected $char;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->code_length = 4;
        $this->email = 'no-reply@Cheapdy.com';
        $this->char = '012345678901234567890123456789ABCDEFGHJKMNOPQRSTUVWXYZ';
    }

    public function get_coupon($param)
    {
        $result = [];
        $email = $param['email'];
        $number = $param['number'];
        $ip = $this->ci->ip->get_client_ip();
        $quota = $this->ci->promotion_model->qty_by_number($number);
        if ($quota > 0) {
            $quota_email = $this->ci->coupon_model->count_email_date($email);
            if ($quota_email < 3) {
                $quota_email_promotion = $this->ci->coupon_model->count_email_promotion($email, $number);
                if ($quota_email_promotion === 0) {
                    $code = $this->generate_code($email);
                    $param['coupon_ip'] = $ip;
                    $param['coupon_code'] = $code['code'];
                    $param['coupon_loop'] = $code['loop'];
                    $result = $this->process($param);
                } else {
                    $result = ['400', 'MAXQUOTA_EMAIL_PROMOTION'];
                }
            } else {
                $result = ['400', 'MAXQUOTA_EMAIL_DATE'];
            }
        } else {
            $result = ['400', 'MAXQUOTA_QTY'];
        }
        
        return $result;
    }

    public function process($data)
    {
        $result = [];
        $data = $this->parse_data_for_insert($data);
        $insert = $this->ci->coupon_model->insert_coupon($data);
        if ($insert) {
            $insert_id = $this->ci->db->insert_id();
            $email = $this->ci->mail->send_coupon($data, $insert_id);
            if ($email) {
                $update = $this->ci->promotion_model->update_qty($data['promotion_number']);
                if ($update) {
                    $this->ci->alert->slack_alert_coupon($data, $insert_id);
                    $result = ['200' , 'SUCECESS'];
                } else {
                    $result = ['500' , 'FAILED_BY_UPDATE'];
                }
            } else {
                $result = ['500' , 'FAILED_BY_EMAIL'];
            }
        } else {
            $result = ['500' , 'FAILED_BY_INSERT'];
        }

        return $result;
    }

    public function generate_code($email)
    {
        $random = '';
        $i = 0;
        for ($i = 0;; $i++) { 
            $random = $this->ci->text->random($this->code_length);
            $check_code = $this->ci->coupon_model->count_code($random, $email);
            if ($check_code === 0) {
                break;
            }
        }
        return [
            'code' => $random,
            'loop' => $i+1
        ];
    }

    public function parse_data_for_insert($param)
    {
        $date = date('Y-m-d');
        $datetime = date('Y-m-d H:i:s');
        $new = [
            'coupon_email' => $param['email'],
            'coupon_name' => $param['name'],
            'coupon_sex' => $param['sex'],
            'coupon_phone' => '',
            'coupon_code' => $param['coupon_code'],
            'coupon_date' => $datetime,
            'coupon_datetime' => $datetime,
            'coupon_ip' => $param['coupon_ip'],
            'coupon_getby' => $this->ci->device->get_device(),
            'coupon_loop_code' => $param['coupon_loop'],
            'coupon_status' => 0,
            'coupon_encrypt' => md5($datetime.$param['coupon_code']),
            'promotion_number' => $param['number'],
            'promotion_title' => $param['title'],
            'promotion_desc' => $param['desc'],
            'provider_id' => $param['id'],
            'provider_name' => $param['providerName'],
            'create_datetime' => $datetime,
            'update_datetime' => $datetime,
        ];
        return $new;
    }

    public function cancel_coupon($encrypt, $number)
    {
        $result = null ;
        $coupon = $this->ci->coupon_model->get_by_encrypt_number($encrypt, $number);

        if (isset($coupon[0])) {
            $update = $this->ci->coupon_model->update_status($coupon[0], -1);
            if ($update === 1) {
                $result = 'SUCCESS';
            } else {
                $result = 'FAILED';
            }
        } else {
            $result = 'FAILED';
        }

        return $result;
    }

}