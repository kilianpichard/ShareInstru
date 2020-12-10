-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                      Oracle Version 10g
--                        (10/12/2020 12:06:54)
-- -----------------------------------------------------------------------------
--      Nom de la base : MLR1
--      Projet : Accueil WinDesign V17
--      Auteur : MASSALY
--      Date de dernière modification : 10/12/2020 12:05:47
-- -----------------------------------------------------------------------------

DROP TABLE IMAGE CASCADE CONSTRAINTS;

DROP TABLE UTILISATEUR CASCADE CONSTRAINTS;

DROP TABLE MARQUE CASCADE CONSTRAINTS;

DROP TABLE LOG CASCADE CONSTRAINTS;

DROP TABLE INSTRUMENT CASCADE CONSTRAINTS;

DROP TABLE NOTES CASCADE CONSTRAINTS;

DROP TABLE VILLE CASCADE CONSTRAINTS;

DROP TABLE MESSAGE CASCADE CONSTRAINTS;

DROP TABLE CATEGORIE CASCADE CONSTRAINTS;

DROP TABLE PLANNING CASCADE CONSTRAINTS;

DROP TABLE RESERVER CASCADE CONSTRAINTS;

DROP TABLE REPRESENTER CASCADE CONSTRAINTS;

-- -----------------------------------------------------------------------------
--       TABLE : IMAGE
-- -----------------------------------------------------------------------------

