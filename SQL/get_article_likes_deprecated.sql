-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`paschal_sp`@`%` PROCEDURE `get_article_likes`(
article_id INT(10))
BEGIN

SELECT COUNT(*) AS LIKES
FROM USER_ARTICLE UA
WHERE UA.idArticle=article_id AND UA.LIKED=1;

END