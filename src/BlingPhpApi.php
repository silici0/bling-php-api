<?php namespace silici0\BlingPhpApi;

use Noodlehaus\Config;
use silici0\BlingPhpApi\PedidosList;

class BlingPhpApi {
    
    private $config;
    private $pedidos;

    public function __construct($path = null)
    {
        if (!is_null($path))
            $this->config = Config::load($path.'config-bling.json');
        else
            $this->config = Config::load('config-bling.json');
    }

    public function getPedidos()
    {
        return new PedidosList($this->config);
    }
}