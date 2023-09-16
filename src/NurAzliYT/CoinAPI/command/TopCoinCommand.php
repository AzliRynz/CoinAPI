<?php

namespace NurAzliYT\CoinAPI\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use NurAzliYT\CoinAPI\CoinAPI;
use NurAzliYT\CoinAPI\task\SortTask;

class TopCoinCommand extends Command{
    /** @var CoinAPI */
    private $plugin;

    public function __construct(CoinAPI $plugin){
        $desc = $plugin->getCommandMessage("topcoin");
        parent::__construct("topcoin", $desc["description"], $desc["usage"]);

        $this->setPermission("coinapi.command.topcoin");

        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $params): bool{
        if(!$this->plugin->isEnabled()) return false;
        if(!$this->testPermission($sender)) return false;

        $page = (int)array_shift($params);

        $server = $this->plugin->getServer();

        $banned = [];
        foreach($server->getNameBans()->getEntries() as $entry){
            if($this->plugin->accountExists($entry->getName())){
                $banned[] = $entry->getName();
            }
        }
        $ops = [];
        foreach($server->getOps()->getAll() as $op){
            if($this->plugin->accountExists($op)){
                $ops[] = $op;
            }
        }

        $task = new SortTask($sender->getName(), $this->plugin->getAllCoin(), $this->plugin->getConfig()->get("add-op-at-rank"), $page, $ops, $banned);
        $server->getAsyncPool()->submitTask($task);
        return true;
    }
}
