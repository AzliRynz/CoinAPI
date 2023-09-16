<?php

namespace NurAzliYT\CoinAPI\provider;


use NurAzliYT\CoinAPI\CoinAPI;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class YamlProvider implements Provider{
    /**
     * @var Config
     */
    private $config;

    /** @var CoinAPI */
    private $plugin;

    private $coin = [];

    public function __construct(CoinAPI $plugin){
        $this->plugin = $plugin;
    }

    public function open(){
        $this->config = new Config($this->plugin->getDataFolder() . "Coin.yml", Config::YAML, ["version" => 2, "coin" => []]);
        $this->coin = $this->config->getAll();
    }

    public function accountExists($player){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        return isset($this->coin["coin"][$player]);
    }

    public function createAccount($player, $defaultCoin = 1000){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(!isset($this->coin["coin"][$player])){
            $this->coin["coin"][$player] = $defaultCoin;
            return true;
        }
        return false;
    }

    public function removeAccount($player){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->coin["coin"][$player])){
            unset($this->coin["coin"][$player]);
            return true;
        }
        return false;
    }

    public function getCoin($player){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->coin["coin"][$player])){
            return $this->coin["coin"][$player];
        }
        return false;
    }

    public function setCoin($player, $amount){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->coin["coin"][$player])){
            $this->coin["coin"][$player] = $amount;
            $this->coin["coin"][$player] = round($this->coin["coin"][$player], 2);
            return true;
        }
        return false;
    }

    public function addCoin($player, $amount){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->coin["coin"][$player])){
            $this->coin["coin"][$player] += $amount;
            $this->coin["coin"][$player] = round($this->coin["coin"][$player], 2);
            return true;
        }
        return false;
    }

    public function reduceCoin($player, $amount){
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->coin["coin"][$player])){
            $this->coin["coin"][$player] -= $amount;
            $this->coin["coin"][$player] = round($this->coin["coin"][$player], 2);
            return true;
        }
        return false;
    }

    public function getAll(){
        return isset($this->coin["coin"]) ? $this->coin["coin"] : [];
    }

    public function save(){
        $this->config->setAll($this->coin);
        $this->config->save();
    }

    public function close(){
        $this->save();
    }

    public function getName(){
        return "Yaml";
    }
}
