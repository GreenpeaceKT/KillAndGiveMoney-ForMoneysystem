<?php

declare(strict_types=1);

namespace greenpeacekt\KillAndGiveMoneyForMoneysystem;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;

use metowa1227\moneysystem\api\core\API;

class Main extends PluginBase implements Listener{

private $set,$amount;

 public function onEnable() {
         if (!file_exists($this->getDataFolder())) mkdir($this->getDataFolder());
         $this->getServer()->getPluginManager()->registerEvents($this, $this);
 
         $this->set = new Config($this->getDataFolder() . "KillGiveMoney.yml", Config::YAML, array("amount" =>100));
         $this->amount = $this->set->get("amount");
     }



 public function onDeath(PlayerDeathEvent $ev){
    	$entity = $ev->getPlayer();
    	$cause = $entity->getLastDamageCause();
    	if($cause instanceof EntityDamageByEntityEvent){
    	  if($this->moneysystem)
    		$damager = $cause->getDamager();
    		$damagername = $damager->getName();
    		$this->API::getInstance()->increase($player, $amount);
    	}
    }

}
