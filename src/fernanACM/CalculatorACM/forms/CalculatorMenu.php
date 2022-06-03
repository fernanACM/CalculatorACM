<?php 

namespace fernanACM\CalculatorACM\forms;

use pocketmine\Server;
use pocketmine\player\Player;

use Vecnavium\FormsUI\SimpleForm;

use fernanACM\CalculatorACM\Calculator;
use fernanACM\CalculatorACM\utils\PluginUtils;

class CalculatorMenu{

	public function CalculatorMenu(Player $player){
		$form = new SimpleForm(function(Player $player , $data){
			if($data !== null){
				switch($data){
					case 0: //Additon
					   Calculator::getInstance()->addition->AdditionForm($player);
					   PluginUtils::PlaySound($player, "random.pop", 1, 18);
					break;

					case 1: //Subtraction
					    Calculator::getInstance()->subtraction->SubtractionForm($player);
					    PluginUtils::PlaySound($player, "random.pop", 1, 18);
					break;

					case 2: //Division
					    Calculator::getInstance()->division->DivisionForm($player);
					    PluginUtils::PlaySound($player, "random.pop", 1, 18);
					break;

					case 3: //Multiplication
					    Calculator::getInstance()->multiplication->MultiplicationForm($player);
					    PluginUtils::PlaySound($player, "random.pop", 1, 18);
					break;

					case 4: //Exit
					    PluginUtils::PlaySound($player, "random.pop2", 1, 18);
					break; 
				}
			}
		});
		$form->setTitle(Calculator::getInstance()->getMessage($player, "CalculatorMenu.title"));
		$form->setContent(Calculator::getInstance()->getMessage($player, "CalculatorMenu.content"));
		$form->addButton(Calculator::getInstance()->getMessage($player, "CalculatorMenu.button-addition"),1,"https://i.imgur.com/H1jtwKg.png");
		$form->addButton(Calculator::getInstance()->getMessage($player, "CalculatorMenu.button-subtraction"),1,"https://i.imgur.com/ksNuJ4q.png");
		$form->addButton(Calculator::getInstance()->getMessage($player, "CalculatorMenu.button-division"),1,"https://i.imgur.com/vketyEi.png");
		$form->addButton(Calculator::getInstance()->getMessage($player, "CalculatorMenu.button-multiplication"),1,"https://i.imgur.com/FSUGeSE.png");
		$form->addButton(Calculator::getInstance()->getMessage($player, "CalculatorMenu.button-exit"),0,"textures/ui/cancel");
		$player->sendForm($form);
	}
}