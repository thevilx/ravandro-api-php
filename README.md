# Official Ravandro API For PHP
Official Ravandro API wrapper 

## • Installation

Latest version: 1.0.0

`composer require thevil/ravandro-api`

## • Ravandro API Documentation

For complete API documentation, up-to-date parameters, responses and errors, please refer to  [Ravandro API Document](https://ravandro.com/api-document) .

## • Quick Start Example

```php
//1. Create Ravandro Client
$client = \Thevil\RavandroApi\RavandroClient("YOUR_TOKEN");
$client->getSymbolList();

```