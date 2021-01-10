-- Test des différentes tables de la base de données--

--Table Instrument--

--Test 1: Instrument disponible--
select * from Instrument where ins_disponible = "oui"; 

-- Test 2: Jointure Instrument et Marque + nom Marque--
select * from Instrument join marque using(mar_numero); 
select * from instrument join marque using(mar_numero) where mar_nom = 'Yamaha';

--Test 3: Jointure Instrument et Catégorie--
select * from Instrument join Categorie using(cat_numero);

--Test 4: Jointure Instrument et Ville--
select * from Instrument join Ville using(vil_numero);

--Test 5: Jointure Instruments et Utilisateur--
select * from Instrument join Utilisateur using(uti_numero);

--Test 5.2: Instrument réservé par les utilisateurs--
select * from Reserver join Utilisateur using(uti_numero) join Instrument using(ins_numero);

--Test 6: Instrument représenté par une image--
select * from representer join Instrument using(ins_numero) join image(ima_num);

-----------------------------------------------------------------------------------------
--Table Utilisateur--

--Test 1: Jointure Utilisateur et Ville--
select * from Utilisateur join Ville using(vil_numero);

--Test 2: Jointure Utilisateur et Message--
select * from Utilisateur join Message using(uti_numero);

-----------------------------------------------------------------------------------------
--Nombres d'instruments:
--en tout
select count(*) from INSTRUMENT;

--par type
select count(*) from INSTRUMENT where MAR_NUMERO = 2 --Marque 2 = Yamaha

--compter les marques différentes
select count(MAR_NUMERO) as nb_marques from INSTRUMENT 
where MAR_NUMERO is not null group by(MAR_NUMERO); -- 2 Marque 2, 2 Marque 1, reste à 1


-- Recherche le nom dont le prix de location est différent de zéro
select upper(INS_NOM) ins_nom, round(avg(INS_PRIX),2) prix_moy from INSTRUMENT 
where INS_NOM is not null group by upper(INS_NOM) having avg(INS_PRIX)>0;