-- Test des différentes tables de la base de données--

--Table Instrument--

--Test 1: Instrument disponible--
select * from Instrument where ins_dipos = "oui"; 

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
select * from representer joi Instrument using(ins_numero) join image(ima_num);

-----------------------------------------------------------------------------------------
--Table Utilisateur--

--Test 1: Jointure Utilisateur et Ville--
select * from Utilisateur join Ville using(vil_numero);

--Test 2: Jointure Utilisateur et Message--
select * from Utilisateur join Message using(uti_numero);