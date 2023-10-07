<?php
namespace NurAzliYT\CoinAPI\task;


use NurAzliYT\CoinAPI\CoinAPI;
use pocketmine\scheduler\Task;

class MySQLPingTask extends Task{
    private $mysql;
    
    private $plugin;

    public function __construct(CoinAPI $plugin, \mysqli $mysql){
        $this->plugin = $plugin;

        $this->mysql = $mysql;
    }

    public function onRun(): void{
        if(!$this->mysql->ping()){
            $this->plugin->openProvider();
        }
    }
}
