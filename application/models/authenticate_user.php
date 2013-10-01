<?php

//require_once("data_access_object.php");

class Authenticate_user extends CI_Model
{
    private $m_dao;
    
    function __construct()
    {
        parent::__construct();    // Call the Model constructor  
        $m_dao = $this->data_access_object;
        $m_dao->setTableName("user");
    }
    
    function authenticateUser( $username, $password )
    {
        $m_dao->checkIsString($username);
        $m_dao->checkStringIsValid($username);
        
        $m_dao->checkIsString($password);
        
        //$m_dao->getWhere();
    }
    
    // pre: username must be a non empty string
    function userExists( $username )
    {
        $user_exists = false;
        
        $m_dao->checkIsString($username);
        $m_dao->checkStringIsValid($username);
        
        $where_array["username"] = $username;
        $result = $m_dao->getWhere($where_array);
        
        if( $result !== false )
        {
            $user_exists = false;
        }    
        return $user_exists;
    }
    
    
}

?>
