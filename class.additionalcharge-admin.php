<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author yongquizheng
 */
class AdditionalCharge_Admin {
    	
    private static $initiated = false;


    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {

		self::$initiated = true;
	}

}
