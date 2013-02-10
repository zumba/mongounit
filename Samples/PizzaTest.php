<?php

class PizzaTest extends \PHPUnit\Extensions\Mongo\TestCase {

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
			$this->connection = new \PHPUnit\Extensions\Mongo\Client\Connector(new \MongoClient());
			$this->connection->setDb('test');
		}
		return $this->connection;
	}

	public function getDataSet() {
		if (empty($this->dataSet)) {
			$this->dataSet = new PHPUnit\Extensions\Mongo\DataSet\DataSet($this->getConnection());
			$this->dataSet->setFixture($this->fixture);
		}
		return $this->dataSet;
	}

	public function testSizes() {
		$this->assertCount(2, $this->getConnection()->collection('orders')->find());
		$this->assertCount(1, $this->getConnection()->collection('orders')->find(array(
			'size' => 'medium'
		)));
	}

}