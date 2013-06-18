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

CREATE DEFINER=`paschal_sp`@`%` PROCEDURE `get_articles`()
BEGIN

DECLARE likes INT DEFAULT 0;

-- SET likes = CALL ;

SELECT A.*,GROUP_CONCAT(C.NAME) AS CATEGORY,
-- likes
(
SELECT COUNT(*)
FROM USER_ARTICLE UA
WHERE UA.idARTICLE=A.idARTICLE AND UA.LIKED=1
) AS LIKES,
-- favorites
(
SELECT COUNT(*)
FROM USER_ARTICLE UA
WHERE UA.idARTICLE=A.idARTICLE AND UA.FAVORITED=1
) AS FAVORITES,
-- watches
(
SELECT COUNT(*)
FROM USER_ARTICLE UA
WHERE UA.idARTICLE=A.idARTICLE AND UA.WATCHED=1
) AS WATCHES,
-- shares (in socio pub)
(
SELECT COUNT(*)
FROM USER_ARTICLE UA
WHERE UA.idARTICLE=A.idARTICLE
) AS SHARES


FROM ARTICLE A, ARTICLE_CATEGORY AC,  CATEGORY C
WHERE A.idARTICLE=AC.idARTICLE AND AC.idCATEGORY = C.idCATEGORY
GROUP BY A.idARTICLE
;

END