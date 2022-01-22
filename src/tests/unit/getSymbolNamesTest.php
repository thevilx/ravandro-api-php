<?php

use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getSymbolNamesTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new RavandroClient("13|tk6EKnsjViQ7sGwm8MK9j9GbsYFCwhaMjL3zt73S");
    }

    /**@test */
    public function test_get_symbol_table_data()
    {
        $data = $this->client->getSymbolNames("شستا");
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

}
