<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Data_access_object extends CI_Model  
{
    private $m_table_name = null;
    
    // the names of the columns that need to be converted to ints 
    // after getting from the data from the database
    // unfortunately CodeIgniter's Active Record returns all columns as strings
    // regardless of their datatype in the database
    private static $int_col_names = array( "model_id", 
                                           "study_id",
                                           "scenario_id",
                                           "node_id",
                                           "link_node_id",
                                           "default_value",
                                           "min_value",
                                           "max_value",
                                           "visible",
                                           "visible_default" );
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor
        $this->load->database();
    }
    
    //--------------------------------------------------------------------------
    
    public function setTableName( $table_name )
    {
        $this->m_table_name = $table_name;
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkIsString( $col_name, $col_value )
    {
        if( !is_string($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not a string.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkIsInt( $col_name, $col_value )
    {
        if( !is_int($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not an int.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkIsFloat( $col_name, $col_value )
    {
        if( !is_float($col_value) )
        {
            throw new Exception( "Wrong datatype: " . $col_name . " is not a float.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkNumberIsValid( $col_name, $col_value )
    {
        if( $col_value < 0 )
        {
            throw new Exception( "Number is invalid: " . $col_name . " can not be less than zero.");
        }    
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkStringIsValid( $col_name, $col_value )
    {
        $col_value = trim($col_value);
        if( $col_value == "" )
        {
            throw new Exception( "String is invalid: " . $col_name . " is empty.");
        }  
    }
    
    //--------------------------------------------------------------------------
    
    public static function checkIsArray( $where_array )
    {
        if( !is_array($where_array) )
        {
            throw new Exception( "Invalid datatype: variable where_array must be an array.");
        }
    }
    
    //--------------------------------------------------------------------------
    
    
    // converts the values in the result row to integers if the key is found
    // in a list of column names
    public static function convertRowToInt( $result_row )
    {
        foreach($result_row as $fieldName => $value)
        {
            // if is a table column defined as int
            if( array_search( $fieldName , self::$int_col_names) !== false )
            {
                $result_row[$fieldName] = (int)$value;
            }
        }    
        
        return $result_row;
    }
    
        
    //--------------------------------------------------------------------------
   
    
    public function getWhere( $where_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }    
        
        self::checkIsArray( $where_array );
        
        $query = $this->db->get_where( $this->m_table_name, $where_array );
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
                
        if( $query->num_rows() <= 0 )
        {
            return false;
        }
        $result = $query->result_array();
        
        // converts the values in the result array to integers if the key is found
        // in a list of column names
        $i = 0;
        foreach($result as $result_row)
        {
            $result[$i] = self::convertRowToInt($result_row);
            $i++;
        }    
        
        // returns false if no data is found in table
        return $result;
    }
    
    //--------------------------------------------------------------------------
    
    
    public function insert( $insert_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }  
        
        self::checkIsArray( $insert_array );
        
        $success = $this->db->insert($this->m_table_name, $insert_array); 
        if( !$success )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return($success);
    }        
  
    //--------------------------------------------------------------------------
    
    public function updateWhere( $update_array, $where_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }  
        
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
    
    
    public function deleteWhere( $where_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }  
        
        self::checkIsArray( $where_array );
        
        $success = $this->db->delete($this->m_table_name, $where_array );
        if( !$success )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return($success);
    }
    

    //--------------------------------------------------------------------------
    
    // get the whole table. 
    public function getAllRows()
    {
        return $this->getWhere(Array());
    }
    
    //--------------------------------------------------------------------------
    
    
    // executes a general select on the database and returns the results as an
    // array or false if no results were found
    public function doSelect( $sql, $parms_array = null )
    {
        self::checkIsString("sql" , $sql);
        self::checkStringIsValid("sql", $sql);
        
        $query = $this->db->query($sql, $parms_array );
        if ( $query->num_rows() <= 0 )  // if no search results found
        {
            return false;
        }
        $result = $query->result_array();
        
        // converts the values in the result array to integers if the key is found
        // in a list of column names
        $i = 0;
        foreach($result as $result_row)
        {
            $result[$i] = self::convertRowToInt($result_row);
            $i++;
        }    
                    
        return $result; 
    }        
    
    //--------------------------------------------------------------------------

}

?>
