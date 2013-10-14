-- DROP DATABASE IF EXISTS team05;
-- CREATE DATABASE team05;
USE team05;
warnings


DROP TABLE IF EXISTS user_config;
DROP TABLE IF EXISTS scenario;
DROP TABLE IF EXISTS study_parameter;
DROP TABLE IF EXISTS study;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS parameter;
DROP TABLE IF EXISTS link;
DROP TABLE IF EXISTS node;
DROP TABLE IF EXISTS model;



CREATE TABLE model 
(
    model_id        INT           NOT NULL, 

    name            VARCHAR(50)   NOT NULL,
    description     TEXT, 
    api             VARCHAR(50)   NOT NULL, 
    creator         VARCHAR(50),
    date_created    DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (model_id)
);


CREATE TABLE node 
(
    model_id        INT           NOT NULL, 
    node_id         INT           NOT NULL,

    name            VARCHAR(50)   NOT NULL,
    picture         VARCHAR(255),
    
    PRIMARY KEY (model_id, node_id),
    FOREIGN KEY (model_id) 
        REFERENCES model(model_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE link 
(
    model_id        INT           NOT NULL, 
    node_id         INT           NOT NULL,
    link_node_id    INT           NOT NULL,
    
    PRIMARY KEY (model_id, node_id, link_node_id),
    FOREIGN KEY (model_id, node_id) 
        REFERENCES node(model_id, node_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE parameter
(
    model_id        INT           NOT NULL, 
    node_id         INT           NOT NULL,
    parm_name       VARCHAR(50)   NOT NULL,

    units           VARCHAR(50),
    default_value   FLOAT         NOT NULL,
    min_value       FLOAT         NOT NULL,
    max_value       FLOAT         NOT NULL,
    visible_default TINYINT(1)    NOT NULL,
    control_type    VARCHAR(50)   DEFAULT  'slider',
    
    PRIMARY KEY (model_id, node_id, parm_name),
    FOREIGN KEY (model_id, node_id) 
        REFERENCES node(model_id, node_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE user
(
    username        VARCHAR(50)   NOT NULL,
    password        VARCHAR(50)   NOT NULL,
    
    PRIMARY KEY (username)
);


CREATE TABLE study 
(
    study_id        INT           NOT NULL,

    name            VARCHAR(50)   NOT NULL,
    description     TEXT,
    questions       TEXT          NOT NULL, 
    FULLTEXT(questions),  
    creator         VARCHAR(50),
    date_created    DATETIME      DEFAULT CURRENT_TIMESTAMP,
    

    username        VARCHAR(50),
    model_id        INT           NOT NULL, 

    PRIMARY KEY (study_id),
    FOREIGN KEY (username) 
        REFERENCES user(username)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (model_id) 
        REFERENCES model(model_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE scenario
(
    study_id        INT            NOT NULL,
    scenario_id     INT            NOT NULL,

    name            VARCHAR(50)    NOT NULL,
    description     TEXT, 
    parms_json      TEXT           NOT NULL,
    
    PRIMARY KEY (study_id, scenario_id),
    FOREIGN KEY (study_id) 
        REFERENCES study(study_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE study_parameter 
(
    model_id        INT           NOT NULL, 
    study_id        INT           NOT NULL,
    node_id         INT           NOT NULL,
    parm_name       VARCHAR(50)   NOT NULL,
    
    visible         TINYINT(1)    DEFAULT 1,
        
    PRIMARY KEY (model_id, study_id, node_id, parm_name),
    FOREIGN KEY (study_id) 
        REFERENCES study(study_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (model_id, node_id, parm_name) 
        REFERENCES parameter(model_id, node_id, parm_name)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE user_config
(
    username        VARCHAR(50)   NOT NULL,
    attribute_name  VARCHAR(50)   NOT NULL,
    value           VARCHAR(255)  NOT NULL,
    
    PRIMARY KEY (username, attribute_name),
    FOREIGN KEY (username) 
        REFERENCES user(username)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);



SHOW TABLES;
-- SHOW COLUMNS FROM model;
-- SHOW COLUMNS FROM node;
-- SHOW COLUMNS FROM link;
-- SHOW COLUMNS FROM parameter;
-- SHOW COLUMNS FROM study;
-- SHOW COLUMNS FROM study_question;
-- SHOW COLUMNS FROM user;
-- SHOW COLUMNS FROM user_study;
-- SHOW COLUMNS FROM user_scenario;
-- SHOW COLUMNS FROM user_study_parm;
-- SHOW COLUMNS FROM user_config;  
