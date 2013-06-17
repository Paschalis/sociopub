-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` FUNCTION `post_article`(
article_title VARCHAR(100),
article_desc VARCHAR(500),
article_img VARCHAR(200),
article_site_name VARCHAR(50),
article_url VARCHAR(200),
username VARCHAR(30),
categories VARCHAR(300)
) RETURNS int(1)
BEGIN

-- RETURN CODES:
--  -2: article already exists for current user
-- -1: USER DOESNT EXISTS
--  1: Successfully added
--  2: article already exists, but dont exists for current user

	-- Variables
	DECLARE articleID, userID, categoryID, userArticleID INT(10) DEFAULT -1;
	DECLARE i, RET, TOKEN_NUM INT DEFAULT 0;

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
	WHERE A.URL=article_url;

	-- dont exists. add to DB
	IF (articleID<0) THEN
		INSERT INTO ARTICLE(URL,TITLE,IMG_URL,DESCRIPTION, SITE_NAME) VALUES (article_url, article_title,
		article_img, article_desc, article_site_name);

		-- get new article's id
		SELECT A.idARTICLE INTO articleID
		FROM ARTICLE A
		WHERE A.URL=article_url;

		SET RET=1;
	ELSE
		SET RET=2;
	END IF;



		-- get userArticleID
		SELECT UA.idUSER_ARTICLE INTO userArticleID
		FROM USER_ARTICLE UA
		WHERE UA.idArticle=articleID && UA.idUSER=userID;

		
	if(userArticleID<0) THEN


			-- Add user articles
			INSERT INTO USER_ARTICLE(idARTICLE, idUSER) VALUES(articleID,userID);
			
			-- newly inserted article
			if(RET=1) THEN

				-- Find counter
				SET TOKEN_NUM = (length(replace(categories, ':', concat(':', ' ')))  - length(categories));
				
				-- Add categories to article
				WHILE i <= TOKEN_NUM DO

					-- Find category ID
					SELECT C.idCATEGORY INTO categoryID
					FROM CATEGORY C
					WHERE C.NAME=(substring_index(SUBSTRING_INDEX(categories, ':', i+1), ':', -1));

					INSERT INTO ARTICLE_CATEGORY(idCATEGORY,idARTICLE) VALUES(categoryID, articleID);


					SET i = i + 1;
				END WHILE;
			END IF;

	ELSE
			SET RET=-2;
	END IF;

	RETURN RET;


END