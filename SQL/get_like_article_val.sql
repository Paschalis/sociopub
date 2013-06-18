--	Copyright 2013, Internet Technologies course (code epl425) Team, at Computer Science Dept., University of Cyprus,
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

CREATE DEFINER=`paschal_sp`@`%` FUNCTION `get_like_article_val`(
article_id INT(10),
username VARCHAR(30)
) RETURNS int(1)
BEGIN
-- RETURN CODES:
--  -2: article NOT exists
-- -1: USER DOESNT EXISTS
--  -3: User_article NOT exists
--  0/1: Successfully return liked/unliked value

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
		
	RETURN like_val;
END