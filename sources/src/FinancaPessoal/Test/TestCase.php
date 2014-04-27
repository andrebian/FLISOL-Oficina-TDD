<?php

namespace FinancaPessoal\Test;

use PHPUnit_Framework_TestCase as PHPUnit;
use Mockery;


class TestCase extends PHPUnit
{

    protected $em;
  
    public function setUp()
    {
        $this->em = $this->getEm();
        
        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->em);
        
        parent::tearDown();
    }
    
    public function getEm()
    {
        $em = Mockery::mock('Doctrine\ORM\EntityManager');
        
        $em->shouldReceive('persist')->andReturn($em);
        $em->shouldReceive('flush')->andReturn($em);
        $em->shouldReceive('remove')->andReturn($em);
        
        return $em;
    }
}
