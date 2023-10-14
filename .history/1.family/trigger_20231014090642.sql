



















DELIMITER //
CREATE TRIGGER log_insert_trigger_person
AFTER INSERT ON person
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('INSERT', 'person', NEW.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;








DELIMITER //
CREATE TRIGGER log_insert_trigger_htraining
AFTER INSERT ON  htraining
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('INSERT',  @user_id,@query_value, NOW() ,'htraining', NEW.hhtrnid);
END;
//
DELIMITER ;	















DELIMITER //
CREATE TRIGGER log_insert_trigger_child
AFTER INSERT ON child
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('INSERT', 'child', NEW.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;


\

DELIMITER //
CREATE TRIGGER log_insert_trigger_disptyp
AFTER INSERT ON disptyp
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'disptyp', NEW.disptypid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_member
AFTER INSERT ON member
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'member', NEW.perid);
END;
//
DELIMITER ; 

DELIMITER //
CREATE TRIGGER log_insert_trigger_institute
AFTER INSERT ON institute
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'institute', NEW.instid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_inststay
AFTER INSERT ON inststay
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'inststay', NEW.perid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_hedu
AFTER INSERT ON hedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hedu', NEW.heduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_hwork
AFTER INSERT ON hwork
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hwork', NEW.hwrkid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_hhelpedu
AFTER INSERT ON hhelpedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hhelpedu', NEW.hheduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_hhelpwork
AFTER INSERT ON hhelpjob
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hhelpjob', NEW.hhjobid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_htraining
AFTER INSERT ON  htraining
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('INSERT',  @user_id,@query_value, NOW() ,'htraining', NEW.hhtrnid);
END;
//
DELIMITER ;	
DELIMITER //
CREATE TRIGGER log_insert_trigger_hfolowup
AFTER INSERT ON hfolowup
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hfolowup', NEW.hflwid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_activity
AFTER INSERT ON  activity
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('INSERT',  @user_id,@query_value, NOW() ,'activity', NEW.actid);
END;
//
DELIMITER ;				
DELIMITER //
CREATE TRIGGER log_insert_trigger_staff
AFTER INSERT ON staff
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'staff', NEW.staffid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_insert_trigger_hhold
AFTER INSERT ON hhold
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('INSERT', @user_id,@query_value, NOW() ,'hhold', NEW.hholdid);
END;
END;
//
DELIMITER ; 


































































































































































































