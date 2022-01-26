<?php

namespace core\base\settings;

class Settings
{
	static private $_instanse;

	private $routes = [
		'admin' => [
			'alias' => 'admin',
			'path' => 'core/admin/controller/',
			'hrUrl' => false
		],
		'settings' => [
			'path' =>'core/base/settings'
		],
		'plugins' => [
			'path' => 'core/plugins/',
			'hrUrl' => false
		],
		'user' => [
			'path' => 'core/user/controller/',
			'hrUrl' =>true,
			'routes' => [
				'catalog' => 'site'
			]
		],
		'default' => [
			'controller' => 'IndexController',
			'inputMethod' => 'inputData',
			'outputMethod' => 'outputData'
		]
	];

	//массив для контента склейки в будущем 0
	private $templateArr = [
		'text' => ['name', 'phone', 'adress'],
		'textarea' => ['content', 'keywords']
	];
	//1

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	static public function get($property){
		return self::instance()->$property;
	}

	static public function instance(){
		if(self::$_instanse instanceof self){
			return self::$_instanse;
		}

		return self::$_instanse = new self;
	}

	//реализация метода слейки 0 
	public function cluePropertie($class){
		//определение массива свойст $baseProperties для возврата
		$baseProperties = [];

		foreach($this as $name => $item){
			$property = $class::get($name);
			
				if(is_array($property) && is_array($item)){

					$baseProperties[$name] = $this->arrayMergeRecursive($this->$name, $property);
					continue;
				}

				if(!$property) $baseProperties[$name] = $this->name;
		}
		
		return $baseProperties;
	}

	public function arrayMergeRecursive(){
		$arrays = func_get_args();

		$base = array_shift($arrays);

		foreach($arrays as $array){
			foreach($array as $key => $value){
				if(is_array($value) && is_array($base[$key])){
					$base[$key] = $this->arrayMergeRecursive($base[$key], $value);
				}else{
					if(is_int($key)){
						if(!in_array($value, $base)) array_push($base, $value);
						continue;
					}
					$base[$key] = $value;
				}
			}
		}

		return $base;

	}
	//1

}