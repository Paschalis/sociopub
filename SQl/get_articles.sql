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