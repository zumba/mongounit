<?php

class PizzaTest extends \Zumba\PHPUnit\Extensions\Mongo\TestCase {

	const DEFAULT_DATABASE = 'mongounit_test';

	protected $connection;

	protected $dataset;

	public function setUp() {
		$this->fixture = array(
			'orders' => array(
				array('size' => 'large', 'toppings' => array('cheese', 'ham')),
				array('size' => 'medium', 'toppings' => array('cheese'))
			)
		);
		parent::setUp();
	}

	public function getConnection() {
		if (empty($this->connection)) {
			$this->connection = new \Zumba\PHPUnit\Extensions\Mongo\Client\Connector(new \MongoClient());
			$this->connection->setDb(static::DEFAULT_DATABASE);
		}
		return $this->connection;
	}

	public function getDataSet() {
		if (empty($this->dataSet)) {
			$this->dataSet = new \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet($this->getConnection());
			$this->dataSet->setFixture($this->fixture);
		}
		return $this->dataSet;
	}

	public function testSizesFromFixture() {
		$this->assertCount(2, $this->getConnection()->collection('orders')->find());
		$this->assertCount(1, $this->getConnection()->collection('orders')->find(array(
			'size' => 'medium'
		)));
	}

}