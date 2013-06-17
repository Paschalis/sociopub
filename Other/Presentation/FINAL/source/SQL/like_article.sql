-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` FUNCTION `toggle_like_article`(
article_id INT(10),
username VARCHAR(30),
likeValue BIT
) RETURNS int(1)
BEGIN

-- RETURN CODES:
--  -3: User_article NOT exists
--  -2: article NOT exists
-- -1: USER DOESNT EXISTS
--  1: Successfully liked/unliked

	-- Variables
	DECLARE articleID, userID, userArticleID INT(10) DEFAULT -1;
	DECLARE like_val BIT DEFAULT 0;
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

-- DETO WS DAME

		-- get userArticleID
		SELECT UA.idUSER_ARTICLE INTO userArticleID
		FROM USER_ARTICLE UA
		WHERE UA.idArticle=articleID && UA.idUSER=userID;

		
		
	if(userArticleID<0) THEN
		RETURN -3;
	END IF;

	SELECT UA.LIKED INTO like_val
	FROM USER_ARTICLE UA
	WHERE UA.idArticle=articleID && UA.idUSER=userID;

UPDATE USER_ARTICLE SET LIKED=likeValue WHERE idUSER_ARTICLE=userArticleID;
	-- if(like_val=0) then
		-- UPDATE USER_ARTICLE SET LIKED=1 WHERE idUSER_ARTICLE=userArticleID; 
	-- else -- if(like_val=1) then
		-- UPDATE USER_ARTICLE SET LIKED=0 WHERE idUSER_ARTICLE=userArticleID; 
	-- end if;

	RETURN 1;

END