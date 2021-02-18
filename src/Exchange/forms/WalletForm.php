<?php


namespace Exchange\forms;


use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Label;
use Exchange\api\ExchangeDataAPI;
use pocketmine\Player;

class WalletForm extends CustomForm
{

    public function __construct(Player $player,ExchangeDataAPI $dataAPI)
    {
        parent::__construct($player->getName()." cüzdanı",[
            new Label("element0","Dolar: ".$dataAPI->getData($player,"Dolar")),
            new Label("element1","Euro: ".$dataAPI->getData($player,"Euro")),
            new Label("element2","Gold: ".$dataAPI->getData($player,"Gold"))
        ],function (Player $player,CustomFormResponse $response):void {

        });
    }

}