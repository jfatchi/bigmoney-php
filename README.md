BigMoney
=================

Master: [![Build Status]

Introduction
------------
BigMoney allows you to access easy to BigMoney APIs

Example usage
-------------
```php
$bmoney = new BigMoney/BigMoney(YOUR_SECRET_KEY, YOUR_SECRET_PASSWORD);
$bmoney->Deposit()->request([
	'amount' => 10
	'uid' => 23,
	'tid' => 123
]);
```
