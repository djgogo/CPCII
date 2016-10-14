<?php

class ShoppingCartGateway2Test extends FixtureTestCase
{
    public $fixtures = array(
        'shoppingCart'
    );

    function testReadDatabase()
    {
        $conn = $this->getConnection()->getConnection();

        // fixtures auto loaded, let's read some data
        $query = $conn->query('SELECT * FROM shoppingCart');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(2, count($results));

        // now delete them
        $conn->query('DELETE FROM shoppingCart');

        $query = $conn->query('SELECT * FROM shoppingCart');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(0, count($results));

        // now reload them
        $ds = $this->getDataSet(array('shoppingCart'));
        $this->loadDataSet($ds);

        $query = $conn->query('SELECT * FROM shoppingCart');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(2, count($results));
    }

}
