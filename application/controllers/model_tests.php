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
        $test_func = "user_study_model->userStudyExists( 'executive', 1, 1 )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->userStudyExists( 1, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 4;
        $test_func = "user_study_model->userStudyExists( 'executive', 1, 2 )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->userStudyExists( 1, 2 );
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
            $search_results = $this->study_model->searchStudies( "cost" );
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->flagSearchResults( $search_results );
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
            $search_results = $this->study_model->searchStudies( "effect" );
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->flagSearchResults( $search_results );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 7;
        $test_func = "user_study_model->getUserStudy( 'effect' )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->getUserStudy( 1, 1 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 8;
        $test_func = "user_study_model->insertUserStudy( 1, 2, 'insert name', 'insert description', 'b')";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->insertUserStudy( 1, 2, "insert name", "insert description", "b" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 9;
        $test_func = "user_study_model->updateUserStudy( 1, 2, 'insert name', 'insert description', 'b')";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->updateUserStudy( 1, 2, "updated name", "updated description", "b" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 10;
        $test_func = "user_study_model->deleteUserStudy( 1, 2 )";
        try
        {
            $this->user_study_model->setUsername("executive");
            $results = $this->user_study_model->deleteUserStudy( 1, 2 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
            print $e->getTraceAsString();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 11;
        $test_func = "user_study_model->createUserStudy( 1, 1 )";
        try
        {
            $this->user_study_model->setUsername("analyst");
            $results = $this->user_study_model->createUserStudy( 1, 1, "name: createUserStudy",
                                                                 "descrition: createUserStudy",
                                                                 "creator: ben");
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
        
        
        $test_num = 5;
        $test_func = "study_model->insertStudy( 1, 5 )";
        try
        {
            $results = $this->study_model->insertStudy( 1, 5, "study5", "test description", "benny" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 6;
        $test_func = "study_model->updateStudy( 1, 5 )";
        try
        {
            $results = $this->study_model->updateStudy( 1, 5, "study5-updated", "test description-updated", "benny-updated" );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 7;
        $test_func = "study_model->getStudy( 1, 5 )";
        try
        {
            $results = $this->study_model->getStudy( 1, 5 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 8;
        $test_func = "study_model->deleteStudy( 1, 5 )";
        try
        {
            $results = $this->study_model->deleteStudy( 1, 5 );
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 9;
        $test_func = "study_model->getNextStudyID";
        try
        {
            $results = $this->study_model->getNextStudyID();
        }
        catch( Exception $e )
        {
            $results = $e->getMessage();
        }
        self::printTestResults( $test_num, $test_func, $results);
        
        
        $test_num = 10;
        $test_func = "study_model->createStudy()";
        try
        {
            $questions[0] = "question 1";
            $questions[1] = "question 2";
            $questions[2] = "question 3";
            $questions[3] = "question 4";
            $results = $this->study_model->createStudy(1, "test createStudy name",
                    "test createStudy description", "bobby", $questions);
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