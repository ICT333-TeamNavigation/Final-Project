<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class ColType
{
    const INT   = 0;
    const BOOL  = 1;
    const FLOAT = 2;
}

class Data_access_object extends CI_Model  
{
    private $m_table_name = null;
   
    
    // the names of the columns that need to be converted to their correct
    // datatypes after getting from the data from the database.
    // unfortunately CodeIgniter's Active Record class returns all columns as strings
    // regardless of their datatype in the database.
    private static $m_col_types = array( COL_MODEL_ID        => ColType::INT, 
                                         COL_STUDY_ID        => ColType::INT,
                                         COL_SCENARIO_ID     => ColType::INT,
                                         COL_NODE_ID         => ColType::INT,     
                                         COL_LINK_NODE_ID    => ColType::INT,       
                                         COL_VISIBLE         => ColType::BOOL,  
                                         COL_VISIBLE_DEFAULT => ColType::BOOL,  
                                         COL_DEFAULT_VALUE   => ColType::FLOAT,
                                         COL_MIN_VALUE       => ColType::FLOAT,  
                                         COL_MAX_VALUE       => ColType::FLOAT );  
        
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
    
    
    // converts the values in the result row to their correct datatypes
    public static function convertDatatypesRow( $result_row )
    {
        foreach($result_row as $col_name => $col_value)
        {
            if ( !isset(self::$m_col_types[$col_name]) )
            {
                continue;
            }
              
            $col_type = self::$m_col_types[$col_name];
            switch($col_type)
            {
                case ColType::INT:
                    $result_row[$col_name] = (int)$col_value;
                    break;
                case ColType::BOOL:
                    $result_row[$col_name] = (bool)$col_value;
                    break;
                case ColType::FLOAT:
                    $result_row[$col_name] = (float)$col_value;
                    break;
            }
        }    
        
        return $result_row;
    }
    
    //--------------------------------------------------------------------------
    
    
    // converts the values in the result array to their correct datatypes  
    public static function convertDatatypes( $result_array )
    {
        $i = 0;
        foreach($result_array as $result_row)
        {
            $result_array[$i] = self::convertDatatypesRow($result_row);
            $i++;
        }    
        
        return $result_array;
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
            return false; // returns false if no data is found in table
        }
                
        $result = self::convertDatatypes($query->result_array());  
        return $result;
    }
    
    //--------------------------------------------------------------------------
    
    // inserts a row into the table
    // returns the number of effected rows  ( should be one on success )
    public function insert( $insert_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }  
        
        self::checkIsArray( $insert_array );
        
        $result = $this->db->insert($this->m_table_name, $insert_array); 
        if( !$result )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
                
        return $this->db->affected_rows();
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
        
        $result = $this->db->update($this->m_table_name, $update_array, $where_array);
        if( !$result )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return $this->db->affected_rows();
    }
    
    //--------------------------------------------------------------------------
    
    
    public function deleteWhere( $where_array )
    {
        if( $this->m_table_name === null )
        {
            throw new Exception("m_tablename was not set. You need to call setTableName(table_name) first.");
        }  
        
        self::checkIsArray( $where_array );
        
        $result = $this->db->delete($this->m_table_name, $where_array );
        if( !$result )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        return $this->db->affected_rows();
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
        if( !$query )
        {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
        
        if ( $query->num_rows() <= 0 )  // if no search results found
        {
            return false;
        }
        
        $result = self::convertDatatypes($query->result_array());  
        return $result; 
    }        
    
    //--------------------------------------------------------------------------
    
    // returns the next id of a table column
    public function getNextID( $id_col_name )
    {
        self::checkIsString("id_col_name" , $id_col_name);
        self::checkStringIsValid("id_col_name", $id_col_name);
        
        $sql = "SELECT MAX(" . $id_col_name . ") AS id FROM " . $this->m_table_name;
        $result = $this->doSelect($sql);
        if( $result === false )
        {
            $next_id = 1; // must be no rows in the table if no rows were found
        }
        else
        {
            $next_id = (int)$result[0]["id"] + 1;
        }    
        
        return $next_id;
    }        
    
    //--------------------------------------------------------------------------

}

?>
