<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_auth_model'); 
    }
    
    public function index()
    {
        $this->load->view('login');
    }
    
    public function authenticate() 
    {
        $username = trim( $this->input->post('username') );
        $password = trim( $this->input->post('password') );
      
        $login_data["result"] = "error";
        if( $this->user_auth_model->userExists($username) )
        {
            // username exists in database
            if( $this->user_auth_model->isCorrectPassword($username, $password) )
            {
                // inputted password is correct
                $login_data["result"] = "success";
            }
            else
            {
                $login_data["message"] = "Password is incorrect";
            }    
        }
        else 
        {
            // user does not exist in database
            $login_data["message"] = "Username does not exist";
        }
        
                        
        $login_json = json_encode($login_data);
        $data['ajax'] = $login_json;
        $this->load->view('ajax', $data);
    } 
        
}

/* End of file login.php */
