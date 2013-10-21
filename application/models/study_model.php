<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Study_model extends CI_Model
{
    private $m_username = null; 
    private $m_model_id = null; 

    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct(); // Call the Model constructor  
        $this->load->model('data_access_object'); 
    }
    
    //--------------------------------------------------------------------------
    
    
    public function setAttributes( $username, $model_id )
    {
        $this->data_access_object->checkIsString(COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username);
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->m_username = $username;
        $this->m_model_id = $model_id;
    }
    
    //--------------------------------------------------------------------------
   
    
    // pre:    question must be non empty string
    // post:   returns multidimensional array of studies search results
    //         and if no studies are found returns false
    public function searchStudies( $question )
    {
        $this->data_access_object->checkIsString(COL_QUESTIONS, $question);
        $this->data_access_object->checkStringIsValid(COL_QUESTIONS , $question);
        
        // search the study questions in the database
        $search_sql  = "SELECT * FROM " . TABLE_STUDY
                     . " WHERE MATCH(".COL_NAME.",".COL_QUESTIONS.") AGAINST( ? )";
              
        $study_results = $this->data_access_object->doSelect($search_sql, array($question));
        if( $study_results === false )
        {
            return false;
        }    
                       
        return $study_results;
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // inserts a study into the study table
    // on success returns the study_id of the study just created
    // pre: setAttributes must be called beforehand to set the username and model_id
    public function createStudy( $name, $description, $questions, $creator )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setAttributes() first.");
        }
        
        if( $this->m_model_id == null )
        {
            throw new Exception(COL_MODEL_ID . " was not set. Need to call setAttributes() first.");
        } 
                
        $study_id = $this->getNextStudyID();
        $username = $this->m_username;
        $model_id = $this->m_model_id;
  
        $success = $this->insertStudy( $study_id,
                                       $name, 
                                       $description, 
                                       $questions,
                                       $creator,
                                       $username,
                                       $model_id );
        if( $success === false )
        {
            throw new Exception("Failed to create study. Insert into study table failed.");
        } 
        
        $sql = "SELECT ".COL_NODE_ID.", ".COL_PARM_NAME.", ".COL_VISIBLE_DEFAULT
                        ." FROM ".TABLE_PARAMETER." WHERE ".COL_MODEL_ID." = $model_id";
        $parameters = $this->data_access_object->doSelect($sql);
        if( $parameters === false )
        {
            throw new Exception("Failed to create study. Failed to query parameters table.");
        }    
        
        $this->data_access_object->setTableName(TABLE_STUDY_PARAMETER);
        foreach($parameters as $parm)
        {
            $insert_array[COL_MODEL_ID]  = $model_id;
            $insert_array[COL_STUDY_ID]  = $study_id;
            $insert_array[COL_NODE_ID]   = $parm[COL_NODE_ID];
            $insert_array[COL_PARM_NAME] = $parm[COL_PARM_NAME];
            $insert_array[COL_VISIBLE]   = $parm[COL_VISIBLE_DEFAULT];
                       
            $success = $this->data_access_object->insert($insert_array);
            if( $success === false )
            {
                throw new Exception("Failed to create user study. Insert into user_study_parm table failed.");
            }    
        }
        
        return $study_id; 
    }  
    
    
    //--------------------------------------------------------------------------
    
    
    // parm_vis is an array containing the visiblity of each parameter for the user study
    // returns true on success
    // pre: setAttributes must be called beforehand to set the username and model_id
    public function editStudy( $study_id, $name, $description, $questions, $creator /*, $parm_vis */ )
    {
        //$this->data_access_object->checkIsArray($parm_vis);

        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setAttributes() first.");
        }
        
        if( $this->m_model_id == null )
        {
            throw new Exception(COL_MODEL_ID . " was not set. Need to call setAttributes() first.");
        } 
                
        $username = $this->m_username;
        $model_id = $this->m_model_id;
        
        
        // check if the user study exists  
        if( !$this->isUserStudy($study_id) )
        {
            throw new Exception("Failed to edit user study. 
                User study does not exist or does not belong to current user.");
        }        
    
        
        $success = $this->updateStudy( $study_id, $name, $description, $questions,
                                       $creator, $username, $model_id );
        if( $success === false )
        {
            throw new Exception("Failed to edit study. Update on study table failed.");
        }  
              
        /*
        // update details in study_parameter using parm_vis
        $this->data_access_object->setTableName(TABLE_STUDY_PARAMETER);
        
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        
        foreach($parm_vis as $parm_vis_row)
        {
            $where_array[COL_NODE_ID]   = $parm_vis_row[COL_NODE_ID];
            $where_array[COL_PARM_NAME] = $parm_vis_row[COL_PARM_NAME];
        
            $update_array[COL_VISIBLE]  = $parm_vis_row[COL_VISIBLE];
        
            $result = $this->data_access_object->updateWhere( $update_array, $where_array );
            if( $result != 1 && $result != 0 )  // rows updated can be 0 if the update value is the same
            {
                throw new Exception("Failed to edit user study. Update on user_study_parm table failed.");
            }    
        }
         
        */
        return true; 
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // sets the username value in the study table record to zero
    public function removeStudy( $study_id )
    {
        if( !$this->isUserStudy($study_id) )
        {
            throw new Exception("Failed to remove study. Study does not exist or does not belong to current user.");
        }    
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        
        $where_array[COL_STUDY_ID]  = $study_id;
        $update_array[COL_USERNAME] = null;   
                       
        $result = $this->data_access_object->updateWhere( $update_array, $where_array );
        if( $result != 1 )
        {
            throw new Exception("Failed to remove study. Wrong number of rows updated in study table.");
        }    
        
        return true;
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // pre: setAttributes must be called beforehand to set the username and model_id
    // post:   returns multidimensional array of user studies belonging to the user
    //         and if no studies are found returns false
    public function getUserStudies()
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setAttributes() first.");
        } 
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        $where_array[COL_USERNAME] = $this->m_username;
        $result = $this->data_access_object->getWhere($where_array);
        
        return $result;
    }
   
    
    //--------------------------------------------------------------------------
    
        
    // returns true if the user study exists in the database and false otherwise
    // pre: setAttributes must be called beforehand to set the username and model_id
    public function isUserStudy( $study_id )
    {
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setAttributes() first.");
        } 
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        
        $where_array[COL_STUDY_ID] = $study_id;
        $where_array[COL_USERNAME] = $this->m_username;
        
        $result = $this->data_access_object->getWhere($where_array);
        if( $result !== false )
        {
            $result = true;
        }    
        
        return $result;
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // returns an array of user_study_parm records or false if no data found    
    // this function should be called before calling editUserStudy
    // edit the visible attribute in the array then pass it to editUserStudy
    // to update the details eg. $parm_vis[$i][COL_VISIBLE] = true;
    // pre: setAttributes must be called beforehand to set the username and model_id
    public function getStudyParmVis( $study_id )
    {
        if( $this->m_model_id == null )
        {
            throw new Exception(COL_MODEL_ID . " was not set. Need to call setAttributes() first.");
        }
        
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY_PARAMETER);
        
        $where_array[COL_MODEL_ID] = $this->m_model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        $parm_vis = $this->data_access_object->getWhere($where_array);
        if( $parm_vis === false )
        {
            return false;
        }    
         
        return $parm_vis;
    }        
    
       
    //--------------------------------------------------------------------------
    // private CRUD functions
    //--------------------------------------------------------------------------
    
    
    // get a single row from the study table
    // may return false if no data is found for this key
    public function getStudy( $study_id )
    {   
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        
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
    public function insertStudy( $study_id, $name, $description, $questions, 
                                 $creator, $username, $model_id )
    {   
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_QUESTIONS , $questions);
        $this->data_access_object->checkStringIsValid(COL_QUESTIONS, $questions);
        
        $this->data_access_object->checkIsString(COL_CREATOR , $creator);
        $this->data_access_object->checkStringIsValid(COL_CREATOR, $creator);
        
        $this->data_access_object->checkIsString(COL_USERNAME, $username );
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username );
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        
        $insert_array[COL_STUDY_ID]    = $study_id;
        $insert_array[COL_NAME]        = $name;
        $insert_array[COL_DESCRIPTION] = $description;
        $insert_array[COL_QUESTIONS]   = $questions;
        $insert_array[COL_CREATOR]     = $creator;
        $insert_array[COL_USERNAME]    = $username;
        $insert_array[COL_MODEL_ID]    = $model_id;
        
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
    public function updateStudy( $study_id, $name, $description, $questions, 
                                 $creator, $username, $model_id )
    {   
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
        
        $this->data_access_object->checkIsString(COL_NAME , $name);
        $this->data_access_object->checkStringIsValid(COL_NAME, $name);
        
        $this->data_access_object->checkIsString(COL_DESCRIPTION , $description);
        $this->data_access_object->checkStringIsValid(COL_DESCRIPTION, $description);
        
        $this->data_access_object->checkIsString(COL_QUESTIONS , $questions);
        $this->data_access_object->checkStringIsValid(COL_QUESTIONS, $questions);
        
        $this->data_access_object->checkIsString(COL_CREATOR , $creator);
        $this->data_access_object->checkStringIsValid(COL_CREATOR, $creator);
        
        $this->data_access_object->checkIsString(COL_USERNAME, $username );
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username );
        
        $this->data_access_object->checkIsInt(COL_MODEL_ID, $model_id );
        $this->data_access_object->checkNumberIsValid(COL_MODEL_ID, $model_id );
        
        $this->data_access_object->setTableName(TABLE_STUDY);
        
        $where_array[COL_STUDY_ID]     = $study_id;
        
        $update_array[COL_NAME]        = $name;
        $update_array[COL_DESCRIPTION] = $description;
        $update_array[COL_QUESTIONS]   = $questions;
        $update_array[COL_CREATOR]     = $creator;
        $update_array[COL_USERNAME]    = $username;
        $update_array[COL_MODEL_ID]    = $model_id;
               
        $result = $this->data_access_object->updateWhere( $update_array, $where_array );
        if( $result == 1 || $result == 0 )
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
    public function deleteStudy( $study_id )
    {   
        $this->data_access_object->checkIsInt(COL_STUDY_ID, $study_id );
        $this->data_access_object->checkNumberIsValid(COL_STUDY_ID, $study_id );
                
        $this->data_access_object->setTableName(TABLE_STUDY);
        
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
    // End if CRUD functions
    //--------------------------------------------------------------------------
    
    // returns the next study_id as an int
    public function getNextStudyID()
    {
        $this->data_access_object->setTableName(TABLE_STUDY);
        return $this->data_access_object->getNextID(COL_STUDY_ID);
    }
            
    //--------------------------------------------------------------------------
    
    
    
}

?>
