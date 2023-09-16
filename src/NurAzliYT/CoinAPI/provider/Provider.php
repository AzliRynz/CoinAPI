<?php

namespace NurAzliYT\CoinAPI\provider;

use NurAzliYT\CoinAPI\CoinAPI;

interface Provider{
	public function __construct(CoinAPI $plugin);

	public function open();

	/**
	 * @param \pocketmine\Player|string $player
	 * @return bool
	 */
	public function accountExists($player);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $defaultPoint
	 * @return bool
	 */
	public function createAccount($player, $defaultCoin = 1000);

	/**
	 * @param \pocketmine\Player|string $player
	 * @return bool
	 */
	public function removeAccount($player);

	/**
	 * @param string $player
	 * @return float|bool
	 */
	public function getCoin($player);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function setCoin($player, $amount);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function addCoin($player, $amount);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function reduceCoin($player, $amount);

	/**
	 * @return array
	 */
	public function getAll();

	/**
	 * @return string
	 */
	public function getName();

	public function save();
	public function close();
}
