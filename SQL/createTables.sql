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


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `paschal_socialpub` ;
CREATE SCHEMA IF NOT EXISTS `paschal_socialpub` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `paschal_socialpub` ;

-- -----------------------------------------------------
-- Table `paschal_socialpub`.`ARTICLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paschal_socialpub`.`ARTICLE` ;

CREATE  TABLE IF NOT EXISTS `paschal_socialpub`.`ARTICLE` (
  `idARTICLE` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `URL` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `TITLE` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `IMG_URL` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `DESCRIPTION` VARCHAR(300) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'Article desciption' ,
  `VIEWS` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'How many times article was viewed' ,
  `LIKES` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Likes on twitter, fb, gplus' ,
  `SHARES` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Combined tweets, shares, re-shares' ,
  PRIMARY KEY (`idARTICLE`) ,
  UNIQUE INDEX `URL_UNIQUE` (`URL` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `paschal_socialpub`.`CATEGORY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paschal_socialpub`.`CATEGORY` ;

CREATE  TABLE IF NOT EXISTS `paschal_socialpub`.`CATEGORY` (
  `idCATEGORY` INT(11) NOT NULL AUTO_INCREMENT ,
  `NAME` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`idCATEGORY`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `paschal_socialpub`.`ARTICLE_CATEGORY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paschal_socialpub`.`ARTICLE_CATEGORY` ;

CREATE  TABLE IF NOT EXISTS `paschal_socialpub`.`ARTICLE_CATEGORY` (
  `idARTICLE_CATEGORY` INT(11) NOT NULL AUTO_INCREMENT ,
  `CATEGORY_idCATEGORY` INT(11) NOT NULL ,
  `ARTICLE_idARTICLE` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idARTICLE_CATEGORY`) ,
  UNIQUE INDEX `idARTICLE_CATEGORY_UNIQUE` (`idARTICLE_CATEGORY` ASC) ,
  INDEX `fk_ARTICLE_CATEGORY_CATEGORY1_idx` (`CATEGORY_idCATEGORY` ASC) ,
  INDEX `fk_ARTICLE_CATEGORY_ARTICLE1_idx` (`ARTICLE_idARTICLE` ASC) ,
  CONSTRAINT `fk_ARTICLE_CATEGORY_CATEGORY1`
    FOREIGN KEY (`CATEGORY_idCATEGORY` )
    REFERENCES `paschal_socialpub`.`CATEGORY` (`idCATEGORY` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ARTICLE_CATEGORY_ARTICLE1`
    FOREIGN KEY (`ARTICLE_idARTICLE` )
    REFERENCES `paschal_socialpub`.`ARTICLE` (`idARTICLE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `paschal_socialpub`.`USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paschal_socialpub`.`USER` ;

CREATE  TABLE IF NOT EXISTS `paschal_socialpub`.`USER` (
  `idUSER` INT(11) NOT NULL AUTO_INCREMENT ,
  `USERNAME` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `NAME` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `SURNAME` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `COUNTRY` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `EMAIL` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`idUSER`) ,
  UNIQUE INDEX `USERNAME_UNIQUE` (`USERNAME` ASC) ,
  UNIQUE INDEX `EMAIL_UNIQUE` (`EMAIL` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `paschal_socialpub`.`USER_ARTICLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paschal_socialpub`.`USER_ARTICLE` ;

CREATE  TABLE IF NOT EXISTS `paschal_socialpub`.`USER_ARTICLE` (
  `idUSER_ARTICLE` INT(11) NOT NULL AUTO_INCREMENT ,
  `ARTICLE_idARTICLE` INT(10) UNSIGNED NOT NULL ,
  `USER_idUSER` INT(11) NOT NULL ,
  `FAVORITE` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'User has favourited the article' ,
  `LIKE` TINYINT(1) NULL DEFAULT '0' ,
  PRIMARY KEY (`idUSER_ARTICLE`) ,
  UNIQUE INDEX `idUSER_ARTICLE_UNIQUE` (`idUSER_ARTICLE` ASC) ,
  INDEX `fk_USER_ARTICLE_ARTICLE1_idx` (`ARTICLE_idARTICLE` ASC) ,
  INDEX `fk_USER_ARTICLE_USER1_idx` (`USER_idUSER` ASC) ,
  CONSTRAINT `fk_USER_ARTICLE_ARTICLE1`
    FOREIGN KEY (`ARTICLE_idARTICLE` )
    REFERENCES `paschal_socialpub`.`ARTICLE` (`idARTICLE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USER_ARTICLE_USER1`
    FOREIGN KEY (`USER_idUSER` )
    REFERENCES `paschal_socialpub`.`USER` (`idUSER` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
