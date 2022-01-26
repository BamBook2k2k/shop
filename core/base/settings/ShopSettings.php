<?php

namespace core\base\settings;

use core\base\settings\Settings;

class ShopSettings
{

	static private $_instanse;
	private $baseSettings;

	//массив для контента склейки в будущем 0
	private $templateArr = [
		'text' => ['price', 'short'],
		'textarea' => ['goods_content']
	];
	//1

	static public function get($property){
		return self::instance()->$property;
	}

	static public function instance(){
		if(self::$_instanse instanceof self){
			return self::$_instanse;
		}

		self::$_instanse = new self;
		self::$_instanse->baseSettings = Settings::instance();
		//реализация вызова метода склейки 0
		$baseProperties = self::$_instanse->baseSettings->cluePropertie(get_class());
		//1
		self::$_instanse->setProperty($baseProperties);
		return self::$_instanse;
	}

	protected function setProperty($properties){
		if($properties){
			foreach ($properties as $name => $property){
				$this->$name = $property;
			}
		}
	}

	private function __construct()
	{
	}

	private function __clone()
	{
	}
    
}