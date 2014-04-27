<?php

namespace FinancaPessoal\Service;

use FinancaPessoal\Test\TestCase;
use Mockery;

/**
 * @group Service
 */
class UserTest extends TestCase
{
    
    protected $serviceName;
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        $this->serviceName = '\FinancaPessoal\Service\User';
        
        $data = array(
            'id' => 1,
            'name' => 'teste',
            'email' => 'teste@teste.com.br',
            'password' => '1234'
        );
        
        $this->em->shouldReceive('getRepository')->andReturn($this->em);
        $this->em->shouldReceive('findById')->andReturn(new \FinancaPessoal\Entity\User($data));
        
        $this->service = new $this->serviceName( $this->em );
    }
    
    public function tearDown()
    {
        parent::tearDown();
        unset($this->serviceName, $this->service);
    }
    
    public function testClassExists()
    {
        $this->assertTrue(class_exists($this->serviceName));
    }
    
    public function testMethodConstructExists()
    {
        $this->assertTrue(method_exists($this->service, '__construct'));
    }
    
    public function testIfMethodSaveExists()
    {
        $this->assertTrue(method_exists($this->service, 'save'));
    }

    public function testIfSaveIsWorkingProperly()
    {
        $data = array(
            'name' => 'teste',
            'email' => 'teste@teste.com.br',
            'password' => '1234'
        );

        $emailCadastro = Mockery::mock('FinancaPessoal\Email\Cadastro');
        $emailCadastro->shouldReceive('envia')->andReturn(true);

        $service = new $this->serviceName($this->em);
        $result = $service->save($data, $emailCadastro);

        $this->assertNotNull($result);
        $this->assertInternalType('object', $result);
        $this->assertInstanceOf('FinancaPessoal\Entity\User', $result);
    }

    public function testIfMethodDeleteExists()
    {
        $this->assertTrue(method_exists($this->service, 'delete'));
    }
    
    public function testIfIsReturningTrueOnDelete()
    {
        $this->assertTrue($this->service->delete(1));
    }

}
