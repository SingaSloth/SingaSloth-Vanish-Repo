<?php
/**

 ###
 #
 ###
   #
 ###singaslot.net
#        singaslot.net
**/

namespace SingaSlot;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use pocketmine\player\GameMode;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI\SimpleForm;

class VanishUI extends PluginBase implements Listener {
  
  public function onEnable(): void {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    
    @mkdir($this->getDataFolder());
    $this->saveDefaultConfig();
    $this->getResource("config.yml");
  }
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
    $commandname = $command->getName();
    if($commandname == "vanish"){
      if($sender instanceof Player){
        $this->vanish($sender);
      }
    }
    return true;
  }
  
  public function vanish(Player $player){
    $form = new SimpleForm(function (Player $player, int $data = null){
      if($data === null){
        $return;
      }
      switch ($data) {
          case 0:
              $player->setInvisible(true);
              $player->setSilent(true);
              $player->setFlying(true);
              $player->setAllowFlight(true);
              $player->sendPopup("§aYou Are Vanish");
          break;
        
          case 1:
              $player->setInvisible(false);
              $player->setSilent(false);
              $player->setFlying(false);
              $player->setAllowFlight(false);
              $player->sendPopup("§aYou No Invisible");
          break;
      }
    });
    $form->setTitle($this->getConfig()->get("Title"));
    $form->setContent($this->getConfig()->get("Content"));
    $form->addButton("§a§lVANISH");
    $form->addButton("§c§lUNVANISH");
    $player->sendForm($form);
    return $form;
  }
}
?>