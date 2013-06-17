-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` FUNCTION `favor_aritcle`(
article_id INT(10),
username VARCHAR(30),
favorValue BIT
) RETURNS int(1)
BEGIN

-- RETURN CODES:
--  -3: User_article NOT exists
--  -2: article NOT exists
--  -1: USER DOESNT EXISTS
--   1: Successfully favored/unfavored

	-- Variables
	DECLARE articleID, userID, userArticleID INT(10) DEFAULT -1;
	DECLARE favor_val BIT DEFAULT 0;
	-- Get username
	SELECT U.idUSER INTO userID  
	FROM USER U
	WHERE U.USERNAME=username;

	-- user doesnt exists
	IF (userID<0) THEN
		RETURN -1;
	END IF;

	-- get article id if exists
	SELECT A.idARTICLE INTO articleID
	FROM ARTICLE A
	WHERE A.idARTICLE=article_id;

	-- dont exists. add to DB
	 IF (articleID<0) THEN
		RETURN -2;
	END IF;


		-- get userArticleID
		SELECT UA.idUSER_ARTICLE INTO userArticleID
		FROM USER_ARTICLE UA
		WHERE UA.idArticle=articleID && UA.idUSER=userID;

		
		-- if userArticle NOT exists
	if(userArticleID<0) THEN
		RETURN -3;
	END IF;

	SELECT UA.FAVORITED INTO favor_val
	FROM USER_ARTICLE UA
	WHERE UA.idArticle=articleID && UA.idUSER=userID;

	-- Update favorited value
	UPDATE USER_ARTICLE SET FAVORITED=favorValue WHERE idUSER_ARTICLE=userArticleID;

	RETURN 1;

END