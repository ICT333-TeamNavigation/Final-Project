USE team05;

-- user_config table
DELETE FROM user_config;
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting1", "test_value1" );
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting2", "test_value2" );
SELECT * FROM user_config;

-- study table
DELETE FROM study;
INSERT INTO study ( model_id, study_id, name, description, creator, date_created )
VALUES ( 1, 1, "study one", "this is the first test study created", "ben", CURDATE() );
INSERT INTO study ( model_id, study_id, name, description, creator, date_created )
VALUES ( 1, 2, "study two", "this is the second test study created", "ben", CURDATE() );
SELECT * FROM study;

-- user_study table
DELETE FROM user_study;
INSERT INTO user_study ( username, model_id, study_id, name, description, creator, date_created )
VALUES ( "executive", 1, 1, "study one", "this is the first test study created", "ben", CURDATE() );
INSERT INTO user_study ( username, model_id, study_id, name, description, creator, date_created )
VALUES ( "analyst", 1, 2, "study two", "this is the second test study created", "ben", CURDATE() );
SELECT * FROM user_study;

-- study_question table
DELETE FROM study_question;
INSERT INTO study_question ( model_id, study_id, question, description ) 
VALUES ( 1, 1, "How much money can be saved if the cost of petrol goes down?", NULL );
INSERT INTO study_question ( model_id, study_id, question, description ) 
VALUES ( 1, 2, "What is the optimal number of trucks to cruchers ratio?", NULL );
INSERT INTO study_question ( model_id, study_id, question, description ) 
VALUES ( 1, 2, "How will an increase in tire prices effect the company?", NULL );
INSERT INTO study_question ( model_id, study_id, question, description ) 
VALUES ( 1, 2, "What is the effect on ore production in bad weather?", NULL );    
SELECT * FROM study_question;

-- user_scenario table
DELETE FROM user_scenario;
INSERT INTO user_scenario ( username, model_id, study_id, scenario_id, name, description, parms_json )
VALUES ( "executive", 1, 1, 1, "scenario one", "this is the first test scenario created", "dummy json 1" );
INSERT INTO user_scenario ( username, model_id, study_id, scenario_id, name, description, parms_json )
VALUES ( "executive", 1, 1, 2, "scenario two", "this is the second test scenario created", "dummy json 2" );
INSERT INTO user_scenario ( username, model_id, study_id, scenario_id, name, description, parms_json )
VALUES ( "analyst", 1, 2, 1, "scenario one", "this is the first test scenario created", "dummy json 3" );
INSERT INTO user_scenario ( username, model_id, study_id, scenario_id, name, description, parms_json )
VALUES ( "analyst", 1, 2, 2, "scenario two", "this is the second test scenario created", "dummy json 4" );
SELECT * FROM user_scenario;

-- user_study_parm table
DELETE FROM user_study_parm;
INSERT INTO user_study_parm ( username, model_id, study_id, node_id, parm_name, visible )
VALUES ( "executive", 1, 1, 1, "number-of-diggers", 1 );
INSERT INTO user_study_parm ( username, model_id, study_id, node_id, parm_name, visible )
VALUES ( "executive", 1, 1, 1, "petrol-price", 1 );
INSERT INTO user_study_parm ( username, model_id, study_id, node_id, parm_name, visible )
VALUES ( "executive", 1, 1, 1, "run-time", 0 );
INSERT INTO user_study_parm ( username, model_id, study_id, node_id, parm_name, visible )
VALUES ( "executive", 1, 1, 1, "scoop-capacity", 1 );
INSERT INTO user_study_parm ( username, model_id, study_id, node_id, parm_name, visible )
VALUES ( "executive", 1, 1, 1, "maintenance-costs", 0 );
SELECT * FROM user_study_parm;
