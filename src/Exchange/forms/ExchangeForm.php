<?php


namespace Exchange\forms;


use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use Exchange\api\ExchangeDataAPI;
use Exchange\forms\buy\BuyMainForm;
use Exchange\forms\sell\SellMainForm;
use pocketmine\Player;


class ExchangeForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§3Borsa","",[
            new MenuOption("Buying"),
            new MenuOption("Sales"),
            new MenuOption("Wallet")
        ],function (Player $player,int $selectedOption):void{
            $text = $this->getOption($selectedOption)->getText();
            switch ($text){
                case "Buying":
                                $player->sendForm(new BuyMainForm());
                                break;
                                case "Sales":
                                $player->sendForm(new SellMainForm());
                                break;
                case "Wallet":
                    $player->sendForm(new WalletForm($player,new ExchangeDataAPI()));
                    break;
            }
        });
    }

}

