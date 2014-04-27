<?php

namespace FinancaPessoal\Entity;

use FinancaPessoal\Test\TestCase;

/**
 * @group Entity
 */
class UserTest extends TestCase
{
    protected $entityName;
    protected $entity;

    public function setUp()
    {
        parent::setUp();
        $this->entityName = 'FinancaPessoal\Entity\User';
        $this->entity = new $this->entityName();
    }

    public function tearDown()
    {
        unset($this->entityName, $this->entity);
        parent::tearDown();
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists($this->entityName));
    }
    
    public function testIfMethodToArrayExists()
    {
        $this->assertTrue(method_exists($this->entity, 'toArray'));
    }
    
    public function testIfToArrayIsReturningAnArray()
    {
        $this->assertInternalType('array', $this->entity->toArray());
    }
    
    public function testIfToArrayIsReturningValidArray()
    {
        $result = $this->entity->toArray();
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('password', $result);
    }
    
    public function testIfPasswordHashWasApplied()
    {
        $password = 'senha em plain text';
        $user = new \FinancaPessoal\Entity\User();

        $user->setPassword($password);

        $this->assertNotEquals($password, $user->getPassword());
    }
    
    public function testSetDataAndverifyIntegrity()
    {
        $data = array(
            'name' => 'Seu nome',
            'email' => 'seuemail@domain.com',
            'password' => '12345678',
            'avatar' => 'imagem.png'
        );

        $user = new \FinancaPessoal\Entity\User( $data );
        
        $this->assertNotNull($user);
        $this->assertEquals('Seu nome', $user->getName());
        $this->assertEquals('seuemail@domain.com', $user->getEmail());
        $this->assertNotEquals('12345678', $user->getPassword());
        $this->assertEquals('imagem.png', $user->getAvatar());
    }

}
