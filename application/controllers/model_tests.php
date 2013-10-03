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
        $this->load->model('user_study_model'); 
        $this->load->model('study_model'); 
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
        print "Testing user_auth_model.\n";
        print self::STARS;
        self::userModelTests();
        print self::NEW_LINES;
        
        
        print self::STARS;
        print "Testing user_study_model.\n";
        print self::STARS;
        self::userStudyModelTests();
        print self::NEW_LINES;
        
        
        print self::STARS;
        print "Testing study_model.\n";
        print self::STARS;
        self::studyModelTests();
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
    
    
    public function userStudyModelTests()
    {
        $test_num = 1;
        $test_func = "user_study_model->getUserStudies( 'test_user' )";
        try
        {
            $this->user_study_model->setUsername("test_user");
            $results = $this->user_study_model->getUserStudies();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "user_study_model->getUserStudies( 'executive' )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->getUserStudies("executive");
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "user_study_model->isUserStudy( 'executive', 1, 1 )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->isUserStudy( 1, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "user_study_model->isUserStudy( 'executive', 1, 2 )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->isUserStudy( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 5;
        $test_func = "user_study_model->searchStudies( 'cost' )";
        try
        {
            $results = $this->user_study_model->searchStudies( "cost" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 6;
        $test_func = "user_study_model->searchStudies( 'effect' )";
        try
        {
            $results = $this->user_study_model->searchStudies( "effect" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        
    }
    
    //---------------------------------------------------------------------------
    
    
    public function studyModelTests()
    {
        
        $test_num = 1;
        $test_func = "study_model->getStudyQuestions( 1, 1 )";
        try
        {
            $results = $this->study_model->getStudyQuestions( 1, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 2;
        $test_func = "study_model->getStudyQuestions( 1, 2 )";
        try
        {
            $results = $this->study_model->getStudyQuestions( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 3;
        $test_func = "study_model->getStudyDetails( 1, 2 )";
        try
        {
            $results = $this->study_model->getStudyDetails( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "study_model->getStudyDetails( 2, 1 )";
        try
        {
            $results = $this->study_model->getStudyDetails( 2, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        
    }        
    
}

// end of file
?>