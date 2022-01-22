<?php

use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getEfficiencyTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new RavandroClient("13|tk6FsfjViQ9Gwm8Md9j9GSapYFCwhJaMjZL3t73S");
    }

    public function test_only_symbol()
    {
        $data = $this->client->getEfficiency("شستا");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_only_period()
    {
        $data = $this->client->getEfficiency(null , "6 month");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_no_option_entered(){
        try {
           $this->client->getEfficiency();
        } catch (\Exception $e) {
            $this->assertSame('symbol_name and period cant be both undefined !',$e->getMessage());
        }
    }

    public function test_both_symbol_and_period(){
        $data = $this->client->getEfficiency("شستا", "6 month");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_wrong_symbol_entry()
    {
        try {
            $this->client->getEfficiency("اشتباه");
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertSame('{"error":"Symbol Name Not Found !"}', $response->getBody()->getContents());
        }
    }

    public function test_wrong_period_entry()
    {
        try {
            $this->client->getEfficiency("اشتباه" , "6 months");
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertSame('{"error":"period is not valid !"}', $response->getBody()->getContents());
        }
    }
    
}
