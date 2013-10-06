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
    // private CRUD functions
    //--------------------------------------------------------------------------
    
    // returns a single user study as an array or false if no data is found
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
    
    // insert a single row into the study table
    // returns true on success and false on failure
    public function insertUserStudy( $model_id, $study_id, $name, $description, $creator )
    {   
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
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
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY);
        $insert_array[COL_USERNAME]    = $this->m_username;
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
    
    
    // update a single row in the user study table
    // returns true on success and false on failure
    public function updateUserStudy( $model_id, $study_id, $name, $description, $creator )
    {   
        if( $this->m_username == null )
        {
            throw new Exception(COL_USERNAME . " was not set. Need to call setUsername() first.");
        } 
        
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
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY);
        $where_array[COL_USERNAME]     = $this->m_username;
        $where_array[COL_MODEL_ID]     = $model_id;
        $where_array[COL_STUDY_ID]     = $study_id;
        
        $update_array[COL_NAME]        = $name;
        $update_array[COL_DESCRIPTION] = $description;
        $update_array[COL_CREATOR]     = $creator;
               
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
    
    
    // delete a single row in the user study table
    // returns true on success and false on failure
    public function deleteUserStudy( $model_id, $study_id )
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
    
       
    public function setUsername( $username )
    {
        $this->data_access_object->checkIsString(COL_USERNAME , $username);
        $this->data_access_object->checkStringIsValid(COL_USERNAME, $username);
        
        $this->m_username = $username;
    }
    
    //--------------------------------------------------------------------------
    
    // inserts a user study row into the user study table and 
    // the parameter visiblity rows into the user_study_parm table
    // study_row is an associative array containing the details of the study
    // returns true on success
    // pre: setUserName must be called beforehand to set the username
    public function createUserStudy( $model_id, $study_id, $name, $description, $creator )
    {
        $success = $this->insertUserStudy($model_id,
                                          $study_id,
                                          $name, 
                                          $description, 
                                          $creator);
        if( $success === false )
        {
            throw new Exception("Failed to create user study. Insert into user study table failed.");
        } 
        
        $sql = "SELECT ".COL_NODE_ID.", ".COL_PARM_NAME.", ".COL_VISIBLE_DEFAULT
                        ." FROM ".TABLE_PARAMETER." WHERE ".COL_MODEL_ID." = $model_id";
        $parameters = $this->data_access_object->doSelect($sql);
        if( $parameters === false )
        {
            throw new Exception("Failed to create study. Failed to query parameters table.");
        }    
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY_PARM);
        foreach($parameters as $parm)
        {
            $insert_array[COL_USERNAME]  = $this->m_username;
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
        return true; 
    }
    
    
    //--------------------------------------------------------------------------
    
    
    // returns an array of user_study_parm records or false if no data found    
    // this function should be called before calling editUserStudy
    // edit the visible attribute in the array then pass it to editUserStudy
    // to update the details eg. $parm_vis[$i][COL_VISIBLE] = true;
    // pre: setUserName must be called beforehand to set the username
    public function getUserStudyParmVis( $model_id, $study_id )
    {
        // check if the user study exists  
        if( !$this->userStudyExists( $model_id, $study_id ) )
        {
            throw new Exception("Failed to get user study parameter visibility. 
                User study does not exist or does not belong to current user.");
        }
        
        $this->data_access_object->setTableName(TABLE_USER_STUDY_PARM);
        
        $where_array[COL_USERNAME] = $this->m_username;
        $where_array[COL_MODEL_ID] = $model_id;
        $where_array[COL_STUDY_ID] = $study_id;
        $parm_vis = $this->data_access_object->getWhere($where_array);
        if( $parm_vis === false )
        {
            return false;
        }    
         
        return $parm_vis;
    }        
    
    
            
    
    
    //--------------------------------------------------------------------------
    
    // parm_vis is an array containing the visiblity of each parameter for the user study
    // returns true on success
    // pre: setUserName must be called beforehand to set the username
    public function editUserStudy( $model_id, $study_id, $name, $description, $creator, $parm_vis )
    {
        $this->data_access_object->checkIsArray($parm_vis);

        // check if the user study exists  
        if( !$this->userStudyExists( $model_id, $study_id ) )
        {
            throw new Exception("Failed to edit user study. 
                User study does not exist or does not belong to current user.");
        }        
      
        // after the data is updated in the user_study table the data in the study
        // table is automaticly updated using a trigger
        $success = $this->updateUserStudy( $model_id, $study_id, $name, $description, $creator );
        if( $success === false )
        {
            throw new Exception("Failed to edit user study. Update on user_study table failed.");
        }  
              
        
        // update details in user_study_parm using parm_vis
        $this->data_access_object->setTableName(TABLE_USER_STUDY_PARM);
        $where_array[COL_USERNAME] = $this->m_username;
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
        return true; 
    }
    
    //--------------------------------------------------------------------------

    
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
    
        
    // returns true if the user study exists in the database and false otherwise
    // pre: setUserName must be called beforehand to set the username
    public function userStudyExists( $model_id, $study_id )
    {
        $result = $this->getUserStudy($model_id, $study_id);
       
        $user_study_exists = false;
        if( $result !== false )
        {
            $user_study_exists = true;
        }    
        return $user_study_exists;
    }
    
    //--------------------------------------------------------------------------
    
    
    // for each row in search results sets the 'is_user_study' flag to true or false
    // search_results is an array of studies returned from the search function
    // each study is an associative array
    // pre: setUserName must be called beforehand to set the username
    public function flagSearchResults( $search_results )
    { 
        $i = 0;
        foreach ($search_results as $row)
        {
            $temp_model_id = $row[COL_MODEL_ID];
            $temp_study_id = $row[COL_STUDY_ID];
       
            if( $this->userStudyExists($temp_model_id, $temp_study_id) )
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
