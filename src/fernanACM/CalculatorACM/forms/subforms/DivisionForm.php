<?php 

namespace fernanACM\CalculatorACM\forms\subforms;

use pocketmine\Server;
use pocketmine\player\Player;

use Vecnavium\FormsUI\CustomForm;

use fernanACM\CalculatorACM\Calculator;
use fernanACM\CalculatorACM\utils\PluginUtils;

class DivisionForm{

	public function DivisionForm(Player $player){
		$form = new CustomForm(function(Player $player, $data){
			if(is_array($data) and is_numeric($data[1]) and is_numeric($data[2])){
				$result = $data[1] / $data[2];
				#Message
				$prefix = Calculator::getInstance()->getMessage($player, "Prefix");
				$message = Calculator::getInstance()->getMessage($player, "Messages.result-successful");
				$player->sendMessage(str_replace(["{RESULT}"], [number_format($result)], $prefix . $message));
				PluginUtils::PlaySound($player, "random.levelup", 1, 1);
			}elseif (!is_null($data)){
                $prefix = Calculator::getInstance()->getMessage($player, "Prefix");
                $player->sendMessage($prefix . Calculator::getInstance()->getMessage($player, "Messages.error-line"));
		PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            }
		});
		$form->setTitle(Calculator::getInstance()->getMessage($player, "Division.title"));
		$form->addLabel(Calculator::getInstance()->getMessage($player, "Division.content"));
		$form->addInput(Calculator::getInstance()->getMessage($player, "Division.input-1"), "CalculatorACM");
		$form->addInput(Calculator::getInstance()->getMessage($player, "Division.input-2"), "CalculatorACM");
		$player->sendForm($form);
	}
}
