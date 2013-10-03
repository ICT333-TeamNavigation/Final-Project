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
        $this->load->model('user_auth_model'); 
        $this->load->model('studies_model'); 
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
        
        //print self::STARS;
        //print "Testing user_auth_model.\n";
        //print self::STARS;
        //self::userAuthModelTests();
        //print self::NEW_LINES;
        
        print self::STARS;
        print "Testing studies_model.\n";
        print self::STARS;
        self::studiesModelTests();
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
    
    public function userAuthModelTests()
    {
        $this->data_access_object->setTableName("parameter");
        var_dump($this->data_access_object->getAllRows());
        
        $test_num = 1;
        $test_func = "user_auth_model->userExists( 'test_user' )";
        try
        {
            $results = $this->user_auth_model->userExists( "test_user" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "user_auth_model->userExists( 'executive' )";
        try
        {
            $results = $this->user_auth_model->userExists( "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "user_auth_model->isCorrectPassword( 'executive', 'incorrect_password' )";
        try
        {
            $results = $this->user_auth_model->isCorrectPassword( "executive", "incorrect_password" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        $test_num = 4;
        $test_func = "user_auth_model->isCorrectPassword( 'executive', 'executive' )";
        try
        {
            $results = $this->user_auth_model->isCorrectPassword( "executive", "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
    }
    
    
    //---------------------------------------------------------------------------
    
    
    public function studiesModelTests()
    {
        $test_num = 1;
        $test_func = "studies_model->getUserStudies( 'test_user' )";
        try
        {
            $results = $this->studies_model->getUserStudies( "test_user" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "studies_model->getUserStudies( 'executive' )";
        try
        {
            $results = $this->studies_model->getUserStudies( "executive" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "studies_model->userStudyExists( 'executive', 1, 1 )";
        try
        {
            $results = $this->studies_model->userStudyExists( "executive", 1, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "studies_model->userStudyExists( 'executive', 1, 2 )";
        try
        {
            $results = $this->studies_model->userStudyExists( "executive", 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 5;
        $test_func = "studies_model->getStudyQuestions( 1, 1 )";
        try
        {
            $results = $this->studies_model->getStudyQuestions( 2, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 6;
        $test_func = "studies_model->getStudyQuestions( 1, 2 )";
        try
        {
            $results = $this->studies_model->getStudyQuestions( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 7;
        $test_func = "studies_model->getStudyDetails( 1, 2 )";
        try
        {
            $results = $this->studies_model->getStudyDetails( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 8;
        $test_func = "studies_model->getStudyDetails( 2, 1 )";
        try
        {
            $results = $this->studies_model->getStudyDetails( 2, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 9;
        $test_func = "studies_model->searchUserStudies( 'executive', 'cost' )";
        try
        {
            $results = $this->studies_model->searchStudies( "executive", "cost" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 10;
        $test_func = "studies_model->searchUserStudies( 'executive', 'effect' )";
        try
        {
            $results = $this->studies_model->searchStudies( "executive", "hello" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
    }
    
}

// end of file
?>