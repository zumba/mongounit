<?php

use \Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
use \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

/**
 * Class PizzaTraitTest
 */
class PizzaTraitTest extends \PHPUnit_Framework_TestCase {

	use \Zumba\PHPUnit\Extensions\Mongo\TestTrait;

	/**
	 *  Default Database name
	 */
	const DEFAULT_DATABASE = 'mongounit_test';

	/**
	 * @var \Zumba\PHPUnit\Extensions\Mongo\Client\Connector
	 */
	protected $connection;

	/**
	 * @var \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet
	 */
	protected $dataSet;

	/**
	 * @var array
	 */
	protected $fixture = [
		'orders' => [
			['size' => 'large', 'toppings' => ['cheese', 'ham']],
			['size' => 'medium', 'toppings' => ['cheese']]
		],
		'carts' => [
			// Intentionally empty
		],
	];

	/**
	 * @return \Zumba\PHPUnit\Extensions\Mongo\Client\Connector
	 */
	public function getMongoConnection() {
		if (empty($this->connection)) {
			$this->connection = new Connector(new \MongoDB\Client());
			$this->connection->setDb(static::DEFAULT_DATABASE);
		}
		return $this->connection;
	}

	/**
	 * @return \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet
	 */
	public function getMongoDataSet() {
		if (empty($this->dataSet)) {
			$this->dataSet = new DataSet($this->getMongoConnection());
			$this->dataSet->setFixture($this->fixture);
		}
		return $this->dataSet;
	}

	public function testSizesFromFixture() {
		$this->assertSame(2, $this->getMongoConnection()->collection('orders')->count());
		$this->assertCount(1, $this->getMongoConnection()->collection('orders')->find(array(
			'size' => 'medium'
		))->toArray());
	}
}
