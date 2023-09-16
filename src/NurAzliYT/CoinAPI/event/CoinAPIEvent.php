<?php

namespace NurAzliYT\CoinAPI\event;

use pocketmine\event\plugin\PluginEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;

use NurAzliYT\CoinAPI\CoinAPI;

class CoinAPIEvent extends PluginEvent implements Cancellable{
    use CancellableTrait;
    private $issuer;
    
    public function __construct(CoinAPI $plugin, $issuer){
        parent::__construct($plugin);
        $this->issuer = $issuer;
    }
    
    public function getIssuer(){
        return $this->issuer;
    }
}
