<?php
require 'vendor/autoload.php';
 
use Parse\ParseClient;

ParseClient::initialize('xxxx', 'xxxx', 'xxx');

// Don't use this. Should come from php.ini
date_default_timezone_set('Europe/Helsinki');

use Parse\ParseObject;
use Parse\ParseQuery;
 

$collection = new ParseObject("Collection");
$collection->set("collectionId", 123);
$collection->set("iapId", 13413);
$collection->set("name", "Test");
$collection->set("unlockStarLevel", 3);
$collection->set("unlockFameLevel", 2);
$collection->set("gender", '0');
$collection->set("updated", new DateTime());
$collection->save();

$group = new ParseObject("ShopPriceGroup");
$group->set("priceGroupId", 321);
$group->set("price", 13413);
$group->set("modified", new DateTime());
$group->save();

$product = new ParseObject("Product");
$product->set("productId", 666);
$product->set("priceGroupId", 321);
$product->set("categoryId", 555);
$product->set("gender", "0");
$product->set("asset_name", "Test product");
$product->set("collectionId", 123);
$product->set("name", "Namename");
$product->set("popularity", 3);
$product->set("quality", 4);
$product->set("updated", new DateTime());


// object pointers
$priceGroupQuery = new ParseQuery("ShopPriceGroup");
$priceGroupQuery->equalTo("priceGroupId", 321);
$priceGroupResult = $priceGroupQuery->find();

$product->set("shopPriceGroup", $priceGroupResult[0]);

$collectionQuery = new ParseQuery("Collection");
$collectionQuery->equalTo("collectionId", 123);
$collectionResult = $collectionQuery->find();

$product->set("collection", $collectionResult[0]);

$product->save();
