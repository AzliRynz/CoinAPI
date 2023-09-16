<?php

namespace NurAzliYT\CoinAPI\event\account;

use NurAzliYT\CoinAPI\event\CoinAPIEvent;
use NurAzliYT\CoinAPI\CoinAPI;

class CreateAccountEvent extends CoinAPIEvent{
	private $username, $defaultCoin;
	public static $handlerList;
	
	public function __construct(CoinAPI $plugin, $username, $defaultCoin, $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->defaultCoin = $defaultCoin;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setDefaultCoin($coin){
		$this->defaultCoin = $coin;
	}
	
	public function getDefaultCoin(){
		return $this->defaultCoin;
	}
}
