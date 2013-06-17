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

CREATE DEFINER=`paschal_sp`@`%` PROCEDURE `get_user_articles`(
username VARCHAR(30),
q VARCHAR(200)
)
BEGIN

DECLARE likes INT DEFAULT 0;

-- SET likes = CALL ;
-- CONVERT(column USING utf8) 
SELECT A.*,UA.TIME, BIN(UA.LIKED+0) AS LIKED, BIN(UA.READ_LATER+0) AS READ_LATER, BIN(UA.VIEWED+0) AS VIEWED,  GROUP_CONCAT(C.NAME) AS CATEGORY,
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
WHERE A.idARTICLE=AC.idARTICLE AND AC.idCATEGORY = C.idCATEGORY AND
UA.idARTICLE=A.idARTICLE AND UA.idUSER=U.idUSER AND U.USERNAME=username AND
(A.TITLE LIKE CONCAT('%', q, '%') || A.DESCRIPTION LIKE CONCAT('%', q, '%') || A.URL LIKE CONCAT('%', q, '%') ) 
GROUP BY A.idARTICLE
;

END