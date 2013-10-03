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
