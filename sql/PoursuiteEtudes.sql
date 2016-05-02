DROP TABLE IF EXISTS Etablissement CASCADE;
CREATE TABLE Etablissement (
idEta serial NOT NULL,
nomEta character varying(32),
rue character varying(64),
cp character varying(5),
ville character varying(32),
siteWeb character varying(64),
anneeCreation int,
public bool,
region character varying(32)
) WITHOUT OIDS;
ALTER TABLE Etablissement ADD CONSTRAINT idEta_pk PRIMARY KEY(idEta);

DROP TABLE IF EXISTS Formation CASCADE;
CREATE TABLE Formation (
idFor serial NOT NULL,
intitule character varying(64),
conditionAdmin character varying(128),
typFormation character varying(32),
niveau int,
cout float,
alternance bool,
CTI bool,
RNCP bool,
contenu text,
datCreation date,
dateModif date,
idEta int,
valide bool,
constraint ck_typFormation check (typFormation in ('licence pro','master','doctorat', 'ecole') or typFormation is null),
constraint ck_niveau check (niveau in (3,4,5,8))
) WITHOUT OIDS;
ALTER TABLE Formation ADD CONSTRAINT idFor_pk PRIMARY KEY(idFor);

DROP TABLE IF EXISTS Suivre CASCADE;
CREATE TABLE Suivre (
idFor int NOT NULL,
idEtud int NOT NULL,
annee int,
avis int		/*de 0 à 5*/
) WITHOUT OIDS;
ALTER TABLE Suivre ADD CONSTRAINT idFor_idEtud_pk PRIMARY KEY(idFor,idEtud);

DROP TABLE IF EXISTS AncienEtud CASCADE;
CREATE TABLE AncienEtud (
idEtud serial NOT NULL,
nom character varying(32),
prenom character varying(32),
email character varying(64)
) WITHOUT OIDS;
ALTER TABLE AncienEtud ADD CONSTRAINT idEtud_pk PRIMARY KEY(idEtud);

DROP TABLE IF EXISTS Viser CASCADE;
CREATE TABLE Viser (
idFor int NOT NULL,
idMet int NOT NULL
) WITHOUT OIDS;
ALTER TABLE Viser ADD CONSTRAINT idFor_idMet_pk PRIMARY KEY(idFor,idMet);

DROP TABLE IF EXISTS Metier CASCADE;
CREATE TABLE Metier (
idMet serial NOT NULL,
nomMet character varying(64),
domainPro character varying(32)
) WITHOUT OIDS;
ALTER TABLE Metier ADD CONSTRAINT idMet_pk PRIMARY KEY(idMet);

DROP TABLE IF EXISTS Temoignage CASCADE;
CREATE TABLE Temoignage (
idTem serial NOT NULL,
fichierTem character varying(64),
idFor int,
datTem date
) WITHOUT OIDS;
ALTER TABLE Temoignage ADD CONSTRAINT idTem_pk PRIMARY KEY(idTem);

DROP TABLE IF EXISTS Entretien CASCADE;
CREATE TABLE Entretien (
idEnt serial NOT NULL,
nomPro character varying(64),
idMet int,
fichierEnt character varying(64),
datEntretien date
) WITHOUT OIDS;
ALTER TABLE Entretien ADD CONSTRAINT idEnt_pk PRIMARY KEY(idEnt);

DROP TABLE IF EXISTS Users CASCADE;
CREATE TABLE Users (
login character varying(32) NOT NULL,
motDePasse character varying(32) NOT NULL,
role int,
email character varying(64),
constraint ck_role check (role in (1,2,3)),
CONSTRAINT ck_motDePasse check (length(motDePasse)>=6)
) WITHOUT OIDS;
ALTER TABLE Users ADD CONSTRAINT login_motDePasse_pk PRIMARY KEY(login,motDePasse);


--ALTER TABLE Formation DROP CONSTRAINT IF EXISTS idEta_fk CASCADE;
ALTER TABLE Formation ADD CONSTRAINT idEta_fk FOREIGN KEY (idEta) REFERENCES Etablissement(idEta) ON UPDATE RESTRICT ON DELETE RESTRICT;

