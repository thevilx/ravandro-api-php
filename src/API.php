<?php
namespace Thevil\RavandroApi;

use Thevil\RavandroApi\Massage\ResponseTransformer;

class API {

    /** @var GuzzleHttp\Client */
    protected $httpClient;


    protected $transformer;
    
    public function __construct()
    {
        $this->transformer = new ResponseTransformer();
    }
    
    /**
     * get latest price of all symbols or just givin symbol
     *
     * @param  string $symbol_name
     * @return array
     */
    public function getLatestPrice($symbol_name = null){
        return $this->get("/symbols/latest/price/" , ['symbol' => $symbol_name]);
    }
    
    /**
     * get latest haqiqi hoqoqi data of all symbols or just givin symbol
     *
     * @param  string $symbol_name
     * @return array
     */
    public function getLatestHH($symbol_name = null){
        return $this->get("/symbols/latest/hh/", ['symbol' => $symbol_name]);    
    }
    
        
    /**
     *  get efficiency of one or all symbols based on givin period
     *
     * @param  string $symbol_name
     * @param  string $period
     * @return array
     */
    public function getEfficiency($symbol_name = null , $period = null){
        if(!$symbol_name && !$period) throw new \Exception("symbol_name and period cant be both undefined !");
        return $this->get("/symbols/efficiency/", ['symbol' => $symbol_name , 'period' =>  $period]);    
    }
    
    /**
     * get all symbols names in a list
     *
     * @return array
     */
    public function getSymbolNames(){
        return $this->get("/symbols/list");
    }
    
    /**
     * get symbol table data (epe , pe , etc )
     *
     * @param  string $symbol_name
     * @return array
     */
    public function symbolTableData($symbol_name){
        return $this->get("/symbols/table/" , ['symbol' => $symbol_name]);
    }

    public function symbolHistoryPrice($symbol_name){
        return $this->get("/symbols/history/price" , ['symbol' => $symbol_name]);
    }

    public function symbolHistoryHH($symbol_name){
        return $this->get("/symbols/history/hh", ['symbol' => $symbol_name]);
    }


    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws Exception
     */
    public function get(string $uri, array $query = []): array
    {
        $response = $this->httpClient->request('GET', '/api' . $uri, ['query' => $query]);
        
        return $this->transformer->transform($response);
    }

}