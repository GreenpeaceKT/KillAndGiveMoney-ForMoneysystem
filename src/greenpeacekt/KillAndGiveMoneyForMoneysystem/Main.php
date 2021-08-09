<?php

declare(strict_types=1);

namespace greenpeacekt\KillAndGiveMoneyForMoneysystem;

use RuntimeException;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;

use metowa1227\moneysystem\api\core\API;

class Main extends PluginBase implements Listener{

    private $config;

    public function onEnable() {
         $this->getServer()->getPluginManager()->registerEvents($this, $this);
         $this->config = new Config($this->getDataFolder() . "KillGiveMoney.yml", Config::YAML, array("amount" =>100));
         if(!is_numeric($this->config->get("amount"))){
            throw new RuntimeException("amount is not a number",0,null);
         }
     }

    public function onDeath(PlayerDeathEvent $ev){
        $api = API::getInstance();
        $entity = $ev->getPlayer();
    	$cause = $entity->getLastDamageCause();
    	if($cause instanceof EntityDamageByEntityEvent){
    		$name = $cause->getDamager()->getName();
    		$api->increase($name, $this->config->get("amount"));
    	}
    }

}
