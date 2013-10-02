<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Studies_model extends CI_Model
{
    const TABLE_USER_STUDY     = "user_study";
    const TABLE_STUDY          = "study";
    const TABLE_STUDY_QUESTION = "study_question";
    
    const COL_USERNAME         = "username";
    const COL_MODEL_ID         = "model_id";
    const COL_STUDY_ID         = "study_id";
    const COL_QUESTION         = "question";
        
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();    // Call the Model constructor  
        //$this->load->database();
        $this->load->model('data_access_object'); 
        
    }
    
    //--------------------------------------------------------------------------
    
    
    // pre:    username must be a non empty string
    // post:   returns multidimensional array of user studies belonging to the user
    //         and if no studies are found returns false
    public function getUserStudies( $username )
    {
        $this->data_access_object->setTableName(self::TABLE_USER_STUDY);
        
        $this->data_access_object->checkIsString(self::COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(self::COL_USERNAME, $username);
                          
        $where_array[self::COL_USERNAME] = $username;
        return $this->data_access_object->getWhere($where_array);
    }
    
    
    //--------------------------------------------------------------------------
    
    // pre:    username and question must be non empty strings
    // post:   returns an object containing the search results.
    //         the object contains an array of user_study search results
    //         and an array of non-user study search results.
    //         if no user or non-user study search results are found then each
    //         array reference will be set to false in each case.
    public function searchStudies( $username, $question )
    {
        $search_results = new stdClass();
        $search_results->userStudies = false;
        $search_results->nonUserStudies = false;
                
        $this->data_access_object->checkIsString(self::COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(self::COL_USERNAME, $username);
        
        $this->data_access_object->checkIsString(self::COL_QUESTION, $question);
        $this->data_access_object->checkStringIsValid(self::COL_QUESTION , $question);
        
        // search the study questions in the database
        $search_sql  = "SELECT DISTINCT model_id, study_id FROM " . self::TABLE_STUDY_QUESTION;
        $search_sql .= " WHERE MATCH(" . self::COL_QUESTION . ") AGAINST( ? )";
              
        $study_keys = $this->data_access_object->doSelect($search_sql, array($question) );
        if( $study_keys === false )
        {
            return $search_results;
        }    
        
        $u_studies_i = 0;
        $non_u_studies_i = 0;
        foreach ($study_keys as $study_key)
        {
            $temp_model_id = $study_key[self::COL_MODEL_ID];
            $temp_study_id = $study_key[self::COL_STUDY_ID];
            
            $temp_study_details = $this->getStudyDetails($temp_model_id, $temp_study_id);
            
            if( $this->userStudyExists($username, $temp_model_id, $temp_study_id) )
            {
                $search_results->userStudies[$u_studies_i] = $temp_study_details;
                $u_studies_i++;
            }
            else
            {
                $search_results->nonUserStudies[$non_u_studies_i] = $temp_study_details;
                $non_u_studies_i++;
            }
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
        $this->data_access_object->setTableName(self::TABLE_STUDY);
        
        $this->data_access_object->checkIsInt(self::COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(self::COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt( self::COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(self::COL_STUDY_ID, $study_id );
                
        $where_array[self::COL_MODEL_ID] = $model_id;
        $where_array[self::COL_STUDY_ID] = $study_id;
        
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
        $this->data_access_object->setTableName(self::TABLE_STUDY_QUESTION);
        
        $this->data_access_object->checkIsInt(self::COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(self::COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt(self::COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(self::COL_STUDY_ID, $study_id );
                
        $where_array[self::COL_MODEL_ID] = $model_id;
        $where_array[self::COL_STUDY_ID] = $study_id;
        $result = $this->data_access_object->getWhere($where_array);
        if( $result === false )
        {
            return false;
        }    
        
        // build array of question strings using multidimentional questions array
        $i = 0;
        foreach( $result as $row )
        {
            $questions[$i] = $result[$i][self::COL_QUESTION];
            $i++;
        }    
        return $questions;
    }
    
    //--------------------------------------------------------------------------
    
    
    // returns true if the user study exists in the database and false otherwise
    public function userStudyExists( $username, $model_id, $study_id )
    {
        $this->data_access_object->setTableName(self::TABLE_USER_STUDY);
        
        $this->data_access_object->checkIsString(self::COL_USERNAME, $username );
        $this->data_access_object->checkStringIsValid(self::COL_USERNAME, $username );
        
        $this->data_access_object->checkIsInt(self::COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(self::COL_MODEL_ID, $model_id );
                
        $this->data_access_object->checkIsInt( self::COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(self::COL_STUDY_ID, $study_id );
        
        $where_array[self::COL_USERNAME] = $username;
        $where_array[self::COL_MODEL_ID] = $model_id;
        $where_array[self::COL_STUDY_ID] = $study_id;
        $user_study = $this->data_access_object->getWhere($where_array);
       
        $user_study_exists = false;
        if( $user_study !== false )
        {
            $user_study_exists = true;
        }    
        return $user_study_exists;
    }
    
    //--------------------------------------------------------------------------
    
}

?>
