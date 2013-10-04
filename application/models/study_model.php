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
    // private CRUD functions
    //--------------------------------------------------------------------------
    
    
    // get a single row from the study table
    // may return false if no data is found for this key
    // $model_id  - int
    // $study_id  - int
    public function getStudy( $model_id, $study_id )
    {   
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        $result = $this->data_access_object->getWhere( $where_array );
        if( $result === false )
        {
            return false;   // return false if no data is found
        }
               
        $result_row = $result[0];
        return $result_row;
    }
           
    //--------------------------------------------------------------------------
    
    // insert a single row into the study table
    // may return false if no data is found for this key
    // $model_id     - int
    // $study_id     - int
    // $name         - string
    // $description  - string
    // $creator      - string
    public function insertStudy( $model_id, $study_id, $name, $description, $creator )
    {   
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
           
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_CREATOR , $creator);
        $this->data_access_object->checkStringIsValid(COL_CREATOR, $creator);
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        $insert_array[COL_MODEL_ID]    = $model_id;
        $insert_array[COL_STUDY_ID]    = $study_id;
        $insert_array[COL_NAME]        = $name;
        $insert_array[COL_DESCRIPTION] = $description;
        $insert_array[COL_CREATOR]     = $creator;
        
        $result = $this->data_access_object->insert( $insert_array );
        if( $result == 1 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }  
    }
    
    //--------------------------------------------------------------------------
    
    
    // update a single row in the study table
    // may return false if no data is updated
    // $model_id     - int
    // $study_id     - int
    // $name         - string
    // $description  - string
    // $creator      - string
    public function updateStudy( $model_id, $study_id, $name, $description, $creator )
    {   
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_CREATOR , $creator);
        $this->data_access_object->checkStringIsValid(COL_CREATOR, $creator);
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        $where_array[COL_MODEL_ID]     = $model_id;
        $where_array[COL_STUDY_ID]     = $study_id;
        
        $update_array[COL_NAME]        = $name;
        $update_array[COL_DESCRIPTION] = $description;
        $update_array[COL_CREATOR]     = $creator;
               
        $result = $this->data_access_object->updateWhere( $update_array, $where_array );
        if( $result == 1 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }    
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // delete a single row in the study table
    // may return false if no data is deleted
    // $model_id     - int
    // $study_id     - int
    public function deleteStudy( $model_id, $study_id )
    {   
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
                
        $this->data_access_object->setTableName(TABLE_STUDY);
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
                       
        $result = $this->data_access_object->deleteWhere( $where_array );
        if( $result == 1 )
        {    
            return true;
        }    
        else
        {    
            return false;
        }  
    }
    
    //--------------------------------------------------------------------------
    
    
    // returns the next study_id as an int
    private function getNextStudyID()
    {
        return $this->data_access_object->getNextID(COL_STUDY_ID);
    }
    
    
    //--------------------------------------------------------------------------
    // public functions
    //--------------------------------------------------------------------------
      
    
    // inserts a study into the study table
    // questions_array is an array of study questions
    public function createStudy( $model_id, $name, $description, $creator , $questions_array )
    {
        $this->data_access_object->checkIsArray( $questions_array );
        $success = $this->insertStudy($model_id,
                                      $this->getNextStudyID(),
                                      $name, 
                                      $description, 
                                      $creator);
        if( $success === false )
        {
            throw new Exception("Failed to create study. Insert into study table failed.");
        }    
        $this->data_access_object->setTableName(TABLE_STUDY_QUESTION);
        $insert_array[COL_MODEL_ID] = $temp_model_id;
        $insert_array[COL_STUDY_ID] = $temp_study_id;
        
        foreach($questions_array as $question)
        {
            // insert into question table
            $insert_array[COL_QUESTION] = $question;
            $success = $this->data_access_object->insert($insert_array);
            if( $success === false )
            {
                throw new Exception("Failed to create study. Insert into question table failed.");
            }    
        }    
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
        $result = $this->getStudy($model_id, $study_id);
        if( $result === false )
        {
            return false;
        }
                        
        $result["questions"] = $this->getStudyQuestions($model_id, $study_id);
        return $result;
    }
    
    //--------------------------------------------------------------------------
    
    
    // returns an array of study questions or false if no questions are found
    public function getStudyQuestions( $model_id, $study_id )
    {
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY_QUESTION);
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
