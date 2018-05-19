<?php namespace silici0\PedidosList;


use Curl\Curl;

class PedidosList {

    // protected $totalSize =0;
    private $curl;
    private $conf;

    public function __construct($conf)
    {
        $this->conf = $conf;
        $this->curl = new Curl();
    }

    public function getList()
    {
        $this->curl->setHeader('accept', 'application/json');
        $this->curl->setHeader('contet-type', 'application/json');
        // $this->curl->setHeader('x-vtex-api-appkey', $this->conf->get('AppKey'));
        // $this->curl->setHeader('x-vtex-api-apptoken', $this->conf->get('AppToken'));
        $this->searchTerms['apikey'] = $this->conf->get('apiKey');
        // $this->searchTerms['page'] = $pageNumber+1;
        // $this->searchTerms['per_page'] = $this->getPageSize();
        $this->curl->get('https://bling.com.br/Api/v2/pedidos/json?'.http_build_query($this->searchTerms));
        if ($this->curl->error)
            return $this->treatError();
        else {
            $result = json_decode($this->curl->response, true);
            // $this->totalSize = $result->paging->total;
            return $result->list;
        }
    }
}