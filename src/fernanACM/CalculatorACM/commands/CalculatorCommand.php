<?php 

namespace fernanACM\CalculatorACM\commands;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
# Lib - Commando
use CortexPE\Commando\BaseCommand;
# My files
use fernanACM\CalculatorACM\Calculator;
use fernanACM\CalculatorACM\utils\PluginUtils;

class CalculatorCommand extends BaseCommand{

	protected function prepare(): void{
		$this->setPermission("calculatoracm.cmd.acm");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if (!$sender instanceof Player) {
              $sender->sendMessage("Use this command in-game");
              return;
        }
        if($sender->hasPermission("calculatoracm.cmd.acm")){
        	Calculator::getInstance()->calculatormenu->CalculatorMenu($sender);
        }else{
        	$prefix = Calculator::getInstance()->getMessage($sender, "Prefix");
        	$sender->sendMessage($prefix . Calculator::getInstance()->getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
        }
	}
}
