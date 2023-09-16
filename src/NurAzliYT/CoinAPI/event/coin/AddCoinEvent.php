<?php

namespace NurAzliYT\CoinAPI\event\coin;

use NurAzliYT\CoinAPI\event\CoinAPIEvent;
use NurAzliYT\CoinAPI\CoinAPI;

class AddCoinEvent extends CoinAPIEvent{
	private $username, $amount;
	public static $handlerList;
	
	public function __construct(CoinAPI $plugin, $username, $amount, $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->amount = $amount;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function getAmount(){
		return $this->amount;
	}
}
