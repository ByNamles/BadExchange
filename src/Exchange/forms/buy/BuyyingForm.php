<?php


namespace Exchange\forms\buy;


use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Input;
use dktapps\pmforms\element\Label;
use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\nbt\ReaderTracker;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class BuyyingForm extends CustomForm
{
    public $type, $jsonAPI, $player, $buy_or_sell,$dataAPI;

    public function __construct(string $type, string $buy_or_sell, ExchangeJsonAPI $jsonAPI, Player $player,ExchangeDataAPI $dataAPI)
    {
        $this->type = $type;
        $this->jsonAPI = $jsonAPI;
        $this->player = $player;
        $this->buy_or_sell = $buy_or_sell;
        $this->dataAPI = $dataAPI;
        $money = EconomyAPI::getInstance()->myMoney($this->player);
        if ($this->jsonAPI->getTyped($this->type, $this->buy_or_sell) != 0) {
            $mm = $money / $this->jsonAPI->getTyped($this->type, $this->buy_or_sell);
            $maks = 0;
            if (strstr($mm, ".")) {
                $maks = explode(".", $mm)[0];
            } else {
                $maks = $mm;
            }
        }

            parent::__construct($this->type . " Alış", [
                new Label("element0", "$type Alış Fiyatı: " . $this->jsonAPI->getTyped($this->type, $this->buy_or_sell) . "\n"),
                new Label("element1", "Alabileceğin $type miktarı: " . $maks . "\n"),
                new Label("element2","Not: Veriler Türkiye Döziz Kuruyla aynıdır."),
                new Input("element3", "Alıcağın $type miktarı: ", "örn:3")
            ], function (Player $player, CustomFormResponse $response) use ($maks): void {
                $e2 = $response->getString("element3");
                if ($maks === 0) {
                    $player->sendMessage("§8[§cX§8] §7You have no money to buy $this->type!");
                    return;
                }
                if (!is_numeric($e2)) {
                    $player->sendMessage("§8[§cX§8] §7Please enter a numeric value!");
                    return;
                }
                if ($e2 <= 0) {
                    $player->sendMessage("§8[§cX§8] §7Please enter positive value!");
                    return;
                }
                if (EconomyAPI::getInstance()->myMoney($player) < $e2*$this->jsonAPI->getTyped($this->type,$this->buy_or_sell)){
                    $player->sendMessage("§8[§cX§8] §7You don't have enough money!");
                }
                $removemoney = $e2*$this->jsonAPI->getTyped($this->type,$this->buy_or_sell);
                EconomyAPI::getInstance()->reduceMoney($player,$removemoney);
                $this->dataAPI->addData($player,$this->type,$e2);
                $player->sendMessage("§8[§a√§8] §a Successfully taken $this->type");
            });
        }

    }
