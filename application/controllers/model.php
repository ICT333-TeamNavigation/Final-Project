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
        $this->load->view('force_directed_3');
    }
    
    
    public function force()
    {
        // the problem with this node structure is that a model will not have a
        // central parent node ("Big old dog") but rather nodes will have relationships
        // with each other, not a central parent node.
        // also is it necessary to have size repeated in the json?
        // maybe it would be better to store size somewhere else.
        $data['ajax']= '{"name":"Big old dog","children":[{"name":"engine","children":[{"name":"graph","children":[{"name":"BetweennessCentrality","size":3000,"id":1,"index":0,"weight":1,"x":468.92515033894665,"y":358.7646874090654,"px":468.94903483776585,"py":358.56739932287394},{"name":"SpanningTree","size":3000,"id":2,"index":1,"weight":1,"x":420.27998110098815,"y":358.0635347605762,"px":420.36712107868726,"py":357.88652637256166}],"id":3,"index":2,"weight":3,"x":444.4156948627999,"y":283.9948705406919,"px":444.4799142056892,"py":283.86151604031704},{"name":"optimization","children":[{"name":"AspectRatioBanker","size":"3100","id":4,"index":3,"weight":1,"x":345.82764096659855,"y":136.97573073143434,"px":345.9730741730916,"py":137.10519585965096,"fixed":0,"children":null,"_children":null}],"id":5,"index":4,"weight":2,"x":420.4106309621076,"y":127.24150475816887,"px":420.4904305353348,"py":127.43744808344498,"fixed":0}],"id":6,"index":5,"weight":3,"x":454.3700928935484,"y":198.52162177024783,"px":454.40407936186745,"py":198.56559337072053},{"name":"Wheels","children":[{"name":"Easing","size":3000,"id":7,"index":6,"weight":1,"x":473.97489743052483,"y":141.6958545786116,"px":473.9873137888647,"py":141.8056559815227,"fixed":0,"_children":null},{"name":"FunctionSequence","size":3000,"id":8,"index":7,"weight":1,"x":604.8553838336943,"y":150.1365124836505,"px":604.6740966648669,"py":150.2712955456601},{"name":"interpolate","children":[{"name":"ArrayInterpolator","size":3000,"id":9,"index":8,"weight":1,"x":549.5114453256426,"y":342.5003519546858,"px":549.39806722688,"py":342.3358363759287},{"name":"PointInterpolator","size":3000,"id":10,"index":9,"weight":1,"x":589.5960798211656,"y":330.5534799522926,"px":589.410026806157,"py":330.4431585356272},{"name":"RectangleInterpolator","size":3000,"id":11,"index":10,"weight":1,"x":507.49033030079966,"y":328.97610662962484,"px":507.41927387322437,"py":328.81609353400495}],"id":12,"index":11,"weight":4,"x":550.0097170057609,"y":263.87460847090557,"px":549.8947837212279,"py":263.8136734846686},{"name":"ISchedulable","size":3000,"id":13,"index":12,"weight":1,"x":612.3440609121648,"y":204.84583265541153,"px":612.1101862739313,"py":204.85147745150346},{"name":"Tween","size":3000,"id":14,"index":13,"weight":1,"x":583.9960107587162,"y":246.1882690060295,"px":583.8144019403142,"py":246.1462892049219}],"id":15,"index":14,"weight":6,"x":535.724655918248,"y":183.39625380091599,"px":535.6315797911357,"py":183.48270886844952},{"name":"Chasis","children":[{"name":"converters","children":[{"name":"Converters","size":3000,"id":16,"index":15,"weight":1,"x":290.65811826754356,"y":252.95370538445772,"px":290.86049665695384,"py":252.92549882677403},{"name":"DelimitedTextConverter","size":3000,"id":17,"index":16,"weight":1,"x":360.77329358150746,"y":281.9964291909964,"px":360.8839396426483,"py":281.8788077454812},{"name":"JSONConverter","size":3000,"id":18,"index":17,"weight":1,"x":327.1923561358367,"y":279.26604082223434,"px":327.37096225230556,"py":279.16893204471705}],"id":19,"index":18,"weight":4,"x":347.0828763632953,"y":203.93017212077098,"px":347.2656422294148,"py":203.99490346396055},{"name":"DataField","size":3000,"id":20,"index":19,"weight":1,"x":411.502312404635,"y":239.29867465511006,"px":411.569325251763,"py":239.27300359119496},{"name":"DataUtil","size":3000,"id":21,"index":20,"weight":1,"x":376.06225745693393,"y":229.22228242171371,"px":376.18275218248874,"py":229.21945436802073}],"id":22,"index":21,"weight":4,"x":412.457972266385,"y":162.472644154024,"px":412.56494673547326,"py":162.56521858840998,"fixed":0},{"name":"Fuel","children":[{"name":"DirtySprite","size":3000,"id":23,"index":22,"weight":1,"x":508.6132650515993,"y":272.01942550539195,"px":508.5601630946986,"py":271.95150785684},{"name":"TextSprite","size":3000,"id":24,"index":23,"weight":1,"x":461.2003237935964,"y":259.65212000519193,"px":461.1741309737205,"py":259.5994213482118}],"id":25,"index":24,"weight":3,"x":500.1422297069846,"y":195.0021211037311,"px":500.1114189467545,"py":195.04781787249158},{"name":"Body","children":[{"name":"FlareVis","size":3000,"id":26,"index":25,"weight":1,"x":583.6336121891052,"y":197.71506610244234,"px":583.504050958065,"py":197.79164111902938}],"id":27,"index":26,"weight":2,"x":555.7748161763266,"y":125.55602854402787,"px":555.6768069236311,"py":125.76294865796874}],"fixed":1,"x":480,"y":120,"id":28,"index":27,"weight":5,"px":480,"py":120}';
        $this->load->view('ajax', $data);
        //return json_encode($data['ajax']);
        //return $data['ajax'];
    }
}