--ALTER TABLE Suivre DROP CONSTRAINT IF EXISTS idFor_fk1 CASCADE;
ALTER TABLE Suivre ADD CONSTRAINT idFor_fk1 FOREIGN KEY (idFor) REFERENCES Formation(idFor) ON UPDATE RESTRICT ON DELETE RESTRICT;

--ALTER TABLE Suivre DROP CONSTRAINT IF EXISTS idEtud_fk CASCADE;
ALTER TABLE Suivre ADD CONSTRAINT idEtud_fk FOREIGN KEY (idEtud) REFERENCES AncienEtud(idEtud) ON UPDATE RESTRICT ON DELETE RESTRICT;

--ALTER TABLE Viser DROP CONSTRAINT IF EXISTS idFor_fk2 CASCADE;
ALTER TABLE Viser ADD CONSTRAINT idFor_fk2 FOREIGN KEY (idFor) REFERENCES Formation(idFor) ON UPDATE RESTRICT ON DELETE RESTRICT;

--ALTER TABLE Viser DROP CONSTRAINT IF EXISTS idMet_fk CASCADE;
ALTER TABLE Viser ADD CONSTRAINT idMet_fk FOREIGN KEY (idMet) REFERENCES Metier(idMet) ON UPDATE RESTRICT ON DELETE RESTRICT;

--ALTER TABLE Temoignage DROP CONSTRAINT IF EXISTS idFor_fk3 CASCADE;
ALTER TABLE Temoignage ADD CONSTRAINT idFor_fk3 FOREIGN KEY (idFor) REFERENCES Formation(idFor) ON UPDATE RESTRICT ON DELETE RESTRICT;

insert into Etablissement values (default,'EFREI','32 Avenue de la République','94800','Villejuif','www.efrei.fr',1936,false,'ile de france');
insert into Etablissement values (default,'EPITA','66 rue Guy Moquet','94800','Villejuif','www.epita.fr',1984,false,'ile de france');
insert into Etablissement values (default,'ESGI','28 rue du plateau','75019','Paris','www.esgi.fr',1983,false,'ile de france');
insert into Etablissement values (default,'INFRES (Telecom ParisTech)','23 avenue d''Italie','75013','Paris','www.infres.enst.fr',null,true,'ile de france');
insert into Etablissement values (default,'IUT de Villetaneuse','99 av. Jean-Baptiste Clément','93430','Villetaneuse','www-info.iutv.univ-paris13.fr',
1970,true,'ile de france');

insert into AncienEtud values (default,'Lagaffe','Gaston','gaston@lagaffe.fr');
insert into AncienEtud values (default,'Turing','Alan','aturing@calculateur-universel.net');

insert into Formation values (default,'Ingéniérie Réseau','dossier','ecole',5,8000,false,true,false,'bla bla',now(),null,1,false);
insert into Formation values (default,'Systèmes Informatiques en Réseaux','dossier','master',5,10000,false,true,false,'enseignements.telecom-paristech.fr/programme.php?id=96&langue=FR',now(),null,4,false);
insert into Formation values (default,'License pro SIL','dossier & entretien','licence pro',3,0,true,false,false,'La licence est organisée sous la forme de 22 modules de 25H. Les modules sont répartis dans 5 unités d\'enseignement.\nLes modules fondamentaux concernent les bases de données, le réseau, les technologies objet, la gestion de systèmes d’information de l’entreprise, dont la gestion des projets informatiques, l’anglais, la communication et les mathématiques appliquées. Nous proposons cette année une orientation ERP ( Progiciels de Gestion Intégrés PGI-ERP) sous la forme de 3 modules. L’informatique des entreprises connaît d’importantes évolutions technologiques, stratégiques et organisationnelles avec l’apparition et la diffusion massive des ERP. Cette orientation a pour objectif une formation spécifique autour de l’emploi-métier de paramétreur et de développeur de composants ERP.',now(),null,5,false);

insert into Metier values (default,'Développeur Java/J2EE','Développement');
insert into Metier values (default,'Administrateur Réseau','Administration');
insert into Metier values (default,'Intégrateur Web','Web');

insert into Suivre values (1,1,1991,1);
insert into Suivre values (2,2,1960,5);

insert into Viser values (2,2);

insert into Users values ('nico','nnnnnn',3,null);
insert into Users values ('lea','fucker',3,null);
insert into Users values ('aromeu','armelle',2,null);
insert into Users values ('ludovic','ludovic',1,null);



