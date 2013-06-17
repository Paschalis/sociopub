--	Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,
--
--    Members:
--    Dr. Marios Dikaiakos,
--    Dimitris Christofi, Paschalis Mpeis, Pampos Charalambous.
--
--	Licensed under the Apache License, Version 2.0 (the "License");
--	you may not use this file except in compliance with the License.
--	You may obtain a copy of the License at
--
--	http://www.apache.org/licenses/LICENSE-2.0
--
--	Unless required by applicable law or agreed to in writing, software
--	distributed under the License is distributed on an "AS IS" BASIS,
--	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
--	See the License for the specific language governing permissions and
--	limitations under the License.
--

-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` PROCEDURE `post_users_article`(
article_title VARCHAR(100),
article_desc VARCHAR(500),
article_img VARCHAR(200),
article_site_name VARCHAR(50),
article_url VARCHAR(200),
username VARCHAR(30),
categories VARCHAR(300)
)
BEGIN

-- RETURN CODES:

--  RESULT: -2: article already exists for current user
--  RESULT:  -1: USER DOESNT EXISTS
--  RESULT:  1: Successfully added
--  RESULT:  2: article already exists, but dont exists for current user

	-- Variables
	DECLARE articleID, userID, categoryID, userArticleID INT(10) DEFAULT -1;
	DECLARE i, RET, TOKEN_NUM INT DEFAULT 0;

	-- Get username
	SELECT U.idUSER INTO userID  
	FROM USER U
	WHERE U.USERNAME=username;

	-- user doesnt exists
	IF (userID<0) THEN
		SELECT "-1" AS RESULT;
	ELSE
		-- user exists
				-- get articleID if exists
			SELECT A.idARTICLE INTO articleID
			FROM ARTICLE A
			WHERE A.URL=article_url;

			-- article dont exists. add to DB
			IF (articleID<0) THEN
				INSERT INTO ARTICLE(URL,TITLE,IMG_URL,DESCRIPTION, SITE_NAME) VALUES (article_url, article_title,
				article_img, article_desc, article_site_name);

				-- get new article's id
				SELECT A.idARTICLE INTO articleID
				FROM ARTICLE A
				WHERE A.URL=article_url;

				SET RET=1;
			-- article exists(added by another user)
			ELSE
				SET RET=2;
			END IF;



				-- get userArticleID
			SELECT UA.idUSER_ARTICLE INTO userArticleID
			FROM USER_ARTICLE UA
			WHERE UA.idArticle=articleID && UA.idUSER=userID;

			-- user article doesnt exists (good!)
			if(userArticleID<0) THEN


					-- Add user article
					INSERT INTO USER_ARTICLE(idARTICLE, idUSER) VALUES(articleID,userID);
					
					-- if newly inserted article
					if(RET=1) THEN

						-- Find counter
						SET TOKEN_NUM = (length(replace(categories, ':', concat(':', ' ')))  - length(categories));
						
						-- Add categories to article too
						WHILE i <= TOKEN_NUM DO

							-- Find category ID
							SELECT C.idCATEGORY INTO categoryID
							FROM CATEGORY C
							WHERE C.NAME=(substring_index(SUBSTRING_INDEX(categories, ':', i+1), ':', -1));

							INSERT INTO ARTICLE_CATEGORY(idCATEGORY,idARTICLE) VALUES(categoryID, articleID);


							SET i = i + 1;
						END WHILE;
					END IF;

					-- return article data with result code
					SELECT RET AS RESULT, A.*,UA.TIME, BIN(UA.LIKED+0) AS LIKED, BIN(UA.READ_LATER+0) AS READ_LATER, BIN(UA.VIEWED+0) AS VIEWED,  GROUP_CONCAT(C.NAME) AS CATEGORY,
					-- likes
					(
					SELECT COUNT(*)
					FROM USER_ARTICLE UA
					WHERE UA.idARTICLE=A.idARTICLE AND UA.LIKED=1
					) AS LIKES,
					-- views
					(
					SELECT COUNT(*)
					FROM USER_ARTICLE UA
					WHERE UA.idARTICLE=A.idARTICLE AND UA.VIEWED=1
					) AS VIEWS,
					-- shares (in socio pub)
					(
					SELECT COUNT(*)
					FROM USER_ARTICLE UA
					WHERE UA.idARTICLE=A.idARTICLE
					) AS SHARES

					FROM ARTICLE A, ARTICLE_CATEGORY AC,  CATEGORY C, USER_ARTICLE UA, USER U
					WHERE  A.idARTICLE=articleID AND A.idARTICLE=AC.idARTICLE AND AC.idCATEGORY = C.idCATEGORY AND
					UA.idARTICLE=A.idARTICLE AND UA.idUSER=U.idUSER AND U.USERNAME=username
					GROUP BY A.idARTICLE
					;


			ELSE
					SELECT '-2' AS RESULT;
			END IF;


			
			-- RETURN RET;

	END IF;-- end of user exists

	

END