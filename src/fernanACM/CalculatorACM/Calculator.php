<?php

namespace fernanACM\CalculatorACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\utils\Config;

use pocketmine\plugin\PluginBase;
# Libs
use Vecnavium\FormsUI\FormsUI;
use CortexPE\Commando\PacketHooker;
use muqsit\simplepackethandler\SimplePacketHandler;
# My files
use fernanACM\CalculatorACM\commands\CalculatorCommand;
use fernanACM\CalculatorACM\utils\PluginUtils;
# My files - forms
use fernanACM\CalculatorACM\forms\CalculatorMenu;
use fernanACM\CalculatorACM\forms\subforms\AdditionForm;
use fernanACM\CalculatorACM\forms\subforms\SubtractionForm;
use fernanACM\CalculatorACM\forms\subforms\DivisionForm;
use fernanACM\CalculatorACM\forms\subforms\MultiplicationForm;

class Calculator extends PluginBase{

	public Config $calculator;
	public Config $messages;
	public static $instance;

	public function onEnable(): void{
        self::$instance = $this;
		$this->saveDefaultConfig();
		$this->saveResource("messages.yml");
		$this->messages = new Config($this->getDataFolder() . "messages.yml");
		$this->loadEvents();
		# Libs - FormsUi, Commando and SimplePacketHandler
		foreach ([
			    "FormsUI" => FormsUI::class,
                "Commando" => PacketHooker::class,
                "SimplePacketHandler" => SimplePacketHandler::class
            ] as $virion => $class
        ) {
            if (!class_exists($class)) {
                $this->getLogger()->error($virion . " virion not found. Please download CalculatorACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        #Commando
        if (!PacketHooker::isRegistered()) {
            PacketHooker::register($this);
        }
	}

	public function loadEvents(){
		$this->getServer()->getCommandMap()->register("calculatoracm", new CalculatorCommand($this, "calculatoracm", "CalculatorACM by fernanACM", ["calcu", "calculator"]));
		$this->calculatormenu = new CalculatorMenu($this);
		$this->addition = new AdditionForm($this);
		$this->subtraction = new SubtractionForm($this);
		$this->division = new DivisionForm($this);
		$this->multiplication = new MultiplicationForm($this);
	}

	public function getMessage(Player $player, string $key){
        return PluginUtils::codeUtil($player, $this->messages->getNested($key, $key));
    }
    
    public static function getInstance(): Calculator{
        return self::$instance;
    }

    public function getCalculatorMenu(): CalculatorMenu{
    	return $this->calculatormenu;
    }

    public function getAdditon(): AdditionForm{
    	return $this->addition;
    }

    public function getSubtraction(): SubtractionForm{
    	return $this->subtraction;
    }

    public function getMultiplication(): MultiplicationForm{
    	return $this->multiplication;
    }
}