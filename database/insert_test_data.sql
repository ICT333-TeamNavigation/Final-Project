

-- user_config table
DELETE FROM user_config;
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting1", "test_value1" );
INSERT INTO user_config ( username, attribute_name, value ) VALUES ( "executive" , "test_setting2", "test_value2" );
SELECT * FROM user_config;

-- study table
DELETE FROM study;
INSERT INTO study
SELECT * FROM study;

-- user_study table
DELETE FROM user_study;
INSERT INTO user_study
SELECT * FROM user_study;

-- question table
DELETE FROM question;
INSERT INTO question
SELECT * FROM question;

-- user_scenario table
DELETE FROM user_scenario;
INSERT INTO user_scenario
SELECT * FROM user_scenario;

-- user_study_parm table
DELETE FROM user_study_parm;
INSERT INTO user_study_parm
SELECT * FROM user_study_parm;