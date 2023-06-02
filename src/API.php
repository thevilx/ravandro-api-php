<?php

namespace Thevil\RavandroApi;

use Thevil\RavandroApi\Massage\ResponseTransformer;

class API
{

    /** @var GuzzleHttp\Client */
    protected $httpClient;


    protected $transformer;

    public function __construct()
    {
        $this->transformer = new ResponseTransformer();
    }

    /**
     * get list of all supported tse symbol
     *
     * 
     * @return array
     */
    public function getSymbolList()
    {
        return $this->get("/tse/symbols/list");
    }

    /**
     * get latest price of all symbols or just givin symbol
     *
     * @param  null|string $symbol_name
     * @return array
     */
    public function getLatestPrice(string $symbol_name = null)
    {
        return $this->get("/tse/symbols/latest/price/", ['symbol_name' => $symbol_name]);
    }

    /**
     * get latest haqiqi hoqoqi data of all symbols or just givin symbol
     *
     * @param  null|string $symbol_name
     * @return array
     */
    public function getLatestHH(string $symbol_name = null)
    {
        return $this->get("/tse/symbols/latest/hh/", ['symbol_name' => $symbol_name]);
    }


    /**
     *  get efficiency of one or all symbols based on givin period
     *
     * @param  null|string $symbol_name
     * @param  null|string $period
     * @return array
     */
    public function getEfficiency(string $symbol_name = null, string $period = null)
    {
        return $this->get("/tse/symbols/efficiency/", ['symbol_name' => $symbol_name, 'period' =>  $period]);
    }


    /**
     * get symbol table data (epe , pe , etc )
     *
     * @param  string $symbol_name
     * @return array
     */
    public function getSymbolTableData(string $symbol_name)
    {
        return $this->get("/tse/symbols/table/", ['symbol_name' => $symbol_name]);
    }

    /**
     * price history of a symbol such as ( close_price , volume , ...)
     *
     * @param  string $symbol_name
     * @return array
     */
    public function getSymbolHistoryPrice(string $symbol_name)
    {
        return $this->get("/tse/symbols/history/price", ['symbol_name' => $symbol_name]);
    }

    /**
     * price history of a symbol Haqiqi Hoqoqi data such as ( indv_buy_vol , none_indv_buy_val , ...)
     *
     * @param  string $symbol_name
     * @return array
     */
    public function getSymbolHistoryHH(string $symbol_name)
    {
        return $this->get("/tse/symbols/history/hh", ['symbol_name' => $symbol_name]);
    }


    /**
     * a list of all supported symbols for other codal functions which takes symbol_name as argument
     *
     * @return array
     */
    public function getCodalSymbolList()
    {
        return $this->get("/codal/symbols/list");
    }

    /**
     * gets a symbol all Tracing Numbers available with Title & PeriodEndToDate & ...
     *
     * 
     * @param string $symbol_name
     * @param boolean $is_main_company
     * @return array
     */
    public function getCodalSymbolStatements(string $symbol_name, bool $is_main_company = NULL)
    {
        $query = ["symbol_name" => $symbol_name,];

        if(isset($is_main_company))
            $query['is_main_company'] = $is_main_company ? "1" : "0";

        return $this->get("/codal/symbols/statements", $query);
    }

    /**
     * gets a symbol all Tracing Numbers available with Title & PeriodEndToDate & ...
     *
     * 
     * @return array
     */
    public function getCodalStatement(string $tracing_number, string $category = NULL, string $key = NULL)
    {
        if($key && !$category)
            throw new \Exception("you cant send key without category !");

        return $this->get("/codal/statement", [
            "tracing_number" => $tracing_number,
            "category" => $category,
            "key" => $key,
        ]);
    }


    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws Exception
     */
    private function get(string $uri, array $query = []): array
    {
        $response = $this->httpClient->request('GET', '/api' . $uri, ['query' => $query]);

        return $this->transformer->transform($response);
    }
}
