USE team05;

-- user_config table
DELETE FROM user_config;
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting1", "test_value1" );
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting2", "test_value2" );
SELECT * FROM user_config;


-- study table
DELETE FROM study;

INSERT INTO study ( study_id, name, description, questions, creator, username, model_id )
VALUES ( 1, "study one", "this is the first test study created", 
"How much money can be saved if the cost of petrol goes down?",
"ben", "executive", 1 );

INSERT INTO study ( study_id, name, description, questions, creator, username, model_id )
VALUES ( 2, "study two", "this is the second test study created", 
"What is the optimal number of trucks to cruchers ratio?
How will an increase in tire prices effect the company?
What is the effect on ore production in bad weather?",
"ben", "manager", 1 );

SELECT * FROM study;


-- user_scenario table
DELETE FROM scenario;
INSERT INTO scenario ( study_id, scenario_id, name, description, parms_json )
VALUES ( 1, 1, "scenario one", "this is the first test scenario created", "dummy json 1" );
INSERT INTO scenario ( study_id, scenario_id, name, description, parms_json )
VALUES ( 1, 2, "scenario two", "this is the second test scenario created", "dummy json 2" );
INSERT INTO scenario ( study_id, scenario_id, name, description, parms_json )
VALUES ( 2, 1, "scenario one", "this is the first test scenario created", "dummy json 3" );
INSERT INTO scenario ( study_id, scenario_id, name, description, parms_json )
VALUES ( 2, 2, "scenario two", "this is the second test scenario created", "dummy json 4" );
SELECT * FROM scenario;


-- study_parameter table
DELETE FROM study_parameter;
INSERT INTO study_parameter ( model_id, study_id, node_id, parm_name )
VALUES ( 1, 1, 1, "number-of-diggers" );
INSERT INTO study_parameter ( model_id, study_id, node_id, parm_name, visible )
VALUES ( 1, 1, 1, "petrol-price", 1 );
INSERT INTO study_parameter ( model_id, study_id, node_id, parm_name, visible )
VALUES ( 1, 1, 1, "run-time", 0 );
INSERT INTO study_parameter ( model_id, study_id, node_id, parm_name, visible )
VALUES ( 1, 1, 1, "scoop-capacity", 1 );
INSERT INTO study_parameter ( model_id, study_id, node_id, parm_name, visible )
VALUES ( 1, 1, 1, "maintenance-costs", 0 );
SELECT * FROM study_parameter;
