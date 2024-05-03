DELIMITER // 

--Update profile 
CREATE TRIGGER UpdateUserTrigger
AFTER UPDATE ON User
FOR EACH ROW
BEGIN 
    IF OLD.username <> NEW.username THEN
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'Username', OLD.username, NEW.username, NOW());
    END IF;
    
    IF OLD.email <> NEW.email THEN
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'Email', OLD.email, NEW.email, NOW());
    END IF;
    
    IF OLD.password <> NEW.password THEN
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'Password', OLD.password, NEW.password, NOW());
    END IF;
    
    IF OLD.fname <> NEW.fname THEN
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'First Name', OLD.fname, NEW.fname, NOW());
    END IF;
    
    IF OLD.lname <> NEW.lname THEN
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'Last Name', OLD.lname, NEW.lname, NOW());
    END IF;

    IF OLD.dob <> NEW.dob THEN 
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'dob', OLD.dob, NEW.dob, NOW());
    END IF;

    IF OLD.adminn <> NEW.adminn THEN 
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'adminn', OLD.adminn, NEW.adminn, NOW());
    END IF;

    IF OLD.dname <> NEW.dname THEN 
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'dname', OLD.dname, NEW.dname, NOW());
    END IF;

    IF OLD.avatar <> NEW.avatar THEN 
        INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
        VALUES (OLD.userID, 'avatar', OLD.avatar, NEW.avatar, NOW());
    END IF;
END;
//
    
--Delete profile 
CREATE TRIGGER DeleteUserTrigger
BEFORE DELETE ON User
FOR EACH ROW
BEGIN
    INSERT INTO ProfileHistory (uID, deletedUsername, deletedfname, deletedlname, deleteddob, deleteDate)
    VALUES (OLD.userID, OLD.username, OLD.fname, OLD.lname, OLD.dob, NOW());
END//

DELIMITER; 
