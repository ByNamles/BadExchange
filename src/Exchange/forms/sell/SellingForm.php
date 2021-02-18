<?php


namespace Exchange\forms\sell;


use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Input;
use dktapps\pmforms\element\Label;
use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class SellingForm extends CustomForm
{
    public $type, $jsonAPI, $player, $buy_or_sell,$dataAPI;

    public function __construct(string $type, string $buy_or_sell, ExchangeJsonAPI $jsonAPI, Player $player,ExchangeDataAPI $dataAPI)
    {
        $this->type = $type;
        $this->jsonAPI = $jsonAPI;
        $this->player = $player;
        $this->buy_or_sell = $buy_or_sell;
        $this->dataAPI = $dataAPI;
        $count = $this->dataAPI->getData($player,$this->type);
        parent::__construct($this->type." Satış",[
            new Label("element0","$this->type satış fiyatı: ".$this->jsonAPI->getTyped($this->type,$this->buy_or_sell)),
            new Label("element1","Satabileceğin $this->type miktarı: $count"),
            new Input("element2","Satıcağın $this->type miktarı: ","örn:2")
        ],function (Player $player,CustomFormResponse $response)use ($count):void {
            $e2 = $response->getString("element2");
            if (!is_numeric($e2)) {
                $player->sendMessage("§8[§cX§8] §7Please enter a numeric value!");
                return;
            }
            if ($e2 <= 0) {
                $player->sendMessage("§8[§cX§8] §7Please enter positive value!");
                return;
            }
            if ($count <= 0){
                $player->sendMessage("§8[§cX§8] §7You don't have any $this->type");
                return;
            }

            $money = $e2 * $this->jsonAPI->getTyped($this->type,$this->buy_or_sell);
            $this->dataAPI->removeData($player,$this->type,$e2);
            EconomyAPI::getInstance()->addMoney($player,$money);
            $player->sendMessage("§8[§a√§8] §a Successfully exchanged $e2 $this->type coins\nGain: $money TL");
        });
    }

}