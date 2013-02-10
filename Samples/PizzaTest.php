<?php

class PizzaTest extends \PHPUnit\Extensions\Mongo\TestCase {

	protected $connection;

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
		$dataset = new PHPUnit\Extensions\Mongo\DataSet\DataSet($this->getConnection());
		$dataset->setFixture($this->fixture);
		return $dataset;
	}

	public function testSizes() {
		$this->assertCount(2, $this->getConnection()->collection('orders')->find());
		$this->assertCount(1, $this->getConnection()->collection('orders')->find(array(
			'size' => 'medium'
		)));
	}

}