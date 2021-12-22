<?php
namespace Thevil\RavandroApi;

use Thevil\RavandroApi\Massage\ResponseTransformer;

class API {

    protected $httpClient;


    /** @var ResponseTransformer */
    protected $transformer;
    
    public function __construct()
    {
        $this->transformer = new ResponseTransformer();
    }

    public function getLatestPrice(){
        return $this->get("/symbols/latest/price");
    }

    public function getLatestHH(){
        return $this->get("/symbols/latest/hh");    
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