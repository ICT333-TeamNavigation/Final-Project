<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class User_study_model extends CI_Model
{
    private $m_username = null; 
    
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
        $this->load->model('study_model');
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
    // post:   returns multidimensional array of user studies belonging to the user
    //         and if no studies are found returns false
    public function getUserStudies()
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY);
        $where_array[COL_USERNAME] = $this->m_username;
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }
    
    
    //--------------------------------------------------------------------------
    
    public function getUserStudy( $model_id, $study_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY);
        $where_array[COL_USERNAME] = $this->m_username;
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        
        $result = $this->data_access_object->getWhere($where_array);
        if( $result !== false )
        {
            $result = $result[0];  // get first row
        }    
        
        return $result; 
    }        
    
    //--------------------------------------------------------------------------
    
    
    // returns true if the user study exists in the database and false otherwise
    public function isUserStudy( $model_id, $study_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        }
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
                
        $result = $this->getUserStudy($model_id, $study_id);
       
        $user_study_exists = false;
        if( $result !== false )
        {
            $user_study_exists = true;
        }    
        return $user_study_exists;
    }
    
    //--------------------------------------------------------------------------
    
    
    // pre:    username must be set and question must be non empty string
    // post:   returns multidimensional array of studies search results
    //         and if no studies are found returns false
    public function searchStudies( $question )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
                      
        $this->data_access_object->checkIsString(COL_QUESTION, $question);
        $this->data_access_object->checkStringIsValid(COL_QUESTION , $question);
        
        // search the study questions in the database
        $search_sql  = "SELECT DISTINCT model_id, study_id FROM " . TABLE_STUDY_QUESTION
                     . " WHERE MATCH(" . COL_QUESTION . ") AGAINST( ? )";
              
        $study_keys = $this->data_access_object->doSelect($search_sql, array($question) );
        if( $study_keys === false )
        {
            return false;
        }    
        
        $i = 0;
        foreach ($study_keys as $study_key)
        {
            $temp_model_id = $study_key[COL_MODEL_ID];
            $temp_study_id = $study_key[COL_STUDY_ID];
            
            $search_results[$i] = $this->study_model->getStudyDetails($temp_model_id, $temp_study_id);
            
            if( $this->isUserStudy($temp_model_id, $temp_study_id) )
            {
                $search_results[$i]["is_user_study"] = true;
            }
            else
            {
                $search_results[$i]["is_user_study"] = false;
            }    
            $i++;
        }
                
        return $search_results;
    }
    
    //--------------------------------------------------------------------------
    
}

?>
