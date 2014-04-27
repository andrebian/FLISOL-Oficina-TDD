<?php

namespace FinancaPessoal\Filter;

use FinancaPessoal\Test\TestCase;

/**
 * @group Filter
 */
class FormataMoedaTest extends TestCase
{

    protected $formataMoeda = null;
    
    public function setUp()
    {
        parent::setUp();
        $this->formataMoeda = new \FinancaPessoal\Filter\FormataMoeda();
    }

    public function tearDown()
    {
        unset($this->formataMoeda);
        parent::tearDown();
    }
    
    public function testIfClassExists()
    {
        $this->assertTrue(class_exists('FinancaPessoal\Filter\FormataMoeda'));
    }
    
    public function testIfMethodBrlParaFloatExists()
    {
        $this->assertTrue(method_exists($this->formataMoeda, 'brlParaFloat'));
    }
    
    public function testFilterBrlParaFloat()
    {
        $valorEmReais = 'R$ 23,95';
        
        $result = $this->formataMoeda->brlParaFloat($valorEmReais);
        
        $this->assertNotNull($result);
        $this->assertInternalType('float', $result);
        $this->assertEquals(23.95, $result);
    }
    
    public function testIfMethodFloatPataBrlExists()
    {
        $this->assertTrue(method_exists($this->formataMoeda, 'floatParaBrl'));
    }
    
    public function testFilterFloatParaBrl()
    {
        $valorEmFloat = 125.97;
        
        $result = $this->formataMoeda->floatParaBrl($valorEmFloat);
        
        $this->assertNotNull($result);
        $this->assertInternalType('string', $result);
        $this->assertEquals('R$ 125,97', $result);
    }

}
