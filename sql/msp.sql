DELIMITER // 

---------------------INSERT USER
Drop  Procedure if exists InsertUser// 
CREATE PROCEDURE InsertUser(
    IN p_userID INT, 
    IN p_username VARCHAR(255),
    IN p_email VARCHAR(255), 
    IN p_password VARCHAR(255),
    IN p_fname VARCHAR(255),
    IN p_lname VARCHAR(255),
    IN p_dob DATE, 
    IN p_adminn BOOLEAN,
    IN p_dname VARCHAR(255), 
    IN p_avatar VARCHAR(255)) 
BEGIN
    INSERT INTO User(
        userID, username, email, password,
        fname, lname, dob, adminn, dname, avatar
    )
    VALUES (p_userID, p_username, p_email, p_password,
    p_fname, p_lname, p_dob, p_adminn, p_dname, p_avatar);
END
//

----------------------UPDATE USER 
Drop  Procedure if exists UpdateUser//
CREATE PROCEDURE UpdateUser(
    IN p_userID INT,
    IN p_username VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_fname VARCHAR(255),
    IN p_lname VARCHAR(255),
    IN p_dob DATE,
    IN p_adminn BOOLEAN,
    IN p_dname VARCHAR(255),
    IN p_avatar VARCHAR(255))
BEGIN
    UPDATE User
    SET username = p_username,
        email = p_email,
        password = p_password,
        fname = p_fname,
        lname = p_lname,
        dob = p_dob,
        adminn = p_adminn,
        dname = p_dname,
        avatar = p_avatar
    WHERE userID = p_userID;
END//

----------------------DELETE USER 
Drop  Procedure if exists DeleteUser//
CREATE PROCEDURE DeleteUser(
    IN p_userID INT,
    IN p_username VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_fname VARCHAR(255),
    IN p_lname VARCHAR(255),
    IN p_dob DATE,
    IN p_adminn BOOLEAN,
    IN p_dname VARCHAR(255),
    IN p_avatar VARCHAR(255))
BEGIN
    DELETE FROM User
    WHERE userID = p_userID;
END//

DELIMITER ;
