<?php
namespace NurAzliYT\CoinAPI\task;

use NurAzliYT\CoinAPI\CoinAPI;

use pocketmine\scheduler\Task;

class SaveTask extends Task {
    private $plugin;
    public function __construct(CoinAPI $plugin){
        $this->plugin = $plugin;
    }

    public function onRun() : void{
        $this->plugin->saveAll();
    }
}
