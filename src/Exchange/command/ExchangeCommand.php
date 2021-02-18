<?php


namespace Exchange\command;


use Exchange\forms\ExchangeForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class ExchangeCommand extends Command
{

    public function __construct()
    {
        parent::__construct("exchange","Exchange!");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
       if ($sender instanceof Player){
           $sender->sendForm(new ExchangeForm());
       }
    }

}