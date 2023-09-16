<?php

namespace onebone\CoinAPI\event\coin;

use NurAzliYT\CoinAPI\CoinAPI;
use NurAzliYT\CoinAPI\event\CoinAPIEvent;

class CoinChangedEvent extends CoinAPIEvent{
	private $username, $coin;
	public static $handlerList;

	public function __construct(CoinAPI $plugin, $username, $coin, $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->coin = $coin;
	}

	/**
	 * @return string
	 */
	public function getUsername(){
		return $this->username;
	}

	/**
	 * @return float
	 */
	public function getCoin(){
		return $this->coin;
	}
}
