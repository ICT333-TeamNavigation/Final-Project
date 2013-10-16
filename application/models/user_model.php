<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class User_model extends CI_Model
{
    private $m_username = null; 
        
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
    }
    
    //--------------------------------------------------------------------------
    
    public function setUsername( $username )
    {
        $this->data_access_object->checkIsString(COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username);
        
        $this->m_username = $username;
    }
        
    //--------------------------------------------------------------------------
    
        
    // pre:    username must be set
    // post:   returns true if the user exists in the database and false otherwise
    public function userExists()
    {
        $user_exists = true;
        if( $this->getUser() === false )
        {
            $user_exists = false;
        }
        return $user_exists;    
    }
    
    //--------------------------------------------------------------------------
    
    // pre:    username must be set and password must be non empty string
    // pre:    username must exist in the database
    // post:   returns true if the user password is correct and false otherwise
    public function isCorrectPassword( $password )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        }
        $this->data_access_object->checkIsString(COL_PASSWORD , $password);
        $this->data_access_object->checkStringIsValid(COL_PASSWORD, $password);
                      
        $this->data_access_object->setTableName(TABLE_USER);
        $where_array[COL_USERNAME] = $this->m_username;
        $result = $this->data_access_object->getWhere($where_array);
        if($result === false)
        {
            throw new Exception("Username does not exist in database");
        }
        
        $result = $result[0];  // get first row only
                
        $passwordCorrect = false;
        // check user inputted password equals database password
        if( $result[COL_PASSWORD] == $password )
        {
            $passwordCorrect = true;
        }
        
        return $passwordCorrect;
    }
    
    
    
    //--------------------------------------------------------------------------
    // private functions
    //--------------------------------------------------------------------------
    
    private function getUser()
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->setTableName(TABLE_USER);
        $where_array[COL_USERNAME] = $this->m_username;
        $result = $this->data_access_object->getWhere($where_array);
        if( $result !== false )
        {
            $result = $result[0];  // get first row
        }    
        return $result; 
    }
    
    
    //--------------------------------------------------------------------------
    
}

?>
