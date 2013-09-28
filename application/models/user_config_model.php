<?php


class User_config_model extends CI_Model 
{
    const USER_CONFIG_TABLE_NAME = "user_config";
    
    const USERNAME_COL_NAME = "username"; 
    const ATTRIBUTE_NAME_COL_NAME = "attribute_name"; 
    const VALUE_COL_NAME = "value"; 
    
    //--------------------------------------------------------------------------
    
    function __construct()
    {
        parent::__construct(); // Call the Model constructor
        $this->load->database();
    }

    //--------------------------------------------------------------------------
    
    // get a single user config attribute
    // may return null if no data is found in table
    function get_user_config_value( $username, $attribute_name )
    {   
        // removes white space and converts input values to strings 
        // if the value is another datatype
        $username       = trim($username);
        $attribute_name = trim($attribute_name);
        
        // validate inputs
        if( $username == NULL || $username == "" )
        {
            throw new Exception( USERNAME_COL_NAME . " is empty or null.");
        }
        if( $attribute_name == NULL || $attribute_name == "" )
        {
            throw new Exception( ATTRIBUTE_NAME_COL_NAME . " is empty or null.");
        }
                
        $where_array[USERNAME_COL_NAME] = $username;
        $where_array[ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
        $query = $this->db->get_where( TABLE_NAME, $where_array );
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        // may return null if no data is found in table
        return $query->result_array();
    }
    
    //--------------------------------------------------------------------------
        
    // get all user config attributes for a single user
    // may return null if no data is found in table
    function get_user_config( $username )
    {
        // removes white space and converts input value to a string 
        // if the value is another datatype
        $username = trim($username);
        
        // validate input
        if( $username == NULL || $username == "" )
        {
            throw new Exception(USERNAME_COL_NAME . " is empty or null.");
        }
                        
        $where_array[USERNAME_COL_NAME] = $username;
        $query = $this->db->get_where( TABLE_NAME, $where_array );
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        // may return null if no data is found in table
        return $query->result_array();
    }
    
    //--------------------------------------------------------------------------
    
    // get user config settings for all users ( the whole table )
    // may return null if no data is found in table
    function get_user_configs()
    {
        $query = $this->db->get( TABLE_NAME );
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        // may return null if no data is found in table
        return $query->result_array();
    }
 
    
} // end of class User_config_model



?>
