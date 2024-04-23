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
        IN userID INT,
        IN username VARCHAR(255),
        IN email VARCHAR(255),
        IN password VARCHAR(255),
        IN fname VARCHAR(255),
        IN lname VARCHAR(255),
        IN dob DATE,
        IN adminn BOOLEAN,
        IN dname VARCHAR(255),
        IN avatar VARCHAR(255)
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

----------------------INSERT REVIEW 
Drop  Procedure if exists InsertReview//
CREATE PROCEDURE InsertReview(
    IN p_userID INT,
    IN p_movieID INT,
    IN p_critique TEXT,
    IN p_rating DECIMAL,
    IN p_NOD BOOLEAN
)
BEGIN
    INSERT INTO Review (u_ID, mID, critique, rating, NOD, createdAt, updatedAt)
    VALUES (p_userID, p_movieID, p_critique, p_rating, p_NOD, NOW(), NOW());
END//

----------------------UPDATE REVIEW
Drop  Procedure if exists UpdateReview//
CREATE PROCEDURE UpdateReview (
    IN p_reviewID INT,
    IN p_critique TEXT,
    IN p_rating DECIMAL,
    IN p_NOD BOOLEAN
)
BEGIN
    UPDATE Review
    SET critique = p_critique,
        rating = p_rating,
        NOD = p_NOD,
        updatedAt = NOW()
    WHERE reviewID = p_reviewID;
END//

---------------------Delete Review 
Drop Procedure if exists DeleteReview//
CREATE PROCEDURE DeleteReview (
    IN p_reviewID INT
)
BEGIN
    DELETE FROM Review
    WHERE reviewID = p_reviewID;
END//

---------------------UPDATE OVERALL MOVIE RATING 
Drop Procedure if exists UpdateRating//
CREATE PROCEDURE UpdateRating(
    IN p_movieID INT
)
BEGIN
    UPDATE Movie m
    SET ovr = (SELECT AVG(rating) FROM Review WHERE mID = p_movieID)
    WHERE movie_ID = p_movieID;
END//

---------------------INSERT LIST 
Drop Procedure if exists InsertList//
CREATE PROCEDURE InsertLists (
    IN p_userID INT,
    IN p_listName VARCHAR(255),
    IN p_ltype VARCHAR(255)
)
BEGIN
    INSERT INTO Lists (u_ID, listName, ltype, createdAt, updatedAt)
    VALUES (p_userID, p_listName, p_ltype, NOW(), NOW());
END//

---------------------UPDATE LIST 
Drop Procedure if exists UpdateList//
CREATE PROCEDURE UpdateLists (
    IN p_listID INT,
    IN p_listName VARCHAR(255),
    IN p_ltype VARCHAR(255)
)
BEGIN
    UPDATE Lists
    SET listName = p_listName,
        ltype = p_ltype,
        updatedAt = NOW()
    WHERE listID = p_listID;
END//

---------------------DELETE LIST 
Drop Procedure if exists DeleteList//
CREATE PROCEDURE DeleteLists (
    IN p_listID INT
)
BEGIN
    DELETE FROM Lists
    WHERE listID = p_listID;
END//

---------------------INSERT LIST ITEMS  
Drop Procedure if exists InsertListItems//
CREATE PROCEDURE InsertListItems (
    IN p_listID INT,
    IN p_movieID INT
)
BEGIN
    INSERT INTO List_Items (l_ID, mID, createdAt, updatedAt)
    VALUES (p_listID, p_movieID, NOW(), NOW());
END//

---------------------DELETE LIST ITEMS  
Drop Procedure if exists DeleteListItems//
CREATE PROCEDURE DeleteListItems (
    IN p_listID INT,
    IN p_movieID INT
)
BEGIN
    DELETE FROM List_Items
    WHERE l_ID = p_listID AND mID = p_movieID;
END//




DELIMITER ;
