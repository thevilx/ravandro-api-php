<?php

namespace Thevil\RavandroApi;

use GuzzleHttp\Client;
use Thevil\RavandroApi\API;

class RavandroClient extends API{

    protected const BASE_URI = 'https://www.ravandro.com';

  
    protected $key;

    public function __construct(string $key)
    {
        parent::__construct();

        $this->key = $key;
        $this->httpClient = new Client(['base_uri' => self::BASE_URI , 
        'headers' => ['Authorization' => "Bearer $key" , 'Accept' => 'application/json']]);
    }

}