<?php

use \Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
use \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

class PizzaTraitTest extends \PHPUnit_Framework_TestCase {
	use \Zumba\PHPUnit\Extensions\Mongo\TestTrait;

	const DEFAULT_DATABASE = 'mongounit_test';

	protected $connection;

	protected $dataset;

	protected $fixture = [
		'orders' => [
			['size' => 'large', 'toppings' => ['cheese', 'ham']],
			['size' => 'medium', 'toppings' => ['cheese']]
		]
	];

	public function getMongoConnection() {
		if (empty($this->connection)) {
			$this->connection = new Connector(new \MongoClient());
			$this->connection->setDb(static::DEFAULT_DATABASE);
		}
		return $this->connection;
	}

	public function getMongoDataSet() {
		if (empty($this->dataSet)) {
			$this->dataSet = new DataSet($this->getMongoConnection());
			$this->dataSet->setFixture($this->fixture);
		}
		return $this->dataSet;
	}

	public function testSizesFromFixture() {
		$this->assertCount(2, $this->getMongoConnection()->collection('orders')->find());
		$this->assertCount(1, $this->getMongoConnection()->collection('orders')->find(array(
			'size' => 'medium'
		)));
	}
}
