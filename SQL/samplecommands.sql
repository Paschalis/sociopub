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


ALTER TABLE ARTICLE_CATEGORY ADD FOREIGN KEY 
fk_categoryid (idCATEGORY) 
REFERENCES ARTICLE (idARTICLE);

ALTER TABLE `paschal_socialpub`.`ARTICLE_CATEGORY` 
  ADD CONSTRAINT `fk_ARTICLE_CATEGORY_1`
  FOREIGN KEY (`idARTICLE` )
  REFERENCES `paschal_socialpub`.`ARTICLE` (`idARTICLE` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_ARTICLE_CATEGORY_1_idx` (`idARTICLE` ASC)

