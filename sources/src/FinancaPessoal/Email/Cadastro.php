<?php

namespace FinancaPessoal\Email;

class Cadastro 
{

    /**
    * @param array $data
    * @return boolean
    */
    public function envia(array $data)
    {
        $subject = 'Cadastro no sistema de finanças pessoais';
        $content = 'Olá, ' . $data['name'] . '! Você foi cadastrado no sistema ';
        $content .= 'de Finanças Pessoais com o login: ' . $data['email'] . ' ';
        $content .= 'e senha: ' . $data['password'];
        
        return true === mail($data['email'], $subject, $content);
    }
}
