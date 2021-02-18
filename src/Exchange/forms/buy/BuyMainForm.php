<?php


namespace Exchange\forms\buy;


use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use pocketmine\Player;

class BuyMainForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("Buying","",[
            new MenuOption("Dolar",new FormIcon("https://i.hizliresim.com/xiihZU.jpg",FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("Euro",new FormIcon("https://i.hizliresim.com/hCxaA7.jpg",FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("Gold",new FormIcon("https://i.hizliresim.com/5L2zgx.jpg",FormIcon::IMAGE_TYPE_URL))
        ],function (Player $player,int $selectedOption):void{
            $text = $this->getOption($selectedOption)->getText();
            switch ($text){
                case "Dolar":
                    $player->sendForm(new BuyyingForm("Dolar","Buying",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
                case "Euro":
                    $player->sendForm(new BuyyingForm("Euro","Buying",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
                case "Gold":
                    $player->sendForm(new BuyyingForm("Gold","Buying",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
            }
        });
    }

}