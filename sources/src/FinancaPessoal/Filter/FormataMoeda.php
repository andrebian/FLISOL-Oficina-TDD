<?php

namespace FinancaPessoal\Filter;


class FormataMoeda
{
 
    /**
     * 
     * @param string $valor
     * @return float
     */
    public function brlParaFloat( $valor )
    {
        $find = array('R$ ', '.', ',');
        $replace = array('', '', '.');
        
        return (float) str_replace($find, $replace, $valor);
    }
    
    
    /**
     * 
     * @param float $floatNumber
     * @return string
     */
    public function floatParaBrl( $floatNumber )
    {
        $valor = number_format($floatNumber, 2, ',', '.');
        
        return 'R$ ' . $valor;
    }
    
}
