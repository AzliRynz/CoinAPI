<?php

namespace NurAzliYT\CoinAPI\event\coin;

use NurAzliYT\CoinAPI\event\CoinAPIEvent;
use NurAzliYT\CoinAPI\CoinAPI;

class PayCoinEvent extends CoinAPIEvent{
	private $payer, $target, $amount;
	public static $handlerList;
	
	public function __construct(CoinAPI $plugin, $payer, $target, $amount){
		parent::__construct($plugin, "PayCoinCommand");
		
		$this->payer = $payer;
		$this->target = $target;
		$this->amount = $amount;
	}
	
	public function getPayer(){
		return $this->payer;
	}
	
	public function getTarget(){
		return $this->target;
	}
	
	public function getAmount(){
		return $this->amount;
	}
}
