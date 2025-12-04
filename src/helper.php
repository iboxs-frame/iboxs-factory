<?php

use common\RabbitMQ;
use iboxs\redis\Redis;

if(class_exists('iboxs\redis\Redis')){
    if(!function_exists('redis')){
        /**
         * Redis读写
         * @param $key
         * @param null $value
         * @param int $expire
         * @return mixed
         */
        function redis(string $key,$value=null,$expire=0){
            if($value==null){
                return Redis::basic()->get($key);
            }
            return Redis::basic()->set($key,$value,$expire);
        }
    }

    if(!function_exists('redis_del')){
        /**
         * Redis删除
         * @param $key
         * @return mixed
         */
        function redis_del(string $key){
            return Redis::basic()->del($key);
        }
    }

    if(!function_exists('redis_exists')){
        /**
         * Redis是否存在
         * @param $key
         * @return mixed
         */
        function redis_exists(string $key){
            return Redis::basic()->exists($key);
        }
    }

    if(!function_exists('redis_keys')){
        /**
         * Redis获取所有key
         * @param $key
         * @return mixed
         */
        function redis_keys(string $key){
            return Redis::basic()->keys($key);
        }
    }

    if(!function_exists('redis_inc')){
        /**
         * Redis自增
         * @param $key
         * @return mixed
         */
        function redis_inc(string $key,int $step=1){
            return Redis::basic()->inc($key,$step);
        }
    }

    if(!function_exists('redis_dec')){
        /**
         * Redis自减
         * @param $key
         * @return mixed
         */
        function redis_dec(string $key,int $step=1){
            return Redis::basic()->dec($key,$step);
        }
    }
}
if(class_exists('iboxs\Queue')){
    if(!function_exists('rabbitmqMiddle')){
        /**
         * 写入普通队列消息
         */
        function rabbitmqMiddle(string $type,$data,int $delay=0){
            RabbitMQ::pushMiddle($type,$data,$delay);
        }
    }

    if(!function_exists('rabbitmqHigh')){
        /**
         * 写入高优先级队列消息
         */
        function rabbitmqHigh(string $type,$data,int $delay=0){
            return RabbitMQ::pushHighMsg($type,$data,$delay);
        }
    }

    if(!function_exists('rabbitmqLow')){
        /**
         * 写入高优先级队列消息
         */
        function rabbitmqLow(string $type,$data,int $delay=0){
            return RabbitMQ::pushLowMsg($type,$data,$delay);
        }
    }
}
?>