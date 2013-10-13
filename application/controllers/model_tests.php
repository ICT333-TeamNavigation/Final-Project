<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Model_tests extends CI_Controller 
{
    const STARS = "*************************************************************\n";
    const NEW_LINES = "\n\n";
    
    //---------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        
        // load all the models used in the tests
        $this->load->model('data_access_object'); 
        $this->load->model('user_model'); 
        $this->load->model('study_model'); 
        $this->load->model('scenario_model'); 
        $this->load->model('json_builder_model'); 
    }
    
    //---------------------------------------------------------------------------
    
    public function index()
    {
        print "<pre>\n";
        print self::STARS; 
        print self::STARS;
        print "Beginning model unit tests.\n";
        print self::STARS; 
        print self::STARS; 
        print self::NEW_LINES;
        
        
        print self::STARS;
        print "Testing user_model.\n";
        print self::STARS;
        self::userModelTests();
        print self::NEW_LINES;
        
                
        print self::STARS;
        print "Testing study_model.\n";
        print self::STARS;
        self::studyModelTests();
        print self::NEW_LINES;
        
        
        print self::STARS;
        print "Testing scenario_model.\n";
        print self::STARS;
        self::scenarioModelTests();
        print self::NEW_LINES;
        
        
        print self::STARS;
        print "Testing json_builder_model.\n";
        print self::STARS;
        self::jsonBuilderModelTests();
        print self::NEW_LINES;
        
               
        print "</pre>\n";
    }
    
    //---------------------------------------------------------------------------
    
    private function printTestResults( $test_number, $test_function, $results )
    {
        print "Test $test_number: $test_function \n";
        print "Results: \n";
        var_dump($results);
        print self::NEW_LINES;
    }
    
    //---------------------------------------------------------------------------
    
    public function userModelTests()
    {
        
        $test_num = 1;
        $test_func = "user_model->userExists( 'test_user' )";
        try
        {
            $this->user_model->setUsername("test_user");
            $results = $this->user_model->userExists();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "user_model->userExists( 'executive' )";
        try
        {
            $this->user_model->setUsername("executive");
            $results = $this->user_model->userExists();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "user_model->isCorrectPassword( 'incorrect_password' )";
        try
        {
            $results = $this->user_model->isCorrectPassword( "incorrect_password" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        $test_num = 4;
        $test_func = "user_model->isCorrectPassword( 'executive' )";
        try
        {
            $results = $this->user_model->isCorrectPassword( "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
    }
    
    
    //---------------------------------------------------------------------------
    
    
    public function studyModelTests()
    {
        $test_num = 1;
        $test_func = "study_model->getUserStudies( 'executive' )";
        try
        {
            $this->study_model->setAttributes("manager", 1);
            $results = $this->study_model->getUserStudies();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "study_model->isUserStudy(1)";
        try
        {
            $this->study_model->setAttributes("manager", 1);
            $results = $this->study_model->isUserStudy(2);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
              
        
        $test_num = 3;
        $test_func = "study_model->searchStudies( 'cost' )";
        try
        {
            $results = $this->study_model->searchStudies( "cost" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
                
        $test_num = 4;
        $test_func = "user_study_model->searchStudies( 'effect' )";
        try
        {
            $results = $this->study_model->searchStudies( "effect" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 5;
        $test_func = "study_model->deleteStudy(3)";
        try
        {
            $results = $this->study_model->deleteStudy(3);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 6;
        $test_func = "study_model->insertStudy( 3, 'insert name', 'insert description', 
                      'questions', 'b', 'analyst', 1)";
        try
        {
            $results = $this->study_model->insertStudy(3, "insert name", "insert description",
                                           "questions", "b", "analyst", 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 7;
        $test_func = "study_model->updateUserStudy( 3, 'name updated', 'description updated', 
                      'updated questions', 'b', 'analyst', 1)";
        try
        {
            $results = $this->study_model->updateStudy(3, 'name updated', 'description updated', 
                      'updated questions', 'b', 'analyst', 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 8;
        $test_func = "study_model->getStudy(3)";
        try
        {
            $results = $this->study_model->getStudy(3);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
                
        $test_num = 9;
        $test_func = "study_model->createStudy(1)";
        try
        {
            $this->study_model->setAttributes("analyst", 1);
            
            $results = $this->study_model->createStudy( "name: createUserStudy",
             "descrition: createUserStudy", "losts of questions", "creator: ben");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 10;
        $test_func = "study_model->editStudy(1)";
        try
        {
            
            $this->study_model->setAttributes("manager", 1);
            $parm_vis = $this->study_model->getStudyParmVis(4);
                
            $i = 0;
            foreach($parm_vis as $parm_vis_row)
            {
                $parm_vis[$i][COL_VISIBLE] = false;
                $i++;
            }    
            $results = $this->study_model->editStudy(4, "name: editStudy",
             "descrition: editStudy", "questions: editStudy", "creator: ben edited", $parm_vis);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 11;
        $test_func = "study_model->removeStudy(1)";
        try
        {
            $this->study_model->setAttributes("manager", 1);
            $results = $this->study_model->removeStudy(6);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        
    }
    
    //--------------------------------------------------------------------------
    
    public function scenarioModelTests()
    {
        $test_num = 1;
        $test_func = "scenario_model->deleteScenario(1, 1)";
        try
        {
            
            $results = $this->scenario_model->deleteScenario(1, 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "scenario_model->insertScenario(1, 1)";
        try
        {
            
            $results = $this->scenario_model->insertScenario(1, 1,  
                    "name: insertUserScenario", "description: insertUserScenario", "{['\"test json\"']}");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "scenario_model->updateScenario(1, 1)";
        try
        {
            
            $results = $this->scenario_model->updateScenario(1, 1, 
                    "name: updatedUserScenario", "description: insertUserScenario", "{['\"test json\"']}");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "scenario_model->getScenario(1, 1)";
        try
        {
            
            $results = $this->scenario_model->getScenario(1, 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        
        $test_num = 5;
        $test_func = "scenario_model->getStudyScenarios()";
        try
        {
            $this->scenario_model->setAttributes(1, 1);
            $results = $this->scenario_model->getStudyScenarios();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
                    
        
        $test_num = 6;
        $test_func = "scenario_model->isStudyScenario(2)";
        try
        {
            $this->scenario_model->setAttributes(1, 1);
            $results = $this->scenario_model->isStudyScenario(2);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        
        $test_num = 7;
        $test_func = "scenario_model->createScenario()";
        try
        {
            $this->scenario_model->setAttributes(1, 1);
            $results = $this->scenario_model->createScenario("created test scenario", "created test description");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
    } 
    
    //--------------------------------------------------------------------------
    
    public function jsonBuilderModelTests()
    {
        $test_num = 1;
        $test_func = "json_builder_model->getModelNodes(1)";
        try
        {
            $results = $this->json_builder_model->getModelNodes(1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "json_builder_model->getNodeParameters(1, 1)";
        try
        {
            $results = $this->json_builder_model->getNodeParameters(1, 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "json_builder_model->getNodeLinks(1, 1)";
        try
        {
            $results = $this->json_builder_model->getNodeLinks(1, 1);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "json_builder_model->getNodeParameterJSON()";
        try
        {
            $results = $this->json_builder_model->getNodeParameters(1, 1);
            $results = $results[0];
            $results = $this->json_builder_model->getNodeParameterJSON($results);
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 5;
        $test_func = "json_builder_model->getNodeJSON(1, 1, 'Diggers')";
        try
        {
            $results = $this->json_builder_model->getNodeJSON(1, 1, "Diggers");
            
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 6;
        $test_func = "json_builder_model->getModelJSON(1)";
        try
        {
            $results = $this->json_builder_model->getModelJSON(1);
            
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        
        self::printTestResults( $test_num, $test_func, $results);
        print $results;
        
        
    }        
    
    //--------------------------------------------------------------------------
    
}

// end of file
?>