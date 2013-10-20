<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Model extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('study_model'); 
    }
    
    public function index()
    {
        $this->load->view('model_detail');
    }
    
    public function force_test() {
        session_start();
        $_SESSION["study_id"] = trim( $this->input->post("study_id") );
        $this->load->view('force_directed');
    }
    
    
    public function force()
    {
        // test data
        $data['ajax']= '{"nodes":
        [
        {"name":"A","group":0,"id":0,"type":"node","parameters":[{"name":"a1","value":6,"type":"parameter","group":0},{"name":"a2", "value":5,"type":"parameter","group":0},{"name":"a3", "value":6,"type":"parameter","group":0}]},
        {"name":"B","group":0,"id":1,"type":"node","parameters":[{"name":"b1","value":8,"type":"parameter","group":3},{"name":"b2","value":8,"type":"parameter","group":3}]},
        {"name":"C","group":8,"id":2,"type":"node","parameters":[{"name":"c1","value":8,"type":"parameter","group":3},{"name":"c2","value":8,"type":"parameter","group":3}]}
        ],
        "links":
        [
        {"source":0,"target":1},
        {"source":1,"target":2},
        {"source":2,"target":0}
        ]
}';
        $this->load->view('ajax', $data);
        
    }
}
