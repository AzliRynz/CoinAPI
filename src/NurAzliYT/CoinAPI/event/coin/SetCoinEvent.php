<?php

namespace NurAzliYT\CoinAPI\event\coin;

use NurAzliYT\CoinAPI\event\CoinAPIEvent;

use NurAzliYT\CoinAPI\CoinAPI;

class SetCoinEvent extends CoinAPIEvent{
	private $username, $coin;
	public static $handlerList;
	
	public function __construct(CoinAPI $plugin, $username, $coin, $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->coin = $coin;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function getCoin(){
		return $this->coin;
	}
}
