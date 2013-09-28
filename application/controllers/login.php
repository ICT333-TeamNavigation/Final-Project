<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model'); 
    }
    
    public function index()
    {
        $this->load->view('login');
    }
    
    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login_data = array("result" => "", "message" => "");
        
        
        $user = $this->user_model->get_user($username);
        
        $login_data["result"] = "error";
        //$login_data["message"] = "test ".$user[0]["username"];
        
        if($user[0] == NULL) {
            $login_data["message"] = "Username is incorrect";
        } else if($user[0]['username'] == $username && $user[0]['password'] == $password){
            $login_data["result"] = "success";
        } else {
            $login_data["message"] = "Password is incorrect";
        }
                
        $login_data = json_encode($login_data);
        
        $data['ajax'] = $login_data;
        $this->load->view('ajax', $data);
    } 
        
}

/* End of file login.php */
