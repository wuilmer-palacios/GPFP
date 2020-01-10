CREATE DATABASE progressa_proyectos;
USE progressa_proyectos;

CREATE TABLE planes_tacticos(
	idPlan int not null auto_increment,
	estrategia int null,
	plan varchar(30) not null,
	fechaInicio datetime not null,
	fechaFinal datetime not null,
	responsable int not null,
	estadoPlan int(1) not null,
	PRIMARY KEY(idPlan)
);

CREATE TABLE alcances(
	idAlcance int not null auto_increment,
	alcance varchar(30) not null,
	planTactico int not null,
	fechaInicio datetime not null,
	fechaFinal datetime not null,
	estadoAlcance int(1) not null,
	PRIMARY KEY (idAlcance)
);

CREATE TABLE alcances_has_cp_participantes(
	idAlcance int not null,
	idParticipante int not null,
	PRIMARY KEY (idAlcance, idParticipante)
);

CREATE TABLE ejes_estrategicos(
	idEje int not null,
	ejeEstrategico varchar(30) not null,
	estadoEje tinyint  not null,
	PRIMARY KEY(idEje)
);

CREATE TABLE estrategias(
	idEstrategia int not null,
	estrategia varchar(30) not null,
	ejeEstrategico int not null,
	fechaInicio datetime not null,
	fechaFinal datetime not null,
	usuarioCrea varchar(20) not null,
	fechaCrea datetime not null,
	estadoEstrategia tinyint not null,
	PRIMARY KEY(idEstrategia)
);

CREATE TABLE gestion_alcance(
	idGestion int not null,
	gestion varchar(30) not null,
	alcance int not null,
	usuarioGestion varchar(30) not null,
	fechaGestion datetime not null,
	estadoGestion tinyint not null,
	PRIMARY KEY (idGestion)
);

CREATE TABLE participantes(
	idParticipante int not null auto_increment,
	primerNombre varchar(15) not null,
	segundoNombre varchar (15) null,
	primerApellido varchar(15) not null,
	segundoApellido varchar (15) null,
	estadoParticipante tinyint not null,
	PRIMARY KEY (idParticipante)
);

CREATE TABLE responsables(
	idResponsable int not null,
	nombre varchar(15) not null,
	apellido varchar(15) not null,
	estadoResponsable tinyint not null,
	PRIMARY KEY(idResponsable)
);

-- RELACIONES -- -- RELACIONES -- -- RELACIONES -- -- RELACIONES -- ;

ALTER TABLE planes_tacticos ADD CONSTRAINT cp_planes_tacticos_and_cp_responsables
FOREIGN KEY (responsable) REFERENCES responsables (idResponsable);

ALTER TABLE alcances ADD CONSTRAINT cp_planes_tacticos_and_cp_alcances
FOREIGN KEY (planTactico) REFERENCES planes_tacticos (idPlan);

ALTER TABLE alcances_has_cp_participantes ADD CONSTRAINT cp_alcances_has_cp_participantes_uno
FOREIGN KEY (idAlcance) REFERENCES alcances (idAlcance);

ALTER TABLE alcances_has_cp_participantes ADD CONSTRAINT cp_alcances_has_cp_participantes_dos
FOREIGN KEY (idParticipante) REFERENCES participantes (idParticipante);

ALTER TABLE gestion_alcance ADD CONSTRAINT cp_gestion_alcance_and_alcances
FOREIGN KEY (alcance) REFERENCES alcances (idAlcance);

ALTER TABLE estrategias ADD CONSTRAINT cp_estrategias_and_cp_ejes_estrategicos
FOREIGN KEY (ejeEstrategico) REFERENCES ejes_estrategicos (idEje);