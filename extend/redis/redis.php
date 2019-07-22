<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4
 * Time: 16:09
 */

namespace redis;


class redis
{
    protected $redis=null;
    protected $options = [
        'host'       => '127.0.0.1',
        'port'       => 6379,
        'password'   => '',
        'select'     => 0,
        'timeout'    => 0,
        'expire'     => 0,
        'persistent' => false,
        'prefix'     => '',
    ];
    /**
     * 构造函数
     * @param array $options 缓存参数
     * @access public
     */
    public function __construct($options = []){
        if (!extension_loaded('redis')) {
            throw new \BadFunctionCallException('not support: redis');
        }
        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }
        $this->handler = new \Redis;
        if ($this->options['persistent']) {
            $this->handler->pconnect($this->options['host'], $this->options['port'], $this->options['timeout'], 'persistent_id_' . $this->options['select']);
        } else {
            $this->handler->connect($this->options['host'], $this->options['port'], $this->options['timeout']);
        }

        if ('' != $this->options['password']) {
            $this->handler->auth($this->options['password']);
        }

        if (0 != $this->options['select']) {
            $this->handler->select($this->options['select']);
        }
    }

    /*
     * 后台添加秒杀抢购商品
     * $stock    秒杀总库存
     * $goodsId  待秒杀的商品编号
     * 后台在将商品加入秒杀的时候，让其填入秒杀数，商品id自动获取
     * */
    public function kill_goods($stock = 30,$goodsId = 1000001){
        // 将商品库存依次放入队列中
        for ($i=0; $i<$stock; $i++) {
            $this->handler->rpush('stock_' . $goodsId, 1);
            echo $i."号stock_" . $goodsId."商品入队成功"."<br/>";
        }
    }
    /*
     * 秒杀抢购商品
     * $user    用户名
     * $goodsId  待秒杀的商品编号
     * 用户每点击出队一个商品，将用户信息和商品信息入队
     * */
    public function buy_goods($user='' ,$goodsId = 1000001)
    {
        $value = $this->handler->lpop('stock_' . $goodsId);
        if ($value) {
            $data = $this->handler->lRange('users_'.$goodsId,0,-1);
            //判断用户是否已经抢购成功
            if(in_array($user,$data)){
                echo '您已抢购成功，请不要重复抢购！';
                echo '<br/>';
                return;
            }else{
                // 将抢购成功的用户信息和商品信息存入队列
                $this->handler->rpush('users_'.$goodsId, $user.'_'.$goodsId);
                echo '恭喜您！用户' . $user;
                echo '<br/>';
            }
        } else {
            echo '售罄了！用户' . $user.',很遗憾，你此次未抢到该商品。';
            // 输出最终抢购成功的用户数量
            echo '最终抢购人数：'.$this->handler->Llen('users_'.$goodsId).'。' ;
            //判断指定值是否存在
            echo '指定值:'.$this->handler->exists('stock_' . $goodsId);
            echo '<br/>';
            return;
        }
    }
    /*
     * 秒杀抢购商品
     * $user    用户名
     * $goodsId  待秒杀的商品编号
     * 系统脚本运行判断队列是否有值，若有执行该用户购买出队方法
     * */
    public function user_goods_info($goodsId = 1000001){
        $value = $this->handler->lpop('users_'.$goodsId);
        if ($value){
            echo $value;
            echo '恭喜您！用户' . $value;
            echo '<br/>';
        }else{
            echo '没有了。' ;
            echo '指定值:'.$this->handler->exists('users_'.$goodsId);
            return;
        }
    }

}