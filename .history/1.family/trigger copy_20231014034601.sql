



DELIMITER //
CREATE TRIGGER log_update_trigger_person
AFTER UPDATE ON person
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('UPDATE', 'person', NEW.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;























DELIMITER //
CREATE TRIGGER log_update_trigger_child
AFTER UPDATE ON child
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('UPDATE', 'child', NEW.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;


\

DELIMITER //
CREATE TRIGGER log_update_trigger_disptyp
AFTER UPDATE ON disptyp
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'disptyp', NEW.disptypid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_member
AFTER UPDATE ON member
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'member', NEW.perid);
END;
//
DELIMITER ; 

DELIMITER //
CREATE TRIGGER log_update_trigger_institute
AFTER UPDATE ON institute
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'institute', NEW.instid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_inststay
AFTER UPDATE ON inststay
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'inststay', NEW.perid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_hedu
AFTER UPDATE ON hedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'hedu', NEW.heduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_hwork
AFTER UPDATE ON hwork
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'hwork', NEW.hwrkid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_hhelpedu
AFTER UPDATE ON hhelpedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'hhelpedu', NEW.hheduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_hhelpwork
AFTER UPDATE ON hhelpjob
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'hhelpjob', NEW.hhjobid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_htraining
AFTER UPDATE ON  htraining
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('UPDATE',  @user_id,@query_value, NOW() ,'htraining', NEW.hhtrnid);
END;
//
DELIMITER ;	
DELIMITER //
CREATE TRIGGER log_update_trigger_hfolowup
AFTER UPDATE ON hfolowup
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'hfolowup', NEW.hflwid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_update_trigger_activity
AFTER UPDATE ON  activity
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('UPDATE',  @user_id,@query_value, NOW() ,'activity', NEW.actid);
END;
//
DELIMITER ;				
DELIMITER //
CREATE TRIGGER log_update_trigger_staff
AFTER UPDATE ON staff
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('UPDATE', @user_id,@query_value, NOW() ,'staff', NEW.staffid);
END;
//
DELIMITER ; 



































































































































































































