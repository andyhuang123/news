<?php

/**
 * resultList
 * @author auto create
 */
class MapData
{
	
	/** 
	 * 优惠门槛类型： 1 满元 2 满件
	 **/
	public $condition_type;
	
	/** 
	 * 优惠类型： 1 减钱 2 打折
	 **/
	public $discount_type;
	
	/** 
	 * 权益信息展示结束时间，精确到毫秒时间戳
	 **/
	public $display_end_time;
	
	/** 
	 * 权益信息展示开始时间，精确到毫秒时间戳
	 **/
	public $display_start_time;
	
	/** 
	 * 店铺信息-卖家昵称
	 **/
	public $nick;
	
	/** 
	 * 权益扩展信息
	 **/
	public $promotion_extend;
	
	/** 
	 * 权益信息
	 **/
	public $promotion_list;
	
	/** 
	 * 权益类型。1 有价券（需要购买的店铺券或单品券） 2 公开券（直接领取的店铺券或单品券） 3 妈妈券（妈妈渠道领取的店铺券或单品券） 4.品类券 （跨店可用券，可与1，2，3叠加）
	 **/
	public $promotion_type;
	
	/** 
	 * 权益信息-剩余库存（权益剩余库存量）
	 **/
	public $remain_count;
	
	/** 
	 * 店铺信息-卖家ID
	 **/
	public $seller_id;
	
	/** 
	 * 店铺信息-店铺logo
	 **/
	public $shop_picture_url;
	
	/** 
	 * 店铺信息-店铺名称
	 **/
	public $shop_title;
	
	/** 
	 * 权益信息-总量（权益初始库存量）
	 **/
	public $total_count;	
}
?>