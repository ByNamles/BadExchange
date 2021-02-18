<?php


namespace Exchange\forms\sell;


use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use dktapps\pmforms\FormIcon;
use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use pocketmine\Player;

class SellMainForm extends MenuForm
{
    public function __construct()
    {
        parent::__construct("Sales","",[
            new MenuOption("Dolar",new FormIcon("https://i.hizliresim.com/xiihZU.jpg",FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("Euro",new FormIcon("https://i.hizliresim.com/hCxaA7.jpg",FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("Gold",new FormIcon("https://i.hizliresim.com/5L2zgx.jpg",FormIcon::IMAGE_TYPE_URL))
        ],function (Player $player,int $selectedOption):void{
            $text = $this->getOption($selectedOption)->getText();
            switch ($text){
                case "Dolar":
                    $player->sendForm(new SellingForm("Dolar","Sales",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
                case "Euro":
                    $player->sendForm(new SellingForm("Euro","Sales",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
                case "Gold":
                    $player->sendForm(new SellingForm("Gold","Sales",new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),$player,new ExchangeDataAPI()));
                    break;
            }
        });
    }

}