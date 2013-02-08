# Clover\Text\LTSV

Labeled Tab-separated Values (LTSV; cf. http://ltsv.org/) parser for PHP.

## Usage

```php
<?php
$ltsv = new Clover\Text\LTSV();
$values = $ltsv->parseLine("hoge:foo\tbar:baz");
```
