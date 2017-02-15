Mongounit is a PHPUnit extension for test cases that utilize MongoDB as their data source.

[![Latest Stable Version](https://poser.pugx.org/zumba/mongounit/v/stable.png)](https://packagist.org/packages/zumba/mongounit)
[![Build Status](https://secure.travis-ci.org/zumba/mongounit.png)](http://travis-ci.org/zumba/mongounit)

## Requirements

* PHP 5.6+
* PHPUnit 4.0+
* PECL mongodb 1.2+

## Testing

1. Install dependencies `composer install -dev`
1. Run `./bin/phpunit`

## Example use

```php
<?php

class MyMongoTestCase extends \PHPUnit_Framework_TestCase {
	use \Zumba\PHPUnit\Extensions\Mongo\TestTrait;

	/**
	 * Get the mongo connection for this test.
	 *
	 * @return Zumba\PHPUnit\Extensions\Mongo\Client\Connector
	 */
	public function getMongoConnection() {
		// Add your credentials here
		return new \MongoDB\Client();
	}

	/**
	 * Get the dataset to be used for this test.
	 *
	 * @return Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet
	 */
	public function getMongoDataSet() {
		$dataset = new \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet($this->getMongoConnection());
		$dataset->setFixture([
			'some_collection' => [
				['name' => 'Document 1'],
				['name' => 'Document 2']
			]
		]);
		return $dataset;
	}

	public function testRead() {
		$result = $this->getMongoConnection()->test->some_collection->findOne(['name' => 'Document 2']);
		$this->assertEquals('Document 2', $result['name']);
	}

}
```

[See full working example.](https://github.com/zumba/mongounit/blob/master/examples/PizzaTraitTest.php)

## Note about PHP Versions

PHP 5.5 and below are no longer actively supported. If you are using these version, stick with previous versions of mongounit, however it is recommended to stop using these versions of PHP.
