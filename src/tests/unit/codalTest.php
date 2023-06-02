<?php

use PHPUnit\Framework\TestCase;
use Thevil\RavandroApi\RavandroClient;

class codalTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new RavandroClient("p6wGHqgnCj97XcqNcY7SKIkEP2bO03NrhRtdWOkk");
    }

    public function test_get_codal_symbol_list()
    {
        $data = $this->client->getCodalSymbolList();

        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }


    public function test_get_codal_symbol_statement_only_main()
    {
        $data = $this->client->getCodalSymbolStatements("شستا", true);

        $this->assertTrue(isset($data[0]['TracingNo']));
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_symbol_statement_only_not_main()
    {
        $data = $this->client->getCodalSymbolStatements("شستا", false);


        $this->assertTrue(isset($data[0]['TracingNo']));
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_symbol_statement()
    {
        $data = $this->client->getCodalSymbolStatements("شستا");

        $this->assertTrue(isset($data[0]['TracingNo']));
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_statement_data()
    {
        $data = $this->client->getCodalStatement("849304");

        $this->assertEquals($data['Symbol'] , 'شستا');
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_statement_data_with_selected_category()
    {
        $data = $this->client->getCodalStatement("849304" , 'incomeStatement');
   
        $this->assertEquals($data['Symbol'] , 'شستا');
        $this->assertIsArray($data['items']);
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_statement_data_with_selected_category_with_key()
    {
        $data = $this->client->getCodalStatement("708578" , 'incomeStatement' , 'درآمدهای عملیاتی');
        

        $this->assertEquals($data['Symbol'] , 'شستا');
        $this->assertEquals($data['items'][0]['target'], 'درآمدهای عملیاتی');
        $this->assertIsArray($data);
        $this->assertTrue(!empty($data));
    }

    public function test_get_codal_statement_data_with_key_without_category()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('you cant send key without category !');

        $data = $this->client->getCodalStatement("708578" , NULL , 'درآمدهای عملیاتی');
    }

}
