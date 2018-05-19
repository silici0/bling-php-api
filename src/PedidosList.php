<?php namespace silici0\BlingPhpApi;

use Elliotchance\Iterator\AbstractPagedIterator;
use Curl\Curl;

class PedidosList extends AbstractPagedIterator {

    protected $totalSize =0;
    private $curl;
    private $conf;

    public function __construct($conf)
    {
        $this->conf = $conf;
        $this->curl = new Curl();
        $this->getPage(0);
    }


    public function getTotalSize()
    {
        return $this->totalSize;
    }
    public function getPageSize()
    {
        return 100;
    }

    public function getPage($pageNumber)
    {
        $this->curl->setHeader('accept', 'application/json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->searchTerms['apikey'] = $this->conf->get('apiKey');
        $this->curl->get('https://bling.com.br/Api/v2/pedidos/page='.($pageNumber+1).'/json?'.http_build_query($this->searchTerms));
        if ($this->curl->error)
            return $this->curl;
        else {
            $result = json_decode($this->curl->response, true);
            // var_dump($result);
            // $this->totalSize = $result->paging->total;
            return $result['retorno']['pedidos'];
        }
    }
}