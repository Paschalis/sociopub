
ALTER TABLE `ARTICLE_CATEGORY` 
ADD CONSTRAINT AK_Alternate_key Unique (`idARTICLE`,`idCategory`)
;
