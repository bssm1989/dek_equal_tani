



DELIMITER //
CREATE TRIGGER log_delete_trigger_person
AFTER DELETE ON person
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('DELETE', 'person', OLD.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;























DELIMITER //
CREATE TRIGGER log_delete_trigger_child
AFTER DELETE ON child
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, table_name, record_id, user_id,query_value, action_timestamp)
VALUES ('DELETE', 'child', OLD.perid, @user_id,@query_value, NOW());
END;
//
DELIMITER ;


\

DELIMITER //
CREATE TRIGGER log_delete_trigger_disptyp
AFTER DELETE ON disptyp
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'disptyp', OLD.disptypid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_member
AFTER DELETE ON member
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'member', OLD.perid);
END;
//
DELIMITER ; 

DELIMITER //
CREATE TRIGGER log_delete_trigger_institute
AFTER DELETE ON institute
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'institute', OLD.instid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_inststay
AFTER DELETE ON inststay
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'inststay', OLD.perid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_hedu
AFTER DELETE ON hedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'hedu', OLD.heduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_hwork
AFTER DELETE ON hwork
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'hwork', OLD.hwrkid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_hhelpedu
AFTER DELETE ON hhelpedu
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'hhelpedu', OLD.hheduid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_hhelpwork
AFTER DELETE ON hhelpjob
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'hhelpjob', OLD.hhjobid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_htraining
AFTER DELETE ON  htraining
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('DELETE',  @user_id,@query_value, NOW() ,'htraining', OLD.hhtrnid);
END;
//
DELIMITER ;	
DELIMITER //
CREATE TRIGGER log_delete_trigger_hfolowup
AFTER DELETE ON hfolowup
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'hfolowup', OLD.hflwid);
END;
//
DELIMITER ; 
DELIMITER //
CREATE TRIGGER log_delete_trigger_activity
AFTER DELETE ON  activity
FOR EACH ROW
BEGIN
    INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name,  record_id)
    VALUES ('DELETE',  @user_id,@query_value, NOW() ,'activity', OLD.actid);
END;
//
DELIMITER ;				
DELIMITER //
CREATE TRIGGER log_delete_trigger_staff
AFTER DELETE ON staff
FOR EACH ROW
BEGIN
INSERT INTO user_actions_log (action_type, user_id,query_value, action_timestamp,table_name, record_id)
VALUES ('DELETE', @user_id,@query_value, NOW() ,'staff', OLD.staffid);
END;
//
DELIMITER ; 



































































































































































































