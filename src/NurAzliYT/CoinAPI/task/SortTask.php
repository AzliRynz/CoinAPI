<?php

namespace NurAzliYT\CoinAPI\task;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\player\Player;

use NurAzliYT\CoinAPI\CoinAPI;

class SortTask extends AsyncTask{
    private $sender, $rebirthcoinData, $addOp, $page, $ops, $banList, $coinData;

    private $max = 0;

    private $topList;

    /**
     * @param string            $player
     * @param array                $pointData
     * @param bool                $addOp
     * @param int                $page
     * @param array                $ops
     * @param array                $banList
     */
    public function __construct(string $sender, array $coinData, bool $addOp, int $page, array $ops, array $banList){
        $this->sender = $sender;
        $this->coinData = $coinData;
        $this->addOp = $addOp;
        $this->page = $page;
        $this->ops = $ops;
        $this->banList = $banList;
    }

    public function onRun() : void{
        $this->topList = serialize((array)$this->getTopList());
    }

    private function getTopList(){
        $topcoin = (array)$this->coinData;
        $banList = (array)$this->banList;
        $ops = (array)$this->ops;
        arsort($topcoin);

        $ret = [];

        $n = 1;
        $this->max = ceil((count($topcoin) - count($banList) - ($this->addOp ? 0 : count($ops))) / 5);
        $this->page = (int)min($this->max, max(1, $this->page));

        foreach($topcoin as $p => $m){
            $p = strtolower($p);
            if(isset($banList[$p])) continue;
            if(isset($this->ops[$p]) and $this->addOp === false) continue;
            $current = (int) ceil($n / 5);
            if($current === $this->page){
                $ret[$n] = [$p, $m];
            }elseif($current > $this->page){
                break;
            }
            ++$n;
        }
        return $ret;
    }

    public function onCompletion(): void{
        if($this->sender === "CONSOLE" or ($player = Server::getInstance()->getPlayerExact($this->sender)) instanceof Player){ // TODO: Rcon
            $plugin = CoinAPI::getInstance();

            $output = ($plugin->getMessage("topcoin-tag", [$this->page, $this->max], $this->sender)."\n");
            $message = ($plugin->getMessage("topcoin-format", [], $this->sender)."\n");

            foreach(unserialize($this->topList) as $n => $list){
                $output .= str_replace(["%1", "%2", "%3"], [$n, $list[0], $list[1]], $message);
            }
            $output = substr($output, 0, -1);

            if($this->sender === "CONSOLE"){
                $plugin->getLogger()->info($output);
            }else{
                $player->sendMessage($output);
            }
        }
    }
}
