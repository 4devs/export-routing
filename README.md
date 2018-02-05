# Export routing
[![Build Status](https://travis-ci.org/4devs/export-routing.svg?branch=master)](https://travis-ci.org/4devs/export-routing)

export symfony routing to js/json

If you use with js, you could use npm package [fos-routing](https://www.npmjs.com/package/fos-routing)!

## Installation
Export routing uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `export-routing` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.


```bash
composer require fdevs/export-routing
```

## Export your routes

```php
<?php
use FDevs\ExportRouting\Normalizer\RouteCollectionNormalizer;
use FDevs\ExportRouting\Normalizer\RouteNormalizer;
use FDevs\ExportRouting\Normalizer\RouteExtractorNormalizer;
use FDevs\ExportRouting\Encoder\JsCallbackEncoder;
use FDevs\ExportRouting\RoutesExtractor;
use FDevs\ExportRouting\Extractor\ChainExposed;
use FDevs\ExportRouting\Extractor\OptionExposed;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

$router = ;//get your routes Symfony\Component\Routing\RouterInterface
$exposed = new ChainExposed([new OptionExposed()]);
$extractor = new RoutesExtractor($router,$exposed);

$normalizers = [
  new RouteCollectionNormalizer(),
  new RouteNormalizer(),
  new RouteExtractorNormalizer(),
  //your normalizers
];
$encoders = [
  new JsCallbackEncoder(),
  new JsonEncoder(),
  //your encoders
];

$serializer = new Serializer(normalizers, encoders);

echo $serializer->serialize(extractor,'js',['callback' => 'initRouting']);//js with callback
echo $serializer->serialize(extractor,'json');//json
```


## Use with Symfony Framework Bundle

 - add `FDevs\ExportRouting\FDevsExportRoutingBundle` to you kernel


## Use command
Create your application with [Console Component](https://symfony.com/doc/master/components/console.html)

###Add Command

```php
 // ...
$serializer = new Serializer(\**\);//init serializer
$extractor = new RoutesExtractor(\**\);//init extractor
$application->add(new DumpCommand($serializer,$extractor,'fdevs:dump-routing:dump'));
```

###Run Command
```bash
bin/console fdevs:dump-routing:dump
```
