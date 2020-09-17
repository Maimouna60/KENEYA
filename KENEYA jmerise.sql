#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
USE `keneya`
CREATE DATABASE `keneya`
CHARACTER SET 'utf8';

#------------------------------------------------------------
# Table: dom20_timeSlots
#------------------------------------------------------------

CREATE TABLE `dom20_timeSlots`(
        `id`       Int  Auto_increment  NOT NULL ,
        `startDate` Time NOT NULL ,
        `endTime`   Time NOT NULL
	,CONSTRAINT dom20_timeSlots_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_specialities
#------------------------------------------------------------

CREATE TABLE `dom20_specialities`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (50) NOT NULL
	,CONSTRAINT dom20_specialities_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_roles
#------------------------------------------------------------

CREATE TABLE `dom20_roles`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (50) NOT NULL
	,CONSTRAINT dom20_roles_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_users
#------------------------------------------------------------

CREATE TABLE `dom20_users`(
        `id`             Int  Auto_increment  NOT NULL ,
        `lastname`       Varchar (50) NOT NULL ,
        `firstname`      Varchar (50) NOT NULL ,
        `mail`           Varchar (255) NOT NULL ,
        `password`       Varchar (255) NOT NULL ,
        `id_dom20_roles` Int NOT NULL
	,CONSTRAINT dom20_users_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_users_dom20_roles_FK FOREIGN KEY (`id_dom20_roles`) REFERENCES dom20_roles(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_patients
#------------------------------------------------------------

CREATE TABLE `dom20_patients`(
        `id`             Int  Auto_increment  NOT NULL ,
        `birthDate`      Date NOT NULL ,
        `phoneNumbers`    Varchar (20) NOT NULL ,
        `id_dom20_users` Int NOT NULL
	,CONSTRAINT dom20_patients_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_patients_dom20_users_FK FOREIGN KEY (`id_dom20_users`) REFERENCES `dom20_users`(`id`)
	,CONSTRAINT dom20_patients_dom20_users_AK UNIQUE (`id_dom20_users`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_doctors
#------------------------------------------------------------

CREATE TABLE `dom20_doctors`(
        `id`                    Int  Auto_increment  NOT NULL ,
        `matricule`             Varchar (255) NOT NULL ,
        `speciality`            Varchar (50) NOT NULL ,
        `practicePlace`         Varchar (255) NOT NULL ,
        `price`                 Int NOT NULL ,
        `accepted`              BOOLEAN NOT NULL,
        `id_dom20_users`        Int NOT NULL ,
        `id_dom20_specialities` Int NOT NULL
	,CONSTRAINT dom20_doctors_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_doctors_dom20_users_FK FOREIGN KEY (`id_dom20_users`) REFERENCES `dom20_users`(`id`)
	,CONSTRAINT dom20_doctors_dom20_specialities0_FK FOREIGN KEY (`id_dom20_specialities`) REFERENCES `dom20_specialities`(`id`)
	,CONSTRAINT dom20_doctors_dom20_users_AK UNIQUE (`id_dom20_users`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_appointments
#------------------------------------------------------------

CREATE TABLE dom20_appointments(
        `id`                 Int  Auto_increment  NOT NULL ,
        `date`               Date NOT NULL ,
        `comment`            Text NOT NULL ,
        `id_dom20_doctors`   Int NOT NULL ,
        `id_dom20_timeSlots` Int NOT NULL ,
        `id_dom20_patients`  Int NOT NULL
	,CONSTRAINT dom20_appointments_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_appointments_dom20_doctors_FK FOREIGN KEY (`id_dom20_doctors`) REFERENCES `dom20_doctors`(`id`)
	,CONSTRAINT dom20_appointments_dom20_timeSlots0_FK FOREIGN KEY (`id_dom20_timeSlots`) REFERENCES `dom20_timeSlots`(`id`)
	,CONSTRAINT dom20_appointments_dom20_patients1_FK FOREIGN KEY (`id_dom20_patients`) REFERENCES `dom20_patients`(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_comments
#------------------------------------------------------------

CREATE TABLE `dom20_comments`(
        `id`               Int  Auto_increment  NOT NULL ,
        `content`         Text NOT NULL ,
        `linkPicture`      Varchar(255)  NOT NULL,
        `id_dom20_doctors` Int NOT NULL
	,CONSTRAINT dom20_comments_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_comments_dom20_doctors_FK FOREIGN KEY (`id_dom20_doctors`) REFERENCES `dom20_doctors`(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_reportTypes
#------------------------------------------------------------

CREATE TABLE `dom20_reportTypes`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (50) NOT NULL
	,CONSTRAINT dom20_reportTypes_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_reports
#------------------------------------------------------------

CREATE TABLE `dom20_reports`(
        `id`                  Int  Auto_increment  NOT NULL ,
        `link`                 Varchar (255) NOT NULL ,
        `date`                 Time NOT NULL ,
        `id_dom20_reportTypes` Int NOT NULL
	,CONSTRAINT dom20_reports_PK PRIMARY KEY (`id`)

	,CONSTRAINT dom20_reports_dom20_reportTypes_FK FOREIGN KEY (`id_dom20_reportTypes`) REFERENCES dom20_reportTypes(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_patientsLeftComment
#------------------------------------------------------------

CREATE TABLE `dom20_patientsLeftComment`(
        `id`                Int NOT NULL ,
        `id_dom20_comments` Int NOT NULL
	,CONSTRAINT dom20_patientsLeftComment_PK PRIMARY KEY (`id`,`id_dom20_comments`)

	,CONSTRAINT dom20_patientsLeftComment_dom20_patients_FK FOREIGN KEY (`id`) REFERENCES dom20_patients(`id`)
	,CONSTRAINT dom20_patientsLeftComment_dom20_comments0_FK FOREIGN KEY (`id_dom20_comments`) REFERENCES dom20_comments(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dom20_doctorsLeftDocument
#------------------------------------------------------------

CREATE TABLE `dom20_doctorsLeftDocument`(
        `id`              Int NOT NULL ,
        `id_dom20_reports` Int NOT NULL
	,CONSTRAINT dom20_doctorsLeftDocument_PK PRIMARY KEY (`id`,`id_dom20_reports`)

	,CONSTRAINT dom20_doctorsLeftDocument_dom20_doctors_FK FOREIGN KEY (`id`) REFERENCES `dom20_doctors`(`id`)
	,CONSTRAINT dom20_doctorsLeftDocument_dom20_reports0_FK FOREIGN KEY (`id_dom20_reports`) REFERENCES `dom20_reports`(`id`)
)ENGINE=InnoDB;


-- table user
SELECT `use`.`lastname`,`use`.`firstname`,`use`.`mail`, `use`.`password`
FROM `dom20_users` AS `use`
INNER JOIN `dom20_roles` AS `role`
ON `use`.`id_dom20_roles`  
ORDER BY `role`.`use` ASC;
--