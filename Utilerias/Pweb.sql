Create Table cuerpo.rol(
	idrol SERIAL,
	nomrol varchar(100),
	constraint pkrol primary key (idrol)
);
Insert into cuerpo.rol(nomrol) values ('Administrador');
Insert into cuerpo.rol(nomrol) values ('Usuario');

Create Table cuerpo.usuario(
	idusuario SERIAL,
	correousr varchar(100) not null UNIQUE,
	nomusr varchar(100),
	contrasena varchar(100),
	idrol Int not null,
	session varchar(60),
	constraint pkusr primary key (idusuario),
	constraint fkusr foreign key (idrol) references cuerpo.rol(idrol)
);

Insert into cuerpo.usuario(correousr,nomusr,contrasena,idrol,session)
values ('agz@hotmail.com','Alex Lora','$2y$10$LFEKkshlceG0b19R4NER5uMvQw2th.had.z8UvWej05rUn2V8Rxwi',1,'')

Create Table cuerpo.opcmenu(
	idopcmenu SERIAL,
	idmenu varchar(40) not null,
	nommenu varchar(100),
	orden Int,
	constraint pkopc primary key (idopcmenu)
);

Insert into cuerpo.opcmenu(idmenu,nommenu,orden) Values ('opcClasif','Clasificaciones',10);
Insert into cuerpo.opcmenu(idmenu,nommenu,orden) Values ('opcRol','Roles',10);
Insert into cuerpo.opcmenu(idmenu,nommenu,orden) Values ('opcUsuario','Usuario',20);
Insert into cuerpo.opcmenu(idmenu,nommenu,orden) Values ('opcMenu','Menu',30);
Insert into cuerpo.opcmenu(idmenu,nommenu,orden) Values ('opcPerfil','Perfil',40);


Create Table cuerpo.perfil(
	idrol Int not null,
	idopcmenu Int not null,
	fechahora timestamp default(now()),
    constraint pkperfil primary key (idrol,idopcmenu),
	constraint fkrol foreign key (idrol) references cuerpo.rol(idrol),
	constraint fkmenu foreign key (idopcmenu) references cuerpo.opcmenu(idopcmenu)
);

Insert into cuerpo.perfil(idrol,idopcmenu) values (1,1);
Insert into cuerpo.perfil(idrol,idopcmenu) values (1,2);
Insert into cuerpo.perfil(idrol,idopcmenu) values (1,3);
Insert into cuerpo.perfil(idrol,idopcmenu) values (1,4);
Insert into cuerpo.perfil(idrol,idopcmenu) values (1,5);


