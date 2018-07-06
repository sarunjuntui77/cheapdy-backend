<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Api_test';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/provider'] = "Api_content/get_wordpress_listting";
$route['api/provider/(:any)'] = "Api_provider/get_provider_content/$1";
$route['api/category'] = "Api_provider/get_categories";

$route['api/promotion'] = "Api_promotion/get_daily";
$route['api/promotion/relate'] = "Api_promotion/get_relate_category";
$route['api/promotion/(:any)'] = "Api_promotion/get_by_provider/$1";

$route['api/coupon/register'] = "Api_coupon/register_code";
$route['api/coupon/ip'] = "Api_coupon/check_quota_ip";
$route['api/coupon/ip/(:any)'] = "Api_coupon/check_quota_ip_number/$1";

$route['api/auth'] = "Api_auth/get_session_id";
$route['api/auth/'] = "Api_auth/get_session_id";
$route['api/auth/data'] = "Api_auth/get_session_data";

$route['api/register'] = "Api_user/register";
$route['api/register/verify'] = "Api_user/verify_email";

$route['api/region'] = "Api_content/get_wordpress_categories";
