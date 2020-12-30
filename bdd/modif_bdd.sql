DROP TABLE IF EXISTS IMAGE;

DROP TABLE IF EXISTS UTILISATEUR;

DROP TABLE IF EXISTS MARQUE;

DROP TABLE IF EXISTS LOG;

DROP TABLE IF EXISTS INSTRUMENT;

DROP TABLE IF EXISTS NOTES;

DROP TABLE IF EXISTS VILLE;

DROP TABLE IF EXISTS MESSAGE;

DROP TABLE IF EXISTS CATEGORIE;

DROP TABLE IF EXISTS PLANNING;

DROP TABLE IF EXISTS RESERVER;

DROP TABLE IF EXISTS REPRESENTER;

# -----------------------------------------------------------------------------
#       TABLE : IMAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGE
 (
   IMA_NUM CHAR(32) NOT NULL  ,
   IMA_CONTENU CHAR(32) NOT NULL  ,
   MAR_DATE_AJOUT CHAR(32) NOT NULL  
   , PRIMARY KEY (IMA_NUM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEUR
 (
   UTI_NUMERO INT(4) NOT NULL  ,
   VIL_NUMERO INT(4) NOT NULL  ,
   UTI_PSEUDO CHAR(32) NOT NULL  ,
   UTI_NOM CHAR(32) NOT NULL  ,
   UTI_PRENOM CHAR(32) NOT NULL  ,
   UTI_DATE_NAISSANCE DATE NOT NULL  ,
   UTI_DATE_INSCRIPTION DATE NOT NULL  ,
   UTI_EMAIL CHAR(32) NOT NULL  ,
   UTI_MDP CHAR(32) NOT NULL  ,
   UTI_PORTABLE CHAR(32) NOT NULL  ,
   UTI_TEL_FIXE CHAR(32) NULL  ,
   UTI_PORTABLE_2 CHAR(32) NULL  
   , PRIMARY KEY (UTI_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE UTILISATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_UTILISATEUR_VILLE
     ON UTILISATEUR (VIL_NUMERO ASC);

# -----------------------------------------------------------------------------
#       TABLE : MARQUE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MARQUE
 (
   MAR_NUMERO INT(4) NOT NULL  ,
   MAR_NOM CHAR(32) NOT NULL  ,
   MAR_DATE_AJOUT DATE NOT NULL  
   , PRIMARY KEY (MAR_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOG
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOG
 (
   LOG_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO INT(4) NOT NULL  ,
   LOG_DATE DATE NOT NULL  ,
   LOG_TYPE CHAR(32) NOT NULL  
   , PRIMARY KEY (LOG_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOG
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOG_UTILISATEUR
     ON LOG (UTI_NUMERO ASC);

# -----------------------------------------------------------------------------
#       TABLE : INSTRUMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INSTRUMENT
 (
   INS_NUMERO INT(4) NOT NULL  ,
   MAR_NUMERO INT(4) NOT NULL  ,
   VIL_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO INT(4) NOT NULL  ,
   CAT_NUMERO INT(4) NOT NULL  ,
   INS_NOM CHAR(32) NOT NULL  ,
   INS_DESCRIPTION CHAR(32) NULL  ,
   INS_DISPONIBLE CHAR(32) NOT NULL  ,
   IN_DATE_AJOUT DATE NOT NULL  ,
   INS_PRIX FLOAT(4,2) NULL  
   , PRIMARY KEY (INS_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE INSTRUMENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_INSTRUMENT_MARQUE
     ON INSTRUMENT (MAR_NUMERO ASC);

CREATE  INDEX I_FK_INSTRUMENT_VILLE
     ON INSTRUMENT (VIL_NUMERO ASC);

CREATE  INDEX I_FK_INSTRUMENT_UTILISATEUR
     ON INSTRUMENT (UTI_NUMERO ASC);

CREATE  INDEX I_FK_INSTRUMENT_CATEGORIE
     ON INSTRUMENT (CAT_NUMERO ASC);

# -----------------------------------------------------------------------------
#       TABLE : NOTES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NOTES
 (
   NOT_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO_RECEVOIR_NOTE INT(4) NOT NULL  ,
   NO_NB_ETOILE INT(4) NOT NULL  ,
   NOT_DATE DATE NOT NULL  ,
   NOT_COMMENTAIRE CHAR(100) NULL  
   , PRIMARY KEY (NOT_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE NOTES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_NOTES_UTILISATEUR
     ON NOTES (UTI_NUMERO ASC);

CREATE  INDEX I_FK_NOTES_UTILISATEUR1
     ON NOTES (UTI_NUMERO_RECEVOIR_NOTE ASC);

# -----------------------------------------------------------------------------
#       TABLE : VILLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VILLE
 (
   VIL_NUMERO INT(4) NOT NULL  ,
   VIL_NOM CHAR(32) NOT NULL  ,
   VIL_CP CHAR(32) NOT NULL  ,
   VIL_LATTITUDE CHAR(32) NOT NULL  ,
   VIL_LONGITUDE CHAR(32) NOT NULL  
   , PRIMARY KEY (VIL_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : MESSAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MESSAGE
 (
   MSG_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO_ENVOYER CHAR(32) NOT NULL  ,
   MSG_DATE_ENVOI CHAR(32) NOT NULL  ,
   MSG_DATE_OUVERTURE CHAR(32) NULL  ,
   MSG_CONTENU CHAR(32) NOT NULL  
   , PRIMARY KEY (MSG_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE MESSAGE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_MESSAGE_UTILISATEUR
     ON MESSAGE (UTI_NUMERO ASC);

CREATE  INDEX I_FK_MESSAGE_UTILISATEUR1
     ON MESSAGE (UTI_NUMERO_ENVOYER ASC);

# -----------------------------------------------------------------------------
#       TABLE : CATEGORIE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIE
 (
   CAT_NUMERO INT(4) NOT NULL  ,
   CAT_NOM CHAR(32) NOT NULL  ,
   CAT_FAMILLE CHAR(32) NULL  
   , PRIMARY KEY (CAT_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PLANNING
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PLANNING
 (
   PLA_NUMERO INT(4) NOT NULL  ,
   INS_NUMERO INT(4) NOT NULL  ,
   PLA_DEBUT CHAR(32) NOT NULL  ,
   PLA_FIN CHAR(32) NULL  
   , PRIMARY KEY (PLA_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PLANNING
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PLANNING_INSTRUMENT
     ON PLANNING (INS_NUMERO ASC);

# -----------------------------------------------------------------------------
#       TABLE : RESERVER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RESERVER
 (
   PLA_NUMERO INT(4) NOT NULL  ,
   INS_NUMERO INT(4) NOT NULL  ,
   UTI_NUMERO INT(4) NOT NULL  ,
   RES_DATE DATE NOT NULL  ,
   RES_ETAT CHAR(32) NULL  
   , PRIMARY KEY (PLA_NUMERO,INS_NUMERO,UTI_NUMERO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RESERVER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RESERVER_PLANNING
     ON RESERVER (PLA_NUMERO ASC);

CREATE  INDEX I_FK_RESERVER_INSTRUMENT
     ON RESERVER (INS_NUMERO ASC);

CREATE  INDEX I_FK_RESERVER_UTILISATEUR
     ON RESERVER (UTI_NUMERO ASC);

# -----------------------------------------------------------------------------
#       TABLE : REPRESENTER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REPRESENTER
 (
   INS_NUMERO INT(4) NOT NULL  ,
   IMA_NUM CHAR(32) NOT NULL  
   , PRIMARY KEY (INS_NUMERO,IMA_NUM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE REPRESENTER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_REPRESENTER_INSTRUMENT
     ON REPRESENTER (INS_NUMERO ASC);

CREATE  INDEX I_FK_REPRESENTER_IMAGE
     ON REPRESENTER (IMA_NUM ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE UTILISATEUR 
  ADD FOREIGN KEY FK_UTILISATEUR_VILLE (VIL_NUMERO)
      REFERENCES VILLE (VIL_NUMERO) ;


ALTER TABLE LOG 
  ADD FOREIGN KEY FK_LOG_UTILISATEUR (UTI_NUMERO)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE INSTRUMENT 
  ADD FOREIGN KEY FK_INSTRUMENT_MARQUE (MAR_NUMERO)
      REFERENCES MARQUE (MAR_NUMERO) ;


ALTER TABLE INSTRUMENT 
  ADD FOREIGN KEY FK_INSTRUMENT_VILLE (VIL_NUMERO)
      REFERENCES VILLE (VIL_NUMERO) ;


ALTER TABLE INSTRUMENT 
  ADD FOREIGN KEY FK_INSTRUMENT_UTILISATEUR (UTI_NUMERO)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE INSTRUMENT 
  ADD FOREIGN KEY FK_INSTRUMENT_CATEGORIE (CAT_NUMERO)
      REFERENCES CATEGORIE (CAT_NUMERO) ;


ALTER TABLE NOTES 
  ADD FOREIGN KEY FK_NOTES_UTILISATEUR (UTI_NUMERO)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE NOTES 
  ADD FOREIGN KEY FK_NOTES_UTILISATEUR1 (UTI_NUMERO_RECEVOIR_NOTE)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE MESSAGE 
  ADD FOREIGN KEY FK_MESSAGE_UTILISATEUR (UTI_NUMERO)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE MESSAGE 
  ADD FOREIGN KEY FK_MESSAGE_UTILISATEUR1 (UTI_NUMERO_ENVOYER)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE PLANNING 
  ADD FOREIGN KEY FK_PLANNING_INSTRUMENT (INS_NUMERO)
      REFERENCES INSTRUMENT (INS_NUMERO) ;


ALTER TABLE RESERVER 
  ADD FOREIGN KEY FK_RESERVER_PLANNING (PLA_NUMERO)
      REFERENCES PLANNING (PLA_NUMERO) ;


ALTER TABLE RESERVER 
  ADD FOREIGN KEY FK_RESERVER_INSTRUMENT (INS_NUMERO)
      REFERENCES INSTRUMENT (INS_NUMERO) ;


ALTER TABLE RESERVER 
  ADD FOREIGN KEY FK_RESERVER_UTILISATEUR (UTI_NUMERO)
      REFERENCES UTILISATEUR (UTI_NUMERO) ;


ALTER TABLE REPRESENTER 
  ADD FOREIGN KEY FK_REPRESENTER_INSTRUMENT (INS_NUMERO)
      REFERENCES INSTRUMENT (INS_NUMERO) ;


ALTER TABLE REPRESENTER 
  ADD FOREIGN KEY FK_REPRESENTER_IMAGE (IMA_NUM)
      REFERENCES IMAGE (IMA_NUM) ;

