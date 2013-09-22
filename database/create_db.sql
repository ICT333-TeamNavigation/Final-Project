-- DROP DATABASE IF EXISTS navigation_db;
-- CREATE DATABASE navigation_db;
-- USE navigation_db;
USE team05;

DROP TABLE IF EXISTS model;
DROP TABLE IF EXISTS node;
DROP TABLE IF EXISTS link;
DROP TABLE IF EXISTS parameter;
DROP TABLE IF EXISTS study;
DROP TABLE IF EXISTS study_question;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS user_study;
DROP TABLE IF EXISTS user_scenario;
DROP TABLE IF EXISTS user_study_parm;
DROP TABLE IF EXISTS user_config;

CREATE TABLE model 
(
    model_id        INT           NOT NULL, 
    name            VARCHAR(50)   NOT NULL,
    description     TEXT, 
    api             VARCHAR(50)   NOT NULL, 
    creator         VARCHAR(50),
    date_created    DATE,
    
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
    
    PRIMARY KEY (model_id, node_id, parm_name),
    FOREIGN KEY (model_id, node_id) 
        REFERENCES node(model_id, node_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE study 
(
    model_id        INT           NOT NULL, 
    study_id        INT           NOT NULL,
    name            VARCHAR(50)   NOT NULL,
    description     TEXT, 
    creator         VARCHAR(50),
    date_created    DATE,
    
    PRIMARY KEY (model_id, study_id),
    FOREIGN KEY (model_id) 
        REFERENCES model(model_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE study_question 
(
    model_id        INT           NOT NULL, 
    study_id        INT           NOT NULL,
    question        VARCHAR(255)  NOT NULL,
    description     TEXT, 
        
    PRIMARY KEY (model_id, study_id, question),
    FOREIGN KEY (model_id, study_id) 
        REFERENCES study(model_id, study_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
ALTER TABLE study_question ADD FULLTEXT(description, question);


CREATE TABLE user
(
    username        VARCHAR(50)   NOT NULL,
    password        VARCHAR(50)   NOT NULL,
    
    PRIMARY KEY (username)
);


CREATE TABLE user_study 
(
    username        VARCHAR(50)   NOT NULL,
    model_id        INT           NOT NULL, 
    study_id        INT           NOT NULL,
    name            VARCHAR(50)   NOT NULL,
    description     TEXT, 
    creator         VARCHAR(50),
    date_created    DATE,
    
    PRIMARY KEY (username, model_id, study_id),
    FOREIGN KEY (username) 
        REFERENCES user(username)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (model_id, study_id) 
        REFERENCES study(model_id, study_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE user_scenario
(
    username        VARCHAR(50)    NOT NULL,
    model_id        INT            NOT NULL, 
    study_id        INT            NOT NULL,
    scenario_id     INT            NOT NULL,
    name            VARCHAR(50)    NOT NULL,
    description     TEXT, 
    parms_json      VARCHAR(2000)  NOT NULL,
    
    PRIMARY KEY (username, model_id, study_id, scenario_id),
    FOREIGN KEY (username, model_id, study_id) 
        REFERENCES user_study(username, model_id, study_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE user_study_parm 
(
    username        VARCHAR(50)   NOT NULL,
    model_id        INT           NOT NULL, 
    study_id        INT           NOT NULL,
    node_id         INT           NOT NULL,
    parm_name       VARCHAR(50)   NOT NULL,
    visible         TINYINT(1)    NOT NULL,
        
    PRIMARY KEY (username, model_id, study_id, node_id, parm_name),
    FOREIGN KEY (username, model_id, study_id) 
        REFERENCES user_study(username, model_id, study_id)
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

-- SHOW DATABASES;
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