<?php


namespace Exchange\api;


use Exchange\Exchange;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class ExchangeDataAPI
{

    /**
     * @var Config
     */
    public static $config;

    /**
     * ExchangeDataAPI constructor.
     */
    public function __construct()
    {
       self::$config = new Config(Exchange::getInstance()->getDataFolder()."config.yml",Config::YAML);
    }

    /**
     * @param Player $player
     * @param string $key
     * @param $value
     */
    public static function addData(Player $player,string $key,$value){
        self::$config->setNested($player->getName().".".$key,self::getData($player,$key)+$value);
        self::$config->save();
        $player->sendMessage(TextFormat::GREEN."Başarıyla $value tane $key alındı");
    }

    /**
     * @param Player $player
     * @param string $key
     * @param $value
     */
    public static function removeData(Player $player,string $key,$value){
        if (self::getData($player,$key) === 0) return;
        self::$config->setNested($player->getName().".".$key,self::getData($player,$key)-$value);
        self::$config->save();
    }

    /**
     * @param Player $player
     * @return bool
     */
    public static function hasData(Player $player){
        if (self::$config->get($player->getName())){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param Player $player
     */
    public static function createData(Player $player){
        self::$config->set($player->getName(),[
            "Gold" => 0,
            "Dolar" => 0,
            "Euro" => 0
        ]);
        self::$config->save();
    }

    /**
     * @param Player $player
     * @param string $value
     * @return mixed|null
     */
    public static function getData(Player $player,string $value){
        return self::$config->getNested($player->getName().".".$value);
    }


}