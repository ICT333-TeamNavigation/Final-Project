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
        $this->load->view('force_directed_2');
    }
    
    public function force()
    {
        $data['ajax']= '{
    "name": "Big old dog",
    "children": [
                 {
                 "name": "engine",
                 "children": [
                              {
                              "name": "graph",
                              "children": [
                                           {"name": "BetweennessCentrality", "size": 3000},
                                           {"name": "SpanningTree", "size": 3000}
                                           ]
                              },
                              {
                              "name": "optimization",
                              "children": [
                                           {"name": "AspectRatioBanker", "size": 3000}
                                           ]
                              }
                              ]
                 },
                 {
                 "name": "Wheels",
                 "children": [
                              {"name": "Easing", "size": 3000},
                              {"name": "FunctionSequence", "size": 3000},
                              {
                              "name": "interpolate",
                              "children": [
                                           {"name": "ArrayInterpolator", "size": 3000},
                                           {"name": "PointInterpolator", "size": 3000},
                                           {"name": "RectangleInterpolator", "size": 3000}
                                           ]
                              },
                              {"name": "ISchedulable", "size": 3000},
                              {"name": "Tween", "size": 3000}
                              ]
                 },
                 {
                 "name": "Chasis",
                 "children": [
                              {
                              "name": "converters",
                              "children": [
                                           {"name": "Converters", "size": 3000},
                                           {"name": "DelimitedTextConverter", "size": 3000},
                                           {"name": "JSONConverter", "size": 3000}
                                           ]
                              },
                              {"name": "DataField", "size": 3000},
                              {"name": "DataUtil", "size": 3000}
                              ]
                 },
                 {
                 "name": "Fuel",
                 "children": [
                              {"name": "DirtySprite", "size": 3000},
                              {"name": "TextSprite", "size": 3000}
                              ]
                 },
                 {
                 "name": "Body",
                 "children": [
                              {"name": "FlareVis", "size": 3000}
                              ]
                 }
                 ]
}';
        $this->load->view('ajax', $data);
        //return json_encode($data['ajax']);
        //return $data['ajax'];
    }
}
