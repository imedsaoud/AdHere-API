#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP database IF EXISTS adhere;
create database adhere;
use adhere;


#------------------------------------------------------------
# Table: Station
#------------------------------------------------------------

CREATE TABLE Station(
        id        Int  Auto_increment  NOT NULL ,
        name      Char (150) ,
        lt        Float NOT NULL ,
        lng       Float NOT NULL ,
        affluence Int NOT NULL
	,CONSTRAINT Station_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Federation
#------------------------------------------------------------

CREATE TABLE Federation(
        id    Int  Auto_increment  NOT NULL ,
        name  Char (50) NOT NULL ,
        count Int NOT NULL
	,CONSTRAINT Federation_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Events
#------------------------------------------------------------

CREATE TABLE Events(
        id            Int  Auto_increment  NOT NULL ,
        date_start    Date ,
        date_end      Date ,
        geo_name      Char (120) NOT NULL ,
        geo_lat       Float NOT NULL ,
        geo_lng       Float NOT NULL ,
        spectator     Int NOT NULL ,
        id_Federation Int NOT NULL
	,CONSTRAINT Events_PK PRIMARY KEY (id)

	,CONSTRAINT Events_Federation_FK FOREIGN KEY (id_Federation) REFERENCES Federation(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Station_distance_event
#------------------------------------------------------------

CREATE TABLE Station_distance_event(
        id         Int  Auto_increment  NOT NULL ,
        distance_m Float NOT NULL ,
        id_Station Int NOT NULL ,
        id_Events  Int NOT NULL
	,CONSTRAINT Station_distance_event_PK PRIMARY KEY (id)

	,CONSTRAINT Station_distance_event_Station_FK FOREIGN KEY (id_Station) REFERENCES Station(id)
	,CONSTRAINT Station_distance_event_Events0_FK FOREIGN KEY (id_Events) REFERENCES Events(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: federation_sexe_age_range
#------------------------------------------------------------

CREATE TABLE federation_sexe_age_range(
        id            Int  Auto_increment  NOT NULL ,
        age_range     Varchar (40) NOT NULL ,
        sexe          Varchar (1) NOT NULL ,
        count         Int NOT NULL ,
        id_Federation Int NOT NULL
	,CONSTRAINT federation_sexe_age_range_PK PRIMARY KEY (id)

	,CONSTRAINT federation_sexe_age_range_Federation_FK FOREIGN KEY (id_Federation) REFERENCES Federation(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: federation_csp
#------------------------------------------------------------

CREATE TABLE federation_csp(
        id          Int  Auto_increment  NOT NULL ,
        ouvrier     Float NOT NULL ,
        agriculteur Float NOT NULL ,
        inactif     Float NOT NULL ,
        employe     Float NOT NULL ,
        retraite    Float NOT NULL ,
        cadre       Float NOT NULL ,
        profinter   Float NOT NULL
	,CONSTRAINT federation_csp_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

