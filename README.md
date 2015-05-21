Mongounit is a PHPUnit extension for test cases that utilize MongoDB as their data source.

[![Latest Stable Version](https://poser.pugx.org/zumba/mongounit/v/stable.png)](https://packagist.org/packages/zumba/mongounit)
[![Build Status](https://secure.travis-ci.org/zumba/mongounit.png)](http://travis-ci.org/zumba/mongounit)

## Requirements

* PHP 5.5+
* PHPUnit 4.0+
* PECL mongo 1.3+

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
		return new \MongoClient();
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

PHP 5.3 and 5.4 are no longer actively supported. If you are using these version, stick to v1.2.0 of mongounit or below, however it is recommended to stop using these versions of PHP.