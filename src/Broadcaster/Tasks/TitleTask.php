<?php

/*
 * Broadcaster (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 13/01/2018 04:01 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;

use Broadcaster\Broadcaster;

class TitleTask extends PluginTask {
    
    public function __construct(Broadcaster $plugin){
        parent::__construct($plugin);
        $this->i = 0;
    }
    
    public function onRun(int $currentTick){
        $this->plugin = $this->getOwner();
        $messages = $this->plugin->cfg["title-broadcast"]["messages"];
        while($this->i < count($messages)){
            $msg = explode("{SUBTITLE}", $messages[$this->i]);
            Server::getInstance()->broadcastTitle($this->plugin->translateColors("&", $this->plugin->formatMessage($msg[0])), isset($msg[1]) ? $this->plugin->translateColors("&", $this->plugin->formatMessage($msg[1])) : "");
            $this->i++;
            break;
        }
        if($this->i == count($messages)){
            $this->i = 0;
        }
    }
}