use moisesville;

delete from tipoAcervo;
alter table tipoAcervo auto_increment = 0;

-- alter table tipoAcervo add cod int;
-- alter table tipoAcervo add clasifac int;

-- select * from tipoAcervo;

-- correr migracion acervo y luego borrar los campos basura

-- insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(0,null,0,0,'Sin clasificación');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(1,null,1,0,'Documento');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(2,null,2,0,'Objeto');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(3,null,3,0,'Publicacion');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(4,null,4,0,'Cuadro');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(5,null,5,0,'Video');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(6,null,6,0,'Casete');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(7,null,7,0,'Fotografía');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(8,null,8,0,'Mobiliario');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(9,1,0,1,'Tarjeta Postal');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(10,1,1,1,'Afiche');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(11,2,2,1,'Maquina agricola');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(12,3,3,1,'Libro');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(13,1,0,2,'Libro de Actas');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(14,1,1,2,'Boleto de Compra-Venta');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(15,3,3,2,'Revista');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(16,1,1,3,'Escritura');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(17,3,3,3,'Periódico');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(18,1,1,4,'Contrato');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(19,3,3,4,'Mensuario');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(20,1,1,5,'Carta');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(21,1,1,6,'Accion');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(22,1,1,7,'Discurso');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(23,1,1,8,'Telegrama');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(24,1,1,9,'Acta');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(25,1,1,10,'Acta de casamiento');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(26,1,1,11,'Articulo periodistico');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(27,1,1,12,'Aviso');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(28,1,1,13,'Balance');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(29,1,1,14,'Balance');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(30,1,1,15,'Volante');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(31,1,1,16,'Boletin Oficial');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(32,1,1,17,'Calcomania');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(33,1,1,18,'Carnet');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(34,1,1,19,'Cartel');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(35,1,1,20,'Carta de ciudadania');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(36,1,1,21,'Decreto');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(37,1,1,22,'Diario');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(38,1,1,23,'Declaracion jurada');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(39,1,1,24,'Diploma');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(40,1,1,25,'Estampillas');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(41,1,1,26,'Informe');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(42,1,1,27,'Pergamino');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(43,1,1,28,'Pasaporte');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(44,1,1,29,'Plano');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(45,1,1,30,'Diploma');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(46,1,1,31,'Libro de Actas');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(47,1,1,32,'Tarjeta');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(48,1,1,33,'Rifas');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(49,1,1,34,'Folletos - Catálogos');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(50,1,1,35,'Resoluciones');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(51,1,1,36,'Estatutos');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(52,1,1,37,'Facturas');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(53,1,1,38,'Recibo');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(54,1,1,39,'Libreta');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(55,1,1,40,'Libro de vencimientos');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(56,1,1,41,'Libro de caja');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(57,1,1,42,'Solicitud de créditos');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(58,1,1,43,'Nota');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(59,1,1,44,'Libreta de calificaciones');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(60,1,1,45,'Calcomanía');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(61,1,1,46,'Poesía');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(62,1,1,47,'Libro');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(63,1,1,48,'Certificado');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(64,1,1,49,'Programa');
insert into tipoAcervo(id,tipoacervo_id,cod,clasifac,descripcion) values(65,1,1,50,'Ficha');

