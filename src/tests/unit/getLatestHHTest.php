<?php
use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getLatestHHTest extends TestCase{

    private $client;

    public function setUp():void{
        $this->client = new RavandroClient("13|tk6EKnsjViQ7sGwm8MK9j9GbsYFCwhaMjL3zt73S");
    }

    public function testSingleSymbol(){
        $data = $this->client->getLatestHH("شستا");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function testAllSymbols(){
        $data = $this->client->getLatestHH();
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_wrong_symbol_entry()
    {
        try {
            $this->client->getLatestHH("سشیشسب");
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertSame('{"error":"Symbol Name Not Found !"}', $response->getBody()->getContents());
        }
    }
}