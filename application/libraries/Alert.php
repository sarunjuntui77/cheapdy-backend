<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for alert to other api
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Alert {

    public function slack_alert_coupon($coupon, $insert_id)
    {
        $ch = curl_init();
        $email = $coupon['coupon_email'];
        $promotion_title = $coupon['promotion_title'];
        $provider_name = $coupon['provider_name'];
        $code = $coupon['coupon_code'];
        $getby = $coupon['coupon_getby'];
        $message = "$email get $promotion_title of $provider_name coupons code is $code by $getby.TransactionId=$insert_id";
        $payload = json_encode(['text' => $message]);

        curl_setopt($ch, CURLOPT_URL, SLACK_ALERT_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }

    public function slack_alert_register($user, $insert_id)
    {
        $ch = curl_init();
        $email = $user['user_email'];
        $name = $user['user_nickname'];
        $score = $user['user_score'];
        $message = "$name register by $email score is $score.TransactionId=$insert_id";
        $payload = json_encode(['text' => $message]);

        curl_setopt($ch, CURLOPT_URL, SLACK_ALERT_REG_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }

    public function slack_alert_verify($user)
    {
        $ch = curl_init();
        $email = $user['user_email'];
        $name = $user['user_nickname'];
        $score = $user['user_score'];
        $message = "Email $email is verified by $name";
        $payload = json_encode(['text' => $message]);

        curl_setopt($ch, CURLOPT_URL, SLACK_ALERT_REG_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }
}