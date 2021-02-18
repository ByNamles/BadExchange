<?php


namespace Exchange;


use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use Exchange\command\ExchangeCommand;
use Exchange\listener\ExchangeListener;
use pocketmine\plugin\PluginBase;

class Exchange extends PluginBase
{

    private static $api;

    public function onEnable()
    {
        self::$api = $this;
        $this->getServer()->getCommandMap()->register("exchange",new ExchangeCommand());
        $this->getServer()->getPluginManager()->registerEvents(new ExchangeListener(new ExchangeJsonAPI("https://finans.truncgil.com/today.json"),new ExchangeDataAPI()),$this);
    }

    public static function getInstance(): ?self{
        return self::$api;
    }

}