CREATE TABLE IMAGE
   (
    IMA_NUM char(32)  NOT NULL,
    IMA_CONTENU char(32)  NOT NULL,
    MAR_DATE_AJOUT char(32)  NOT NULL
,   CONSTRAINT PK_IMAGE PRIMARY KEY (IMA_NUM)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE UTILISATEUR
   (
    UTI_NUMERO char(32)  NOT NULL,
    VIL_NUMERO char(32)  NOT NULL,
    UTI_PSEUDO char(32)  NOT NULL,
    UTI_NOM char(32)  NOT NULL,
    UTI_PRENOM char(32)  NOT NULL,
    UTI_DATE_NAISSANCE char(32)  NOT NULL,
    UTI_DATE_INSCRIPTION char(32)  NOT NULL,
    UTI_EMAIL char(32)  NOT NULL,
    UTI_MDP char(32)  NOT NULL,
    UTI_PORTABLE char(32)  NOT NULL,
    UTI_TEL_FIXE char(32)  NULL,
    UTI_PORTABLE_2 char(32)  NULL
,   CONSTRAINT PK_UTILISATEUR PRIMARY KEY (UTI_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_UTILISATEUR_VILLE
     ON UTILISATEUR (VIL_NUMERO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : MARQUE
-- -----------------------------------------------------------------------------

CREATE TABLE MARQUE
   (
    MAR_NUMERO char(32)  NOT NULL,
    MAR_NOM char(32)  NOT NULL,
    MAR_DATE_AJOUT char(32)  NOT NULL
,   CONSTRAINT PK_MARQUE PRIMARY KEY (MAR_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : LOG
-- -----------------------------------------------------------------------------

CREATE TABLE LOG
   (
    LOG_NUMERO char(32)  NOT NULL,
    UTI_NUMERO char(32)  NOT NULL,
    LOG_DATE char(32)  NOT NULL,
    LOG_TYPE char(32)  NOT NULL
,   CONSTRAINT PK_LOG PRIMARY KEY (LOG_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE LOG
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_LOG_UTILISATEUR
     ON LOG (UTI_NUMERO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : INSTRUMENT
-- -----------------------------------------------------------------------------

CREATE TABLE INSTRUMENT
   (
    INS_NUMERO char(32)  NOT NULL,
    MAR_NUMERO char(32)  NOT NULL,
    VIL_NUMERO char(32)  NOT NULL,
    UTI_NUMERO char(32)  NOT NULL,
    CAT_NUMERO char(32)  NOT NULL,
    INS_NOM char(32)  NOT NULL,
    INS_DESCRIPTION char(32)  NULL,
    INS_DISPONIBLE char(32)  NOT NULL,
    IN_DATE_AJOUT char(32)  NOT NULL,
    INS_PRIX char(32)  NULL
,   CONSTRAINT PK_INSTRUMENT PRIMARY KEY (INS_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE INSTRUMENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_INSTRUMENT_MARQUE
     ON INSTRUMENT (MAR_NUMERO ASC)
    ;

CREATE  INDEX I_FK_INSTRUMENT_VILLE
     ON INSTRUMENT (VIL_NUMERO ASC)
    ;

CREATE  INDEX I_FK_INSTRUMENT_UTILISATEUR
     ON INSTRUMENT (UTI_NUMERO ASC)
    ;

CREATE  INDEX I_FK_INSTRUMENT_CATEGORIE
     ON INSTRUMENT (CAT_NUMERO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : NOTES
-- -----------------------------------------------------------------------------

CREATE TABLE NOTES
   (
    NOT_NUMERO char(32)  NOT NULL,
    UTI_NUMERO char(32)  NOT NULL,
    UTI_NUMERO_RECEVOIR_NOTE char(32)  NOT NULL,
    NO_NB_ETOILE char(32)  NOT NULL,
    NOT_DATE char(32)  NOT NULL,
    NOT_COMMENTAIRE char(32)  NULL
,   CONSTRAINT PK_NOTES PRIMARY KEY (NOT_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE NOTES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_NOTES_UTILISATEUR
     ON NOTES (UTI_NUMERO ASC)
    ;

CREATE  INDEX I_FK_NOTES_UTILISATEUR1
     ON NOTES (UTI_NUMERO_RECEVOIR_NOTE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : VILLE
-- -----------------------------------------------------------------------------

CREATE TABLE VILLE
   (
    VIL_NUMERO char(32)  NOT NULL,
    VIL_NOM char(32)  NOT NULL,
    VIL_CP char(32)  NOT NULL,
    VIL_LATTITUDE char(32)  NOT NULL,
    VIL_LONGITUDE char(32)  NOT NULL
,   CONSTRAINT PK_VILLE PRIMARY KEY (VIL_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : MESSAGE
-- -----------------------------------------------------------------------------

CREATE TABLE MESSAGE
   (
    MSG_NUMERO char(32)  NOT NULL,
    UTI_NUMERO char(32)  NOT NULL,
    UTI_NUMERO_ENVOYER char(32)  NOT NULL,
    MSG_DATE_ENVOI char(32)  NOT NULL,
    MSG_DATE_OUVERTURE char(32)  NULL,
    MSG_CONTENU char(32)  NOT NULL
,   CONSTRAINT PK_MESSAGE PRIMARY KEY (MSG_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE MESSAGE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_MESSAGE_UTILISATEUR
     ON MESSAGE (UTI_NUMERO ASC)
    ;

CREATE  INDEX I_FK_MESSAGE_UTILISATEUR1
     ON MESSAGE (UTI_NUMERO_ENVOYER ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CATEGORIE
-- -----------------------------------------------------------------------------

CREATE TABLE CATEGORIE
   (
    CAT_NUMERO char(32)  NOT NULL,
    CAT_NOM char(32)  NOT NULL,
    CAT_FAMILLE char(32)  NULL
,   CONSTRAINT PK_CATEGORIE PRIMARY KEY (CAT_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PLANNING
-- -----------------------------------------------------------------------------

CREATE TABLE PLANNING
   (
    PLA_NUMERO char(32)  NOT NULL,
    INS_NUMERO char(32)  NOT NULL,
    PLA_DEBUT char(32)  NOT NULL,
    PLA_FIN char(32)  NULL
,   CONSTRAINT PK_PLANNING PRIMARY KEY (PLA_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PLANNING
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PLANNING_INSTRUMENT
     ON PLANNING (INS_NUMERO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : RESERVER
-- -----------------------------------------------------------------------------

CREATE TABLE RESERVER
   (
    PLA_NUMERO char(32)  NOT NULL,
    INS_NUMERO char(32)  NOT NULL,
    UTI_NUMERO char(32)  NOT NULL,
    RES_DATE char(32)  NOT NULL,
    RES_ETAT char(32)  NULL
,   CONSTRAINT PK_RESERVER PRIMARY KEY (PLA_NUMERO, INS_NUMERO, UTI_NUMERO)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE RESERVER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_RESERVER_PLANNING
     ON RESERVER (PLA_NUMERO ASC)
    ;

CREATE  INDEX I_FK_RESERVER_INSTRUMENT
     ON RESERVER (INS_NUMERO ASC)
    ;

CREATE  INDEX I_FK_RESERVER_UTILISATEUR
     ON RESERVER (UTI_NUMERO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : REPRESENTER
-- -----------------------------------------------------------------------------

CREATE TABLE REPRESENTER
   (
    INS_NUMERO char(32)  NOT NULL,
    IMA_NUM char(32)  NOT NULL
,   CONSTRAINT PK_REPRESENTER PRIMARY KEY (INS_NUMERO, IMA_NUM)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE REPRESENTER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_REPRESENTER_INSTRUMENT
     ON REPRESENTER (INS_NUMERO ASC)
    ;

CREATE  INDEX I_FK_REPRESENTER_IMAGE
     ON REPRESENTER (IMA_NUM ASC)
    ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE UTILISATEUR ADD (
     CONSTRAINT FK_UTILISATEUR_VILLE
          FOREIGN KEY (VIL_NUMERO)
               REFERENCES VILLE (VIL_NUMERO))   ;

ALTER TABLE LOG ADD (
     CONSTRAINT FK_LOG_UTILISATEUR
          FOREIGN KEY (UTI_NUMERO)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE INSTRUMENT ADD (
     CONSTRAINT FK_INSTRUMENT_MARQUE
          FOREIGN KEY (MAR_NUMERO)
               REFERENCES MARQUE (MAR_NUMERO))   ;

ALTER TABLE INSTRUMENT ADD (
     CONSTRAINT FK_INSTRUMENT_VILLE
          FOREIGN KEY (VIL_NUMERO)
               REFERENCES VILLE (VIL_NUMERO))   ;

ALTER TABLE INSTRUMENT ADD (
     CONSTRAINT FK_INSTRUMENT_UTILISATEUR
          FOREIGN KEY (UTI_NUMERO)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE INSTRUMENT ADD (
     CONSTRAINT FK_INSTRUMENT_CATEGORIE
          FOREIGN KEY (CAT_NUMERO)
               REFERENCES CATEGORIE (CAT_NUMERO))   ;

ALTER TABLE NOTES ADD (
     CONSTRAINT FK_NOTES_UTILISATEUR
          FOREIGN KEY (UTI_NUMERO)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE NOTES ADD (
     CONSTRAINT FK_NOTES_UTILISATEUR1
          FOREIGN KEY (UTI_NUMERO_RECEVOIR_NOTE)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE MESSAGE ADD (
     CONSTRAINT FK_MESSAGE_UTILISATEUR
          FOREIGN KEY (UTI_NUMERO)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE MESSAGE ADD (
     CONSTRAINT FK_MESSAGE_UTILISATEUR1
          FOREIGN KEY (UTI_NUMERO_ENVOYER)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE PLANNING ADD (
     CONSTRAINT FK_PLANNING_INSTRUMENT
          FOREIGN KEY (INS_NUMERO)
               REFERENCES INSTRUMENT (INS_NUMERO))   ;

ALTER TABLE RESERVER ADD (
     CONSTRAINT FK_RESERVER_PLANNING
          FOREIGN KEY (PLA_NUMERO)
               REFERENCES PLANNING (PLA_NUMERO))   ;

ALTER TABLE RESERVER ADD (
     CONSTRAINT FK_RESERVER_INSTRUMENT
          FOREIGN KEY (INS_NUMERO)
               REFERENCES INSTRUMENT (INS_NUMERO))   ;

ALTER TABLE RESERVER ADD (
     CONSTRAINT FK_RESERVER_UTILISATEUR
          FOREIGN KEY (UTI_NUMERO)
               REFERENCES UTILISATEUR (UTI_NUMERO))   ;

ALTER TABLE REPRESENTER ADD (
     CONSTRAINT FK_REPRESENTER_INSTRUMENT
          FOREIGN KEY (INS_NUMERO)
               REFERENCES INSTRUMENT (INS_NUMERO))   ;

ALTER TABLE REPRESENTER ADD (
     CONSTRAINT FK_REPRESENTER_IMAGE
          FOREIGN KEY (IMA_NUM)
               REFERENCES IMAGE (IMA_NUM))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------