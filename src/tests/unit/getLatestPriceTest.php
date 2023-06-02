<?php
use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getLatestPriceTest extends TestCase{

    private $client;

    public function setUp():void{
        $this->client = new RavandroClient("p6wGHqgnCj97XcqNcY7SKIkEP2bO03NrhRtdWOkk");
    }

    public function testSingleSymbol(){
        $data = $this->client->getLatestPrice("شستا");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function testAllSymbols(){
        $data = $this->client->getLatestPrice();
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_wrong_symbol_entry()
    {
        try {
            $this->client->getLatestPrice("سشیشسب");
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertSame('{"error":"Symbol Name Not Found !"}', $response->getBody()->getContents());
        }
    }

}