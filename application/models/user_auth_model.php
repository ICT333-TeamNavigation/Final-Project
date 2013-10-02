<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

class User_auth_model extends CI_Model
{
    const TABLE_USER   = "user";
    const COL_USERNAME = "username";
    const COL_PASSWORD = "password";
    
    //--------------------------------------------------------------------------
    
    function __construct()
    {
        parent::__construct();    // Call the Model constructor  
        $this->load->model('data_access_object'); 
        $this->data_access_object->setTableName(self::TABLE_USER);
    }
    
    //--------------------------------------------------------------------------
    
    // pre:    username must be a non empty string
    // post:   returns true if the user exists in the database and false otherwise
    function userExists( $username )
    {
        $this->data_access_object->checkIsString(self::COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(self::COL_USERNAME, $username);
                          
        $where_array[self::COL_USERNAME] = $username;
        $result = $this->data_access_object->getWhere($where_array);
        
        $user_exists = false;
        if( $result !== false )
        {
            $user_exists = true;
        }    
        return $user_exists;
    }
    
    
    //--------------------------------------------------------------------------
    
    // pre:    username and password must be non empty strings
    // pre:    username must exist in the database
    // post:   returns true if the user password is correct and false otherwise
    function isCorrectPassword( $username, $password )
    {
        $this->data_access_object->checkIsString(self::COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(self::COL_USERNAME, $username);
        
        $this->data_access_object->checkIsString(self::COL_PASSWORD, $password);
        $this->data_access_object->checkStringIsValid(self::COL_PASSWORD, $password);
        
        $where_array[self::COL_USERNAME] = $username;
        $result = $this->data_access_object->getWhere($where_array);
        $result = $result[0];  // get first row only
        
        if($result === false)
        {
            throw new Exception("Username does not exist in database");
        }
                
        $passwordCorrect = false;
        // check user inputted password equals database password
        if( $result[self::COL_PASSWORD] == $password )
        {
            $passwordCorrect = true;
        }    
        return $passwordCorrect;
    }
    
    
    
    //--------------------------------------------------------------------------
    
    
}

?>
