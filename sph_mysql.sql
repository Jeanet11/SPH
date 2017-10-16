create table uti_utilisateur(

uti_oid int auto_increment primary key not null,
uti_pseudo varchar(50),
unique (uti_pseudo),
uti_nom varchar(50),
uti_prenom varchar(50),
uti_mdp varchar(30),
uti_autorisation int not null
);

create table cli_client(

cli_oid int auto_increment primary key not null, 
cli_nom varchar(50),
cli_prenom varchar(50), 
cli_email varchar(50), 
cli_adresse varchar(50),
cli_cp char(5),
cli_ville varchar(60),
cli_tel char(10),
cli_commentaire text, 
cli_provenance varchar(50)
);

create table tra_travaux(

tra_oid int auto_increment primary key not null,
tra_titre varchar(50),
tra_description varchar(255),
tra_prix float, 
tra_date_debut date, 
tra_date_rappel date, 
tra_mode_paiment varchar(50), 
cli_oid int not null ,
constraint FOREIGN KEY(cli_oid)
references cli_client(cli_oid),
tra_photos text	
);

create table com_commentaire(

com_oid int auto_increment primary key not null, 
com_commentaire text, 
tra_oid int not null, 
uti_oid int not null, 
constraint FOREIGN KEY(tra_oid) 
references tra_travaux(tra_oid), 
constraint FOREIGN KEY(uti_oid)
references uti_utilisateur(uti_oid)
);
