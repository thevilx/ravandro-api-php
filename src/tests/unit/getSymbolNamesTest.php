<?php

use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class getSymbolNamesTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new RavandroClient("p6wGHqgnCj97XcqNcY7SKIkEP2bO03NrhRtdWOkk");
    }

    /**@test */
    public function test_get_symbol_table_data()
    {
        $data = $this->client->getSymbolList();

        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

}
