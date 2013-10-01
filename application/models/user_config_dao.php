<?php

require_once("data_access_object.php");

class User_config_dao extends Data_access_object
{
    const TABLE_NAME = "user_config";
    const USERNAME_COL_NAME = "username"; 
    const ATTRIBUTE_NAME_COL_NAME = "attribute_name"; 
    const VALUE_COL_NAME = "value"; 
    
    //--------------------------------------------------------------------------
    
    function __construct()
    {
        parent::__construct(self::TABLE_NAME); // Call the Model constructor
    }

    //--------------------------------------------------------------------------
    
    // get a single user config attribute row
    // may return false if no data is found in table
    // $username        - string
    // $attribute_name  - string
    function getRow( $username, $attribute_name )
    {   
        parent::checkIsString( self::USERNAME_COL_NAME, $username );
        parent::checkStringIsValid( self::USERNAME_COL_NAME, $username );
        
        parent::checkIsString( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        parent::checkStringIsValid( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
                       
        $where_array[self::USERNAME_COL_NAME] = $username;
        $where_array[self::ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
        $result_array = parent::getWhere( $where_array );
        
        if( $result_array === false )
        {
            $result_row = false;
        }
        else 
        {
            $result_row = $result_array[0];
        }
     
        // may return false if no data is found in table
        return $result_row;
    }
           
    //--------------------------------------------------------------------------
    
    // insert a single user config attribute row
    // $username        - string
    // $attribute_name  - string
    // $value           - string
    function insertRow( $username, $attribute_name, $value )
    {   
        parent::checkIsString( self::USERNAME_COL_NAME, $username );
        parent::checkStringIsValid( self::USERNAME_COL_NAME, $username );
        
        parent::checkIsString( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        parent::checkStringIsValid( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        
        parent::checkIsString( self::VALUE_COL_NAME, $value );
        parent::checkStringIsValid( self::VALUE_COL_NAME, $value );
                       
        $insert_array[self::USERNAME_COL_NAME] = $username;
        $insert_array[self::ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
        $insert_array[self::VALUE_COL_NAME] = $value;
        
        $success = parent::insert( $insert_array );
        
        return $success;
    }
           
    //--------------------------------------------------------------------------
    
    // Update a single user config attribute row
    // $username        - string
    // $attribute_name  - string
    // $value           - string
    function updateRow( $username, $attribute_name, $value )
    {   
        parent::checkIsString( self::USERNAME_COL_NAME, $username );
        parent::checkStringIsValid( self::USERNAME_COL_NAME, $username );
        
        parent::checkIsString( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        parent::checkStringIsValid( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        
        parent::checkIsString( self::VALUE_COL_NAME, $value );
        parent::checkStringIsValid( self::VALUE_COL_NAME, $value );
                       
        $update_array[self::USERNAME_COL_NAME] = $username;
        $update_array[self::ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
        $update_array[self::VALUE_COL_NAME] = $value;
        
        $where_array[self::USERNAME_COL_NAME] = $username;
        $where_array[self::ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
               
        $success = parent::updateWhere( $update_array, $where_array );
        
        return $success;
    }
           
    //--------------------------------------------------------------------------
        
    // Delete a single user config attribute row
    // $username        - string
    // $attribute_name  - string
    // $value           - string
    function deleteRow( $username, $attribute_name )
    {   
        parent::checkIsString( self::USERNAME_COL_NAME, $username );
        parent::checkStringIsValid( self::USERNAME_COL_NAME, $username );
        
        parent::checkIsString( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
        parent::checkStringIsValid( self::ATTRIBUTE_NAME_COL_NAME, $attribute_name );
               
        $where_array[self::USERNAME_COL_NAME] = $username;
        $where_array[self::ATTRIBUTE_NAME_COL_NAME] = $attribute_name;
               
        $success = parent::deleteWhere( $where_array );
        
        return $success;
    }
    
    //--------------------------------------------------------------------------
       
} // end of class User_config_model



?>
