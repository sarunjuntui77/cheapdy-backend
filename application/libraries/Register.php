<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    26/10/2017
*    @comment     for help api register
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Register {
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function process($data)
    {
        $data['password'] = $this->ci->text->decrypt_caesar($data['password'], strlen($data['password']));
        $check_email =  $this->ci->user_model->count_email($data['email']);
        if ($check_email === 0) {
            $data['score'] =  $this->ci->coupon_model->sumscore_email($data['email'])[0]->coupon_score;
            $parse = $this->parse_data_for_insert($data);
            $insert = $this->ci->user_model->insert($parse);
            if ($insert) {
                $insert_id = $this->ci->db->insert_id();
                // $email = $this->ci->mail->send_verify_register($parse);
                $email = true;
                if ($email) {
                    $this->ci->alert->slack_alert_register($parse, $insert_id);
                    $result = ['200', 'SUCCESS'];
                } else {
                    $result = ['500', 'ERROR_EMAIL'];
                }
            } else {
                $result = ['500', 'ERROR_REGISTER'];
            }
        } else {
            $result = ['400', 'HAD_EMAIL'];
        }
        return $result;
    }

    function verify_mail($data)
    {
        $result = [];
        $users = $this->ci->user_model->by_verifyemail([
            'user_email' => $data['email'],
            'user_email_verify' => $data['hash'],
        ]);

        if (isset($users[0])) {
            if ($users[0]->user_status === 'register') {
                $update = $this->ci->user_model->update_status_verify((array)$users[0]);
                if ($update) {
                    $this->ci->alert->slack_alert_verify((array)$users[0]);
                    $result = [200, 'SUCCESS'];
                } else {
                    $result = [500, 'ERROR_UPDATE'];
                }
            } else {
                $result = [200, 'VERIFY'];
            }
        } else {
            $result = [400, 'NOT_FOUND'];
        }
        return $result;
    }

    function parse_data_for_insert($param)
    {
        $date = date('Y-m-d');
        $datetime = date('Y-m-d H:i:s');
        $param['password'] = strrev($param['password']);
        $password = strrev(md5($param['password']).sha1($param['password']));
        $verify = md5($password);
        $new = [
            'user_email' => $param['email'],
            'user_username' => '',
            'user_nickname' => $param['name'],
            'user_name' => '',
            'user_lastname' => '',
            'user_password' => $password,
            'user_sex' => $param['sex'],
            'user_score' => $param['score'],
            'user_class' => 'user',
            'user_status' => 'register',
            'user_sms_verify' => '',
            'user_email_verify' => $verify,
            'user_reg_datetime' => $datetime,
            'user_favorite' => '',
            'create_datetime' => $datetime,
            'update_datetime' => $datetime

        ];
        return $new;
    }
}