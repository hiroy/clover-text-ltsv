# Text-LTSV

[![Build Status](https://travis-ci.org/hiroy/clover-text-ltsv.png?branch=master)](https://travis-ci.org/hiroy/clover-text-ltsv)

Labeled Tab-separated Values (LTSV; cf. http://ltsv.org/) parser for PHP.

## Install

Using [Composer](http://getcomposer.org/) as a dependency management tool, you can bring `Clover\Text\LTSV` in your environment easily with settings below.

```
{
  "require": {
    "clover/text-ltsv": "1.0.*-dev"
  }
}
```

## Usage

```php
<?php
$ltsv = new Clover\Text\LTSV();

$values = $ltsv->parseLine("hoge:foo\tbar:baz");

$values = $ltsv->parseFile('log.ltsv');

$it = $ltsv->getIteratorFromFile('log.ltsv');
foreach ($it as $values) {
    // do something
}

$ltsv->add('hoge', 'foo')->add('bar', 'baz');
$line = $ltsv->toLine();
```
