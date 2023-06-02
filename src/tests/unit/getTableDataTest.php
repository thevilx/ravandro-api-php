<?php

use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getTableDataTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new RavandroClient("p6wGHqgnCj97XcqNcY7SKIkEP2bO03NrhRtdWOkk");
    }

    /**@test */ 
    public function test_get_symbol_table_data()
    {
        $data = $this->client->getSymbolTableData("شستا");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_wrong_symbol_entry(){
        try {
            $this->client->getSymbolTableData("سشیشسب");
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertSame('{"error":"Symbol Name Not Found !"}' , $response->getBody()->getContents());
        }
    }

}
