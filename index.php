<?php

require 'vendor/autoload.php';

use Thevil\RavandroApi\RavandroClient;

$client = new RavandroClient("3|ciIDGbiBFuZdUQyJPKNhH8GxxKWcFNhoIpRMGCP3");

var_dump($client->getLatestHH());