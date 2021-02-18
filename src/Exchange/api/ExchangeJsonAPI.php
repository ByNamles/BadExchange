<?php


namespace Exchange\api;

use function json_decode;


class ExchangeJsonAPI
{
    /** @var mixed $api */
      private $api;

    /**
     * ExchangeJsonAPI constructor.
     * @param string $link
     */
      public function __construct(string $link)
      {
          $arrContextOptions = array(
              "ssl"=>array(
                  "verify_peer"=>false,
                  "verify_peer_name"=>false,
              ),
          );
          $data = file_get_contents($link,false,stream_context_create($arrContextOptions));
          $this->api = json_decode($data,1);

      }

    /**
     * @param string $type
     * @param string $buy_or_sell
     * @return float|int
     */
      public function getTyped(string $type,string $buy_or_sell){
          if ($type === "Dolar" and $buy_or_sell === "Buying") return $this->getBuyDolar();
          if ($type === "Dolar" and $buy_or_sell === "Sales") return $this->getSellDolar();
          if ($type === "Gold" and $buy_or_sell === "Buying") return $this->getBuyGold();
          if ($type === "Gold" and $buy_or_sell === "Sales") return $this->getSellGold();
          if ($type === "Euro" and $buy_or_sell === "Buying") return $this->getBuyEuro();
          if ($type === "Euro" and $buy_or_sell === "Sales") return $this->getSellEuro();
      }

    /**
     * @return int | float
     */
      public function getSellGold(){
      return $this->api["Çeyrek Altın"]["Satış"];
      }

    /**
     * @return int | float
     */
      public function getSellDolar(){
          return $this->api["ABD DOLARI"]["Satış"];
      }

    /**
     * @return int | float
     */
      public function getSellEuro(){
          return $this->api["EURO"]["Satış"];
      }
    /**
     * @return int | float
     */
    public function getBuyGold(){
        return $this->api["Çeyrek Altın"]["Alış"];
    }

    /**
     * @return int | float
     */
    public function getBuyDolar(){
        return $this->api["ABD DOLARI"]["Alış"];
    }

    /**
     * @return int | float
     */
    public function getBuyEuro(){
        return $this->api["EURO"]["Alış"];
    }



}