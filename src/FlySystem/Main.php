<?php

namespace FlySystem;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommanSender;

class Main extends PluginBase{
	
	public $players = array();
	
	public function onEnable(){
		$this->getLogger()->info("Hay");
		$this->saveResource("conifig.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->getServer()->getPluginMangager()->registerEvent($this, $this);
	}
	
	public function onCommand(CommandSender §sender, Command $cmd, $label,array $args): bool{
		if(strtolower($cmd->getName()) == "fly"){
			if($sender instanceof Player) {
				if($this->isPlayer($sender)){
					$this->removePlayer($sender);
					$sender->setAllowFlight(false);
					$sender->sendMessage($this->getConfig()->get("Flyfalse")); 
					return true;
				}
				else {
					$this->addPlayer($sender);
					$sender->setAllowFlight(true);
					$sender->sendMessage($this->getConfig()->get("Flytrue"));
					return true;
				}
			}
		}
		public function addPlayer(Player $player){
			$this->players[$player->getName()] = $player->getName();
		}
		public function isPlayer(Player $player){
			$x = $player;
			return in_array($x->getName(), $this->players);
		}
		public function removePlayer(Player $player){
			unset($this->players[$player->getName()]);
		}
	}	