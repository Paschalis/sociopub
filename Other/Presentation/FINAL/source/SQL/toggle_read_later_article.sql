-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` PROCEDURE `toggle_read_later_article`(
article_id INT(10),
username VARCHAR(30)
)
BEGIN

-- RETURN CODES:
--  RESULT  1: Successfully read later
--  RESULT  0: Successfully wont read later
--  RESULT -1: USER DOESNT EXISTS
--  RESULT -2: article NOT exists
--  RESULT -3: User_article NOT exists


	-- Variables
	DECLARE articleID, userID, userArticleID INT(10) DEFAULT -1;
	DECLARE currentReadLaterValue BIT DEFAULT 0;

	-- Get userID
	SELECT U.idUSER INTO userID  
	FROM USER U
	WHERE U.USERNAME=username;

	-- user doesnt exists
	IF (userID<0) THEN
		SELECT -1 AS RESULT;
	END IF;

	-- get articleID if exists
	SELECT A.idARTICLE INTO articleID
	FROM ARTICLE A
	WHERE A.idARTICLE=article_id;

	-- dont exists. add to DB
	 IF (articleID<0) THEN
		SELECT -2 AS RESULT;
	END IF;

	-- get userArticleID
	SELECT UA.idUSER_ARTICLE INTO userArticleID
	FROM USER_ARTICLE UA
	WHERE UA.idArticle=articleID && UA.idUSER=userID;

	if(userArticleID<0) THEN
		SELECT -3 AS RESULT;
	END IF;

	SELECT UA.READ_LATER INTO currentReadLaterValue
	FROM USER_ARTICLE UA
	WHERE UA.idArticle=articleID && UA.idUSER=userID;


 	IF(currentReadLaterValue=0) THEN
		UPDATE USER_ARTICLE SET READ_LATER=1 WHERE idUSER_ARTICLE=userArticleID; 
		SELECT 1 AS RESULT;
	ELSEIF(currentReadLaterValue=1) THEN
		UPDATE USER_ARTICLE SET READ_LATER=0 WHERE idUSER_ARTICLE=userArticleID; 
		SELECT 0 AS RESULT;
	END IF;
END