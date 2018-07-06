<?php
use KKiernan\CaesarCipher;
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    05/10/2017
*    @comment     for help text function
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Text {

    protected $ci;
    protected $caesar;
    protected $default_key;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->caesar = new CaesarCipher();
        $this->default_key = 8;
        $this->char_random = '012345678901234567890123456789ABCDEFGHJKMNOPQRSTUVWXYZ';
        $this->random_length = strlen($this->char_random);
    }

    public function encrypt_caesar($text, $key = 8)
    {
        return $this->caesar->encrypt($text, $key);
    }

    public function decrypt_caesar($text, $key = 8)
    {
        return $this->caesar->encrypt($text, $key);
    }

    public function text_in_quotes($str)
    {
        preg_match_all('/".*?"|\'.*?\'/', $str, $matches);
        $parse = json_decode(json_encode(str_replace('"', '', $matches[0]), true));
        return $parse;
    }

    public function random($length)
    {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $this->char_random[rand(0, $this->random_length - 1)];
        }

        return $random;
    }
}