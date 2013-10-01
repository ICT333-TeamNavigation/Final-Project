<?php


class Data_access_object extends CI_Model  
{
    private $m_table_name;
    
    //--------------------------------------------------------------------------
    
    function __construct()
    {
        //$this->m_table_name = $t_name; 
        parent::__construct(); // Call the Model constructor
        $this->load->database();
    }
    
    //--------------------------------------------------------------------------
    
    function setTableName( $t_name )
    {
        $this->m_table_name = $t_name;
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkIsString( $col_name, $col_value )
    {
        if( !is_string($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not a string.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkIsInt( $col_name, $col_value )
    {
        if( !is_int($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not an int.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkIsFloat( $col_name, $col_value )
    {
        if( !is_float($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not a float.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkNumberIsValid( $col_name, $col_value )
    {
        if( $col_value < 0 )
        {
            throw new Exception( "Number is invalid: " . $col_name . " can not be less than zero.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkStringIsValid( $col_name, $col_value )
    {
        $col_value = trim($col_value);
        if( $col_value == "" )
        {
            throw new Exception( "String is invalid: " . $col_name . " is empty.");
        }  
    }
    
    //--------------------------------------------------------------------------
    
    protected static function checkIsArray( $where_array )
    {
        if( !is_array($where_array) )
        {
            throw new Exception( "Invalid datatype: variable where_array must be an array.");
        }
    }
    
    
    //--------------------------------------------------------------------------
    
    protected function getWhere( $where_array )
    {
        self::checkIsArray( $where_array );
        
        $query = $this->db->get_where( $this->m_table_name, $where_array );
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
                
        if( $query->num_rows() > 0 )
        {
            $result = $query->result_array();
        }
        else 
        {
            $result = false;
        }
        
        // returns false if no data is found in table
        return $result;
    }
    
    //--------------------------------------------------------------------------
    
    
    protected function insert( $insert_array )
    {
        self::checkIsArray( $insert_array );
        
        $success = $this->db->insert($this->m_table_name, $insert_array); 
        if( !$success )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return($success);
    }        
  
    //--------------------------------------------------------------------------
    
    protected function updateWhere( $update_array, $where_array )
    {
        self::checkIsArray( $update_array );
        self::checkIsArray( $where_array );
        
        $success = $this->db->update($this->m_table_name, $update_array, $where_array);
        if( !$success )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return($success);
    }
    
    //--------------------------------------------------------------------------
    
    
    protected function deleteWhere( $where_array )
    {
        self::checkIsArray( $where_array );
        
        $success = $this->db->delete($this->m_table_name, $where_array );
        if( !$success )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return($success);
    }
    



    //--------------------------------------------------------------------------
    
    // get user config settings for all users ( the whole table )
    // may return null if no data is found in table
    public function getAllRows()
    {
        $query = $this->db->get($this->m_table_name);
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        if( $query->num_rows() > 0 )
        {
            $result = $query->result_array();
        }
        else 
        {
            $result = false;
        }
        
        // returns false if no data is found in table
        return $result;
    }
    
    //--------------------------------------------------------------------------

}

?>
