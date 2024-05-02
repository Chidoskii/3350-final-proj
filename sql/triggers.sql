DELIMITER // 

--Update profile 
CREATE TRIGGER UpdateUserTrigger
AFTER UPDATE ON User
FOR EACH ROW
BEGIN
    DECLARE changeType VARCHAR(255);
    DECLARE oldValue TEXT;
    DECLARE newValue TEXT;

    -- Determine Type of change 
    IF OLD.username <> NEW.username THEN
        SET changeType = 'Username';
        SET oldValue = OLD.username;
        SET newValue = NEW.username;
    ELSE IF OLD.email <> NEW.email THEN
        SET changeType = 'Email';
        SET oldValue = OLD.email;
        SET newValue = NEW.email;
    ELSE IF OLD.password <> NEW.password THEN
        SET changeType = 'Password';
        SET oldValue = OLD.password;
        SET newValue = NEW.password;
    ELSE IF OLD.fname <> NEW.fname THEN
        SET changeType = 'First Name';
        SET oldValue = OLD.fname;
        SET newValue = NEW.fname;
    ELSE IF OLD.lname <> NEW.lname THEN
        SET changeType = 'Last Name';
        SET oldValue = OLD.lname;
        SET newValue = NEW.lname;
    ELSE IF OLD.dob <> NEW.dob THEN 
        SET changeType = 'dob';
        SET oldValue = OLD.dob;
        SET newValue = NEW.dob;
    ELSE IF OLD.adminn <> NEW.adminn THEN 
        SET changeType = 'adminn';
        SET oldValue = OLD.adminn;
        SET newValue = NEW.adminn;
    ELSE IF OLD.dname <> NEW.dname THEN 
        SET changeType = 'dname';
        SET oldValue = OLD.dname;
        SET newValue = NEW.dname;
    ELSE IF OLD.avatar <> NEW.avatar THEN 
        SET changeType = 'avatar';
        SET oldValue = OLD.avatar;
        SET newValue = NEW.avatar;
    END IF;

    INSERT INTO ProfileChanges (uID, changeType, oldValue, newValue, changeDate)
    VALUES (changeType, oldValue, newValue, NOW());
END//
    
--Delete profile 
CREATE TRIGGER DeleteUserTrigger
BEFORE DELETE ON User
FOR EACH ROW
BEGIN
    INSERT INTO ProfileHistory (uID, deletedUsername, deletedfname, deletedlname, deleteddob, deleteDate)
    VALUES (OLD.userID, OLD.username, OLD.fname, OLD.lname, OLD.dob, NOW());
END//

DELIMITER; 
