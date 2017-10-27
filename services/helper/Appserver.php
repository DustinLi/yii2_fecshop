<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\services\helper;

use fecshop\services\Service;
use Yii;

/**
 * 该类主要是给appserver端的api，返回的数据做格式输出，规范输出的各种状态。
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Appserver extends Service
{
    /**
     * 公共状态码
     */
    public $status_success                                = 200;
    public $status_unkown                                 = 1000000;   // 程序内部错误：未知错误
    public $status_mysql_disconnect                       = 1000001;   // 程序内部错误：mysql连接错误
    public $status_mongodb_disconnect                     = 1000002;   // 程序内部错误：mongodb连接错误
    public $status_redis_disconnect                       = 1000003;   // 程序内部错误：redis连接错误
    public $status_invalid_token                          = 1000004;   // 无效数据：token无效
    public $status_invalid_request_url                    = 1000005;   // 无效请求：该url不存在
    public $status_invalid_email                          = 1000006;   // 格式错误：邮箱格式无效
    public $status_invalid_captcha                        = 1000007;   // 无效数据：验证码错误
    public $status_invalid_param                          = 1000008;   // 无效参数
    public $status_miss_param                             = 1000009;   // 参数丢失
    public $status_limit_beyond                           = 1000010;   // 超出限制
    public $status_data_repeat                            = 1000011;   // 数据重复
    public $status_attack                                 = 1000012;   // 确定为攻击返回的状态
    public $status_invalid_code                           = 1000013;   // 程序内部错误：传递的无效code
    /**
     * 用户部分的状态码
     */
    public $account_register_email_exist                  = 1100000; // 注册：邮箱已经存在
    public $account_register_invalid_data                 = 1100001; // 注册：邮箱格式不正确 
    public $account_login_invalid_email_or_password       = 1100002; // 登录：账户的邮箱或者密码不正确
    public $account_no_login_or_login_token_timeout       = 1100003; // 登录：账户的token已经过期,或者没有登录
    public $account_edit_invalid_data                     = 1100004; // 编辑：账户的密码格式不正确
    public $account_contact_us_send_email_fail            = 1100005; // contact：发送邮件失败
    /**
     * category状态码
     */
    public $category_not_exist                             = 1200000; // 分类：分类不存在
     
    /**
     * product状态码
     */
    public $product_favorite_fail                          = 1300000; // 产品：产品收藏失败
    public $product_not_active                             = 1300001; // 产品：产品不存在，或者已经下架
    
    public $product_id_not_exist                           = 1300002; // 产品：产品不存在，或者已经下架
    public $product_save_review_fail                       = 1300003; // 产品：产品保存平台失败
    
    
    /**
     * cart
     */
    public $cart_product_add_fail                          = 1400001; // Cart：产品加入购物车失败
    public $cart_product_add_param_invaild                 = 1400002; // Cart：产品加入购物车传递参数无效
    public $cart_product_update_qty_fail                   = 1400003; // Cart：更改cart中product的个数失败
    public $cart_coupon_invalid                            = 1400004; // Cart：coupon不可用
    
    
    /**
     * order
     */
    public $order_generate_product_stock_out               = 1500001; // Order: 下订单，产品库存不足。
    public $order_generate_fail                            = 1500002; // Order: 下订单，生成订单失败。
    public $order_paypal_express_get_token_fail            = 1500003; // Order: 通过paypal express方式支付，获取token失败
    public $order_generate_request_post_param_invaild      = 1500004; // Order: 下订单，必填的订单字段验证失败。
    public $order_generate_create_account_fail             = 1500005; // Order: 下订单，游客在下订单的同时直接生成账户失败。
    public $order_generate_save_address_fail               = 1500006; // Order: 下订单，游客在下订单的同时保存address信息失败。
    public $order_generate_cart_product_empty              = 1500007; // Order: 下订单，购物车数据为空
    public $order_shipping_country_empty                   = 1500008; // Order: 下订单页面，切换address，获取运费的接口，无法获取country
    public $order_paypal_standard_get_token_fail           = 1500009; // Order: 通过paypal standard方式支付，获取token失败
    public $order_paypal_standard_payment_fail             = 1500010; // Order: 通过paypal standard方式支付，通过api支付失败
    public $order_paypal_standard_updateorderinfoafterpayment_fail  = 1500011; // Order: 通过paypal standard方式支付，api支付订单成功后，更新订单信息失败
    public $order_not_find_increment_id_from_dbsession     = 1500012; // order：无法从dbsession中获取order increment id
    
    public $order_paypal_express_payment_fail              = 1500013;           // Order: 通过paypal express方式支付，通过api支付失败
    public $order_paypal_express_updateorderinfoafterpayment_fail   = 1500014;  // Order: 通过paypal express方式支付，api支付订单成功后，更新订单信息失败
    public $order_paypal_express_get_PayerID_fail          = 1500015;           // Order: 通过paypal express方式支付，获取PayerID失败
    public $order_paypal_express_get_apiAddress_fail       = 1500016;           // Order: 通过paypal express方式支付，获取address失败
    
    public $order_has_been_paid                            = 1500017;           // Order: 下订单，订单已经被支付过
    public $order_not_exist                                = 1500018;           // Order: 下订单，订单不存在
    public $order_alipay_payment_fail                      = 1500019;           // Order: 下订单，支付宝支付订单失败
    
    /**
     * cms
     */
    public $cms_article_not_exist                          = 1600001;           // Article: 文章不存在
    
    
    
    /**
     * @property $code | String 状态码
     * @property $data | 混合状态，可以是数字，数组等格式，用于做返回给前端的数组。
     * @property $message | String ，选填，如果不填写，则使用  函数 返回的内容作为message
     */
    public function getReponseData($code, $data, $message = ''){
        if(!$message){
            $message = $this->getMessageByCode($code);
        }
        if ($message) {
            return [
                'code'    => $code,
                'message' => $message,
                'data'    => $data,
            ];
        } else { // 如果不存在，则说明系统内部调用不存在的code，报错。
            $code = $this->status_invalid_code;
            $message = $this->getMessageByCode($code);
            return [
                'code'    => $code,
                'message' => $message,
                'data'    => '',
            ];
        }
        
    }
    
    /**
     * @property $code | String ，状态码
     * 得到 code 对应 message的数组
     */
    public function getMessageByCode($code){
        $messageArr = $this->getMessageArr();
        return isset($messageArr[$code]['message']) ? $messageArr[$code]['message'] : '';
    }
    /**
     * 得到 code 对应 message的数组
     */
    public function getMessageArr(){
        $arr = [
            /**
             * 公共状态码
             */
            $this->status_success => [
                'message' => 'process success',
            ],
            $this->status_unkown => [
                'message' => 'unknow errors',
            ],
            $this->status_mysql_disconnect => [
                'message' => 'mysql connect timeout',
            ],
            $this->status_mongodb_disconnect => [
                'message' => 'mongodb connect timeout',
            ],
            $this->status_redis_disconnect => [
                'message' => 'redis connect timeout',
            ],
            $this->status_invalid_token => [
                'message' => 'token is timeout or invalid',
            ],
            $this->status_invalid_request_url => [
                'message' => 'the request url is not exist',
            ],
            $this->status_invalid_email => [
                'message' => 'email format is not correct',
            ],
            $this->status_invalid_captcha => [
                'message' => 'captcha is not correct',
            ],
            $this->status_invalid_param => [
                'message' => 'incorrect request parameter',
            ],
            $this->status_invalid_code => [
                'message' => 'system error, invalid code',
            ],
            
            $this->status_miss_param => [
                'message' => 'required parameter does not exist',
            ],
            $this->status_limit_beyond => [
                'message' => 'beyond maximum limit',
            ],
            $this->status_data_repeat => [
                'message' => 'insert data is repeat',
            ],
            $this->status_attack => [
                'message' => 'access exception, the visit to determine the attack behavior',
            ],
            
            /**
             * 用户部分的状态码
             */
            $this->account_no_login_or_login_token_timeout => [
                'message' => 'account not login or token timeout',
            ],
            $this->account_register_email_exist => [
                'message' => 'account register email is exist',
            ],
            $this->account_register_invalid_data => [
                'message' => 'account register data is invalid',
            ],
            
            $this->account_login_invalid_email_or_password => [
                'message' => 'account login email or password is not correct',
            ],
            $this->account_edit_invalid_data => [
                'message' => 'account edit data is invalid',
            ],
            $this->account_contact_us_send_email_fail => [
                'message' => 'customer contact us send email fail',
            ],
            
            
            /**
             * category 
             */
            $this->category_not_exist => [
                'message' => 'category is not exist',
            ],
            
            /**
             * product 
             */
            $this->product_favorite_fail => [
                'message' => 'product favorite fail',
            ],
            $this->product_not_active => [
                'message' => 'product is not exist or off the shelf',
            ],
            
            
            $this->product_id_not_exist => [
                'message' => 'product id is not exist',
            ],
            $this->product_save_review_fail => [
                'message' => 'save product review fail',
            ],
            /**
             * Cart 
             */
            $this->cart_product_add_fail => [
                'message' => 'product add to cart fail',
            ],
            $this->cart_product_add_param_invaild => [
                'message' => 'product add to cart request param is invaild',
            ],
            $this->cart_product_update_qty_fail => [
                'message' => 'update cart product qty fail',
            ],
            $this->cart_coupon_invalid => [
                'message' => 'coupon code is invalid',
            ],
            
            
            /**
             * Order 
             */
            $this->order_generate_product_stock_out => [
                'message' => 'before generate order,check product stock out ',
            ],
            
            $this->order_generate_fail => [
                'message' => 'generate order fail',
            ],
            $this->order_paypal_express_get_token_fail => [
                'message' => 'order pay by paypal express api, fetch token fail',
            ],
            $this->order_generate_request_post_param_invaild => [
                'message' => 'require order request param is invaild',
            ],
            $this->order_generate_create_account_fail => [
                'message' => 'order generate page, guest create account fail',
            ],
            $this->order_generate_save_address_fail => [
                'message' => 'order generate page, login account save address fail',
            ],
             $this->order_generate_cart_product_empty => [
                'message' => 'order generate page, cart product is empty',
            ],
            $this->order_shipping_country_empty => [
                'message' => 'order checkout one page, get shipping fail, country is empty',
            ],
            $this->order_paypal_standard_get_token_fail => [
                'message' => 'order pay by paypal standard api, fetch token fail',
            ],
             $this->order_paypal_standard_payment_fail => [
                'message' => 'order pay by paypal standard api, payment fail',
            ],
            $this->order_paypal_standard_updateorderinfoafterpayment_fail => [
                'message' => 'order pay by paypal standard api, update order fail after payment',
            ],
            $this->order_not_find_increment_id_from_dbsession => [
                'message' => 'can not find order increment id from db session storage',
            ],
            
            $this->order_paypal_express_payment_fail => [
                'message' => 'order pay by paypal express api, payment fail',
            ],
            $this->order_paypal_express_updateorderinfoafterpayment_fail => [
                'message' => 'order pay by paypal express api, update order info fail',
            ],
            $this->order_paypal_express_get_PayerID_fail => [
                'message' => 'order pay by paypal express api, fetch PayerID fail',
            ],
            $this->order_paypal_express_get_apiAddress_fail => [
                'message' => 'order pay by paypal express api, fetch address fail',
            ],
            
            $this->order_has_been_paid => [
                'message' => 'order has bean paid',
            ],
            $this->order_not_exist => [
                'message' => 'order is not exist',
            ],
            $this->order_alipay_payment_fail => [
                'message' => 'order pay by alipay payment fail',
            ],
            
            /**
             * cms
             */
            $this->cms_article_not_exist => [
                'message' => 'article is not exist',
            ], 
            
        ];
        return $arr;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}