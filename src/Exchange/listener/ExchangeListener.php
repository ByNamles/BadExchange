<?php


namespace Exchange\listener;


use Exchange\api\ExchangeDataAPI;
use Exchange\api\ExchangeJsonAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class ExchangeListener implements Listener
{

  /** @var ExchangeJsonAPI  */
    public $json_api;
    /** @var ExchangeDataAPI  */
    public $data_api;

    public function __construct(ExchangeJsonAPI $json_api,ExchangeDataAPI $data_api)
    {
        $this->json_api = $json_api;
        $this->data_api = $data_api;
    }

    public function onJoin(PlayerJoinEvent $event){
        if (!$this->data_api::hasData($event->getPlayer())){
            $this->data_api::createData($event->getPlayer());
        }
    }



}