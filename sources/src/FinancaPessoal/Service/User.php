<?php

namespace FinancaPessoal\Service;

use Doctrine\ORM\EntityManager;
use FinancaPessoal\Entity\User as UserEntity;

class User
{
    protected $em;
    
    public function __construct( \Doctrine\ORM\EntityManager $em ) 
    {
        $this->em = $em;
    }
    
    
    /**
     * @param array $data
     * @param \FinancaPessoal\Email\Cadastro $email
     * @return \FinancaPessoal\Entity\User $user
     */
    public function save(array $data, \FinancaPessoal\Email\Cadastro $email)
    {
        $user = new UserEntity($data);

        $this->em->persist($user);
        $this->em->flush();
        
        if ( $email->envia($data) ) {
            return $user;
        }
    }
    
    /**
     * 
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $user = $this->em->getRepository('FinancaPessoal\Entity\User')->findById($id);
        
        if ( $user ) {
            $this->em->remove($user);
            $this->em->flush();
            return true;
        }
        
        return false;
    }

}
