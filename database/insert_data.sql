USE team05;

-- model table
DELETE FROM model;
INSERT INTO model ( model_id, name, description, api, creator, date_created ) 
VALUES ( 1 , "Pit to Port", 
"This model is used for monitoring and making predictions about the operations on a mine site.",
"dummyAPI", "Ben", NOW() );

-- node table
DELETE FROM node;
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 1, "Diggers", "digger.png" );
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 2, "Trucks", "truck.png" );
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 3, "Silos", "silo.png" );
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 4, "Trains", "train.png" );
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 5, "Port", "port.png" );
INSERT INTO node ( model_id, node_id, name, picture ) VALUES ( 1 , 6, "Globals", "globe.png" );

-- link table
DELETE FROM link;
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 1, 2 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 2, 1 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 2, 3 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 3, 2 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 3, 4 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 4, 3 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 4, 5 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 5, 4 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 1, 6 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 6, 1 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 2, 6 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 6, 2 );

INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 4, 6 );
INSERT INTO link ( model_id, node_id, link_node_id ) VALUES ( 1 , 6, 4 );


-- parameter table
DELETE FROM parameter;
-- Diggers node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 1, "number-of-diggers", "count" , 1, 1, 10, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 1, "petrol-price", "dollars/litre" , 1.30, 1, 2, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 1, "run-time", "hours/day" , 8, 0, 24, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 1, "scoop-capacity", "tones/digger" , 0.5, 0, 5, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 1, "maintenance-costs", "dollars/day" , 100, 50, 1000, 1, "slider" );
-- Trucks node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "number-of-trucks", "count" , 1, 1, 10, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "petrol-price", "dollars/litre" , 1.30, 1, 2, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "tyre-price", "dollars/tyre" , 10000, 5000, 20000, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "run-time", "hours/day" , 8, 0, 24, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "travel-distance", "km/trip" , 2 , 0.5 , 5 , 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "maintenance-costs", "dollars/day" , 100, 50, 1000, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 2, "average-speed", "km/hour" , 40, 0, 100, 1, "slider" );
-- Silos node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 3, "number-of-silos", "count" , 1, 1, 10, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 3, "silo-capacity", "tones/silo" , 100, 50, 200, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 3, "maintenance-costs", "dollars/day" , 100, 50, 1000, 1, "slider" );
-- Trains node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 4, "number-of-trains", "count" , 1, 1, 10, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 4, "train-capacity", "tones/train" , 500, 200, 1000, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 4, "maintenance-costs", "dollars/day" , 100, 50, 1000, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 4, "travel-distance", "km/trip" , 10 , 5 , 50 , 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 4, "average-speed", "km/hour" , 80, 0, 120, 1, "slider" );
-- Port node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 5, "port-capacity", "tones/port" , 500, 200, 1000, 1, "slider" );
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 5, "maintenance-costs", "dollars/day" , 500, 50, 1000, 1, "slider" );
-- Globals node parameters
INSERT INTO parameter ( model_id, node_id, parm_name, units, default_value, min_value, 
max_value, visible_default, control_type ) VALUES ( 1 , 6, "gravity", "metres/sec/sec" , 9.8 , 9.8 , 9.8 , 1, "slider" );

-- user table
DELETE FROM user;
INSERT INTO user ( username, password ) VALUES ( "executive" , "executive" );
INSERT INTO user ( username, password ) VALUES ( "manager" , "manager" );
INSERT INTO user ( username, password ) VALUES ( "analyst" , "analyst" );


-- test selects
SELECT n.name, parm_name, units, min_value, max_value
FROM parameter as p, node as n
WHERE p.node_id = n.node_id
AND p.model_id = n.model_id;
SELECT * FROM user;
