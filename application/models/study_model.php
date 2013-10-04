<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Study_model extends CI_Model
{
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
    }
    
    //--------------------------------------------------------------------------
    
    // pre:    question must be non empty string
    // post:   returns multidimensional array of studies search results
    //         and if no studies are found returns false
    public function searchStudies( $question )
    {
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
        
        // get details from study table for each study key
        $i = 0;
        foreach ($study_keys as $study_key)
        {
            $temp_model_id = $study_key[COL_MODEL_ID];
            $temp_study_id = $study_key[COL_STUDY_ID];
            $search_results[$i] = $this->study_model->getStudyDetails($temp_model_id, $temp_study_id);
            $i++;
        }
                
        return $search_results;
    }
    
    //--------------------------------------------------------------------------
    
       
    // returns the details of a study from the database as an associative array
    // with keys that map to the columns in the study table.
    // this array also contains the study_questions associated with the study
    // which is accessed using the 'questions' key.
    public function getStudyDetails( $model_id, $study_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        
        $studies = $this->data_access_object->getWhere($where_array);
        if( $studies === false )
        {
            return false;
        }
        
        $study_details = $studies[0]; // get first row
                
        $study_details["questions"] = $this->getStudyQuestions($model_id, $study_id);
        return $study_details;
    }
    
    //--------------------------------------------------------------------------
    
    
    // returns an array of study questions or false if no questions are found
    public function getStudyQuestions( $model_id, $study_id )
    {
        $this->data_access_object->setTableName(TABLE_STUDY_QUESTION);
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
                
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        $result = $this->data_access_object->getWhere($where_array);
        if( $result === false )
        {
            return false;
        }    
        
        // build array of question strings using multidimentional questions array
        $i = 0;
        foreach( $result as $row )
        {
            $questions[$i] = $result[$i][COL_QUESTION];
            $i++;
        }    
        
        return $questions;
    }
    
    //--------------------------------------------------------------------------
}

?>