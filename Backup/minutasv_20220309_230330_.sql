DROP TABLE IF EXISTS tbl_bitacora;

CREATE TABLE `tbl_bitacora` (
  `CodigoBitacora` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoObjeto` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Accion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoBitacora`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  KEY `CodigoObjeto` (`CodigoObjeto`),
  CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_bitacora_ibfk_2` FOREIGN KEY (`CodigoObjeto`) REFERENCES `tbl_objetos` (`CodigoObjeto`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_bitacora VALUES("1","1","1","2022-03-09 15:47:03","Ingreso a sistema","Autentificacion correcta en el login "),
("2","1","5","2022-03-09 15:47:03","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema"),
("3","1","34","2022-03-09 15:52:38","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("4","1","22","2022-03-09 15:52:40","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("5","1","22","2022-03-09 15:52:44","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("6","1","34","2022-03-09 15:52:44","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("7","2","2","2022-03-09 15:54:55","Guardar","Registro exitoso de un nuevo usuario"),
("8","2","3","2022-03-09 15:55:14","Contestación","Responde a preguntas secretas"),
("9","2","1","2022-03-09 15:55:27","Ingreso a sistema","Autentificacion correcta en el login "),
("10","2","5","2022-03-09 15:55:27","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema"),
("11","2","34","2022-03-09 15:55:36","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("12","2","22","2022-03-09 15:55:39","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("13","2","22","2022-03-09 15:58:35","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("14","2","22","2022-03-09 15:58:44","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("15","2","22","2022-03-09 15:59:06","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("16","2","22","2022-03-09 15:59:10","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("17","2","34","2022-03-09 15:59:10","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("18","2","33","2022-03-09 16:02:49","Ingreso","Lista de eventos por realizar"),
("19","2","33","2022-03-09 16:03:04","Ingreso","Lista de eventos por realizar"),
("20","2","33","2022-03-09 16:04:05","Ingreso","Lista de eventos por realizar"),
("21","1","1","2022-03-09 16:05:23","Ingreso a sistema","Autentificacion correcta en el login "),
("22","1","5","2022-03-09 16:05:24","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema"),
("23","1","34","2022-03-09 16:06:25","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("24","1","22","2022-03-09 16:06:27","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("25","1","22","2022-03-09 16:06:43","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("26","1","22","2022-03-09 16:06:57","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("27","1","22","2022-03-09 16:07:05","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("28","1","18","2022-03-09 16:07:05","Salir","Salida del Sistema."),
("29","2","1","2022-03-09 16:07:27","Ingreso a sistema","Autentificacion correcta en el login "),
("30","2","5","2022-03-09 16:07:27","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema"),
("31","2","34","2022-03-09 16:07:31","Ingreso","Ingreso de la pantalla de producto de los eventos"),
("32","2","22","2022-03-09 16:07:34","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("33","2","22","2022-03-09 16:25:46","Insert","Se registro un nuevo producto en el catálago de Producto en Evento"),
("34","2","18","2022-03-09 16:25:46","Salir","Salida del Sistema."),
("35","2","32","2022-03-09 16:26:42","Ingreso","Lista de catalago de eventos"),
("36","2","32","2022-03-09 16:26:51","Ingreso","Lista de catalago de eventos"),
("37","2","18","2022-03-09 16:26:51","Salir","Salida del Sistema."),
("38","1","1","2022-03-09 16:27:03","Ingreso a sistema","Autentificacion correcta en el login "),
("39","1","5","2022-03-09 16:27:03","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema"),
("40","1","1","2022-03-09 16:27:35","Ingreso a sistema","Autentificacion correcta"),
("41","1","5","2022-03-09 16:27:36","Ingreso","Usuario con acceso ingreso a la pantalla principal del sistema");



DROP TABLE IF EXISTS tbl_catalogoeventospredeterminados;

CREATE TABLE `tbl_catalogoeventospredeterminados` (
  `CodigoCatalogoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoCatalogoEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_catalogoeventospredeterminados VALUES("1","PAQUETE #1"),
("2","PAQUETE #2"),
("3","PAQUETE #3"),
("4","PAQUETE #4"),
("5","PAQUETE #5"),
("6","PAQUETE #6"),
("7","PAQUETE #7"),
("8","PAQUETE #8");



DROP TABLE IF EXISTS tbl_catalogomateriaprima;

CREATE TABLE `tbl_catalogomateriaprima` (
  `CodigoMateria` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProducto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_catalogomateriaprima VALUES("1","CEREZA"),
("2","TAMARINDO"),
("3","FRESA"),
("4","MANGO"),
("5","COCO"),
("6","PIÑA"),
("7","MELOCOTON"),
("8","GUAYABA"),
("9","CIRUELA"),
("10","TUTTI-FRUTTI"),
("11","NANCE"),
("12","EXTRA LECHE"),
("13","VASOS"),
("14","CUCHARAS");



DROP TABLE IF EXISTS tbl_catalogominutas;

CREATE TABLE `tbl_catalogominutas` (
  `CodigoCatalogoM` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(9,2) NOT NULL,
  PRIMARY KEY (`CodigoCatalogoM`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_catalogominutas VALUES("1","MINUTA CON 1 FRUTA","1","40.00"),
("2","MINUTA CON 2 FRUTA","2","50.00"),
("3","MINUTA CON 3 FRUTA","3","60.00"),
("4","MINUTA CON 4 FRUTA","4","70.00");



DROP TABLE IF EXISTS tbl_catalogoproductoeventos;

CREATE TABLE `tbl_catalogoproductoeventos` (
  `CodigoCatalogoProductoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoTipoCatalogo` int(11) NOT NULL,
  `NombreProducto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  PRIMARY KEY (`CodigoCatalogoProductoEvento`),
  KEY `CodigoTipoCatalogo` (`CodigoTipoCatalogo`),
  CONSTRAINT `tbl_catalogoproductoeventos_ibfk_1` FOREIGN KEY (`CodigoTipoCatalogo`) REFERENCES `tbl_tipocatalogoevento` (`CodigoTipoCatalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_catalogoproductoeventos VALUES("1","1","PUPUSAS","50.00"),
("2","1","GRINGAS DE POLLO","60.00"),
("3","2","PALOMITAS","20.00"),
("4","2","ALGONES","25.00"),
("5","3","INFLABLE DE CRAYÓN","1100.00"),
("6","3","INFLABLE DE CASTILLO","2000.00"),
("7","3","INFLABLE DE PULPO DEL VALLE","2000.00"),
("8","3","PAYASITA","1500.00"),
("9","3","SPORT SALTARIN","1600.00"),
("10","4","ELOTES","30.00"),
("11","4","MINUTA 1 SABOR","40.00"),
("12","4","MINUTA 2 SABOR","50.00"),
("13","4","MINUTA 3 SABOR","60.00"),
("14","4","MINUTA 4 SABOR","70.00");



DROP TABLE IF EXISTS tbl_catalogotemporal;

CREATE TABLE `tbl_catalogotemporal` (
  `CodigoTemporalCatalogo` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoCatalogoEvento` int(11) DEFAULT NULL,
  `NumeroEvento` int(11) DEFAULT NULL,
  `CantidadPersonas` int(11) NOT NULL,
  `Descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(9,2) NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  PRIMARY KEY (`CodigoTemporalCatalogo`),
  KEY `NumeroEvento` (`NumeroEvento`),
  KEY `CodigoCatalogoEvento` (`CodigoCatalogoEvento`),
  CONSTRAINT `tbl_catalogotemporal_ibfk_1` FOREIGN KEY (`NumeroEvento`) REFERENCES `tbl_eventos` (`NumeroEvento`),
  CONSTRAINT `tbl_catalogotemporal_ibfk_2` FOREIGN KEY (`CodigoCatalogoEvento`) REFERENCES `tbl_catalogoeventospredeterminados` (`CodigoCatalogoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_cliente;

CREATE TABLE `tbl_cliente` (
  `CodigoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoPersona` int(11) NOT NULL,
  PRIMARY KEY (`CodigoCliente`),
  KEY `CodigoPersona` (`CodigoPersona`),
  CONSTRAINT `tbl_cliente_ibfk_1` FOREIGN KEY (`CodigoPersona`) REFERENCES `tbl_personas` (`CodigoPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_compras;

CREATE TABLE `tbl_compras` (
  `CodigoCompras` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoPersona` int(11) NOT NULL,
  `CodigoMateria` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  `CostoUnitario` decimal(9,2) NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  `FechaCompra` datetime NOT NULL,
  PRIMARY KEY (`CodigoCompras`),
  KEY `CodigoMateria` (`CodigoMateria`),
  KEY `CodigoPersona` (`CodigoPersona`),
  CONSTRAINT `tbl_compras_ibfk_1` FOREIGN KEY (`CodigoMateria`) REFERENCES `tbl_catalogomateriaprima` (`CodigoMateria`),
  CONSTRAINT `tbl_compras_ibfk_2` FOREIGN KEY (`CodigoPersona`) REFERENCES `tbl_personas` (`CodigoPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_contacto;

CREATE TABLE `tbl_contacto` (
  `CodigoContacto` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoPersona` int(11) NOT NULL,
  `Telefono` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoContacto`),
  KEY `CodigoPersona` (`CodigoPersona`),
  CONSTRAINT `tbl_contacto_ibfk_1` FOREIGN KEY (`CodigoPersona`) REFERENCES `tbl_personas` (`CodigoPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_contraseña;

CREATE TABLE `tbl_contraseña` (
  `CodigoHistContraseña` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoUsuario` int(11) DEFAULT NULL,
  `Correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Token` int(11) NOT NULL,
  `Codigo` int(11) NOT NULL,
  `Creado_Por` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`CodigoHistContraseña`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_contraseña_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_detalleevento;

CREATE TABLE `tbl_detalleevento` (
  `CodigoDetalleEvento` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroEvento` int(11) DEFAULT NULL,
  `CodigoCatalogoEvento` int(11) DEFAULT NULL,
  `CantidadPersonas` int(11) NOT NULL,
  `Descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(9,2) NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  PRIMARY KEY (`CodigoDetalleEvento`),
  KEY `NumeroEvento` (`NumeroEvento`),
  KEY `CodigoCatalogoEvento` (`CodigoCatalogoEvento`),
  CONSTRAINT `tbl_detalleevento_ibfk_1` FOREIGN KEY (`NumeroEvento`) REFERENCES `tbl_eventos` (`NumeroEvento`),
  CONSTRAINT `tbl_detalleevento_ibfk_2` FOREIGN KEY (`CodigoCatalogoEvento`) REFERENCES `tbl_catalogoeventospredeterminados` (`CodigoCatalogoEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_detalleevento VALUES("1","","1","20","PUPUSA","50.00","400.00"),
("2","","1","20","ELOTES LOCO EN VASOS","30.00","600.00"),
("3","","1","20","ALGODONES","25.00","400.00"),
("4","","1","20","PALOMITAS","20.00","400.00"),
("5","","2","20","PUPUSA","50.00","1500.00"),
("6","","2","20","MINUTA 1 SABOR","40.00","800.00"),
("7","","2","20","ELOTES","30.00","600.00"),
("8","","3","50","INFLABLE GRANDE","2000.00","2000.00"),
("9","","3","50","PUPUSA","50.00","2500.00"),
("10","","3","50","ALGODONES","25.00","1000.00"),
("11","","3","50","PALOMITAS","20.00","1000.00"),
("12","","4","40","PUPUSAS","50.00","2000.00"),
("13","","4","40","ELOTES LOCO EN VASOS","30.00","800.00"),
("14","","4","40","INFLABLE GRANDE","2000.00","2000.00"),
("15","","5","40","PUPUSAS","50.00","2000.00"),
("16","","5","40","SPORT SALTARIN","1500.00","1500.00"),
("17","","5","40","MINUTA 1 SABOR","40.00","1600.00"),
("18","","6","30","PUPUSAS","50.00","1500.00"),
("19","","6","30","ELOTES","30.00","900.00"),
("20","","6","30","MINUTA 1 SABOR","40.00","1200.00"),
("21","","6","30","PALOMITA","20.00","600.00"),
("22","","6","30","ALGONES","25.00","600.00"),
("23","","6","30","INFLABLE GRANDE","2000.00","2000.00"),
("24","","7","30","PUPUSAS Y GRINGA","110.00","3900.00"),
("25","","7","30","MINUTA 1 SABOR","40.00","1200.00"),
("26","","7","30","ELOTES","30.00","600.00"),
("27","","7","30","INFLABLE GRANDE","1100.00","1100.00"),
("28","","8","70","PUPUSAS","50.00","3500.00"),
("29","","8","70","MINUTA 1 SABOR","40.00","2800.00"),
("30","","8","70","PALOMITAS","20.00","1400.00"),
("31","","4","40","MINUTA 1 SABOR","40.00","1600.00"),
("32","","3","50","MINUTA 1 SABOR","40.00","1600.00"),
("33","","8","70","INFLABLE GRANDE","1100.00","1100.00");



DROP TABLE IF EXISTS tbl_detallespedido;

CREATE TABLE `tbl_detallespedido` (
  `CodigoDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroPedido` int(11) DEFAULT NULL,
  `Minuta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Toppings` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Extra` decimal(9,2) DEFAULT NULL,
  `PrecioTotal` decimal(9,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`CodigoDetalle`),
  KEY `NumeroPedido` (`NumeroPedido`),
  CONSTRAINT `tbl_detallespedido_ibfk_1` FOREIGN KEY (`NumeroPedido`) REFERENCES `tbl_pedidos` (`NumeroPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_estadoevento;

CREATE TABLE `tbl_estadoevento` (
  `CodigoEstadoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoEstadoEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_estadoevento VALUES("1","Pedido Realizado"),
("2","Pedido Cancelado");



DROP TABLE IF EXISTS tbl_estadopedido;

CREATE TABLE `tbl_estadopedido` (
  `CodigoEstado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_estadopedido VALUES("1","Pagado"),
("2","No Pagado"),
("3","Cancelado");



DROP TABLE IF EXISTS tbl_estadousuario;

CREATE TABLE `tbl_estadousuario` (
  `CodigoEstado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_estadousuario VALUES("1","Nuevo"),
("2","Activo"),
("3","Inactivo"),
("4","Bloqueado");



DROP TABLE IF EXISTS tbl_eventos;

CREATE TABLE `tbl_eventos` (
  `NumeroEvento` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoPersona` int(11) DEFAULT NULL,
  `CodigoUsuario` int(11) DEFAULT NULL,
  `CodigoEstadoEvento` int(11) DEFAULT NULL,
  `Direccion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hora` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` int(15) DEFAULT NULL,
  `FechaEvento` date DEFAULT NULL,
  `Transporte` decimal(9,2) DEFAULT NULL,
  `SubTotal` decimal(9,2) DEFAULT NULL,
  `ISV` decimal(9,2) DEFAULT NULL,
  `PrecioTotal` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`NumeroEvento`),
  KEY `CodigoPersona` (`CodigoPersona`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  KEY `CodigoEstadoEvento` (`CodigoEstadoEvento`),
  CONSTRAINT `tbl_eventos_ibfk_1` FOREIGN KEY (`CodigoPersona`) REFERENCES `tbl_personas` (`CodigoPersona`),
  CONSTRAINT `tbl_eventos_ibfk_2` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_eventos_ibfk_3` FOREIGN KEY (`CodigoEstadoEvento`) REFERENCES `tbl_estadoevento` (`CodigoEstadoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_inventarioexistente;

CREATE TABLE `tbl_inventarioexistente` (
  `CodigoExistente` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoMateriaPrima` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  `StockMinimo` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodigoExistente`),
  KEY `CodigoMateriaPrima` (`CodigoMateriaPrima`),
  CONSTRAINT `tbl_inventarioexistente_ibfk_1` FOREIGN KEY (`CodigoMateriaPrima`) REFERENCES `tbl_catalogomateriaprima` (`CodigoMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_inventarioexistente VALUES("1","1","10",""),
("2","2","10",""),
("3","3","10",""),
("4","4","10",""),
("5","5","10",""),
("6","6","10",""),
("7","7","10",""),
("8","8","10",""),
("9","9","10",""),
("10","10","10",""),
("11","11","10",""),
("12","12","10",""),
("13","13","10",""),
("14","14","10","");



DROP TABLE IF EXISTS tbl_kardex;

CREATE TABLE `tbl_kardex` (
  `CodigoKardex` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoMateria` int(11) NOT NULL,
  `CodigoTipoKardex` int(11) NOT NULL,
  `CodigoUsuario` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  PRIMARY KEY (`CodigoKardex`),
  KEY `CodigoMateria` (`CodigoMateria`),
  KEY `CodigoTipoKardex` (`CodigoTipoKardex`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_kardex_ibfk_1` FOREIGN KEY (`CodigoMateria`) REFERENCES `tbl_catalogomateriaprima` (`CodigoMateria`),
  CONSTRAINT `tbl_kardex_ibfk_2` FOREIGN KEY (`CodigoTipoKardex`) REFERENCES `tbl_tipokardex` (`CodigoTipoKardex`),
  CONSTRAINT `tbl_kardex_ibfk_3` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_objetos;

CREATE TABLE `tbl_objetos` (
  `CodigoObjeto` int(11) NOT NULL AUTO_INCREMENT,
  `Objeto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TipoObjeto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodigoObjeto`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_objetos VALUES("1","Login.php","Pantalla de acceso","Pantalla"),
("2","autoregistro.php","Registro de nuevo usuario","Pantalla"),
("3","preguntasecretas.php","Responde a preguntas secretas para poder recuperar contraseña si la olvida","Pantalla"),
("4","pregunta_cambiarcontraseña.php","El usuario nuevo cambia su contraseña","Pantalla"),
("5","principalusuarios.php","Interfaz principal del sistema","Pantalla"),
("6","pregunta_usuario.php","El usuario ingresa su nombre de usuario","Pantalla"),
("7","preguntasecretasrecuperar.php","Responde preguntas para recuperar contraseña","Pantalla"),
("8","cambiarcontrasena.php","El usuario cambia contrasena","Pantalla"),
("9","correo_recuperacion.php","Recuperacion por correo","Pantalla"),
("10","correo_nueva_contrasena.php","Pantalla para ingresas el codigo de recuperacion","Pantalla"),
("11","correo_verificartoken.php","Pantalla para cambiar la contrasena","Pantalla"),
("12","correo_cambiarcontrasena.php","Usuario cambio la contrasena ","Boton"),
("13","gestion_nuevou.php","Se registro un nuevo usuario por medio de Gestión de Usuario","Pantalla"),
("14","gestion_contraseña.php","Se gestiono un cambio de contraseña","Botón"),
("15","gestion_borrar.php","Se gestiono un borrado de usuario","Botón"),
("16","gestion_principal.php","Se gestiono un borrado de usuario","Pantalla"),
("17","gestion_bitacora.php","El Usuario ingreso a la Bitácora","Pantalla"),
("18","encabezado.php","Botón de Salida del Sistema","Botón"),
("19","inventario_kardex.php","Usuario con acceso ingreso a kardex","Pantalla"),
("20","Inventario.php","Ingreso a la pantalla de Inventario de Materia Prima","Pantalla"),
("21","detalle.php","Ingreso a detalles de movimientos de producto de materia prima","Pantalla"),
("22","eventos_agregarproducto.php","Se registro un nuevo producto en el catálago de Producto en Evento","Pantalla"),
("23","eventos_productoeditar.php","Se hizo un Update en catálago de Producto Evento","Pantalla"),
("24","eventos_borrar.php","Se elimino un producto en catálago de producto Evento","Pantalla"),
("25","eventos_nuevoe.php","Se registro un nuevo Evento","Pantalla"),
("26","eventos_nuevopaquete.php","El usuario formo un nuevo paquete según las indicaciones del Cliente","Pantalla"),
("27","eventos_cataeditar.php","Se hizo un Update en catálago de Evento","Pantalla"),
("28","eventos_borrar.php","Se elimino un catálago de Evento","Pantalla"),
("29","eventos_agregar.php","Se registro un pedido de Evento","Pantalla"),
("30","eventos_borrar.php","Se elimino un pedido de Evento","Pantalla"),
("31","eventos_editareventosdetallados.php","Editar el eventos","Pantalla"),
("32","eventos_cata.php","Lista de Catalogo de Eventos","Pantalla"),
("33","eventos_eventosdetallados.php","Lista de eventos a realizar o por realizar","Pantalla"),
("34","eventos_producto.php","Lista de productos de los eventos","Pantalla"),
("35","cataProducto_nuevo.php","Se registro Materia Prima","Pantalla"),
("36","cataProducto_ed.php","Se hizo un Update Materia Prima","Pantalla"),
("37","borrar_producto.php","Se elimino una Materia Prima","Pantalla"),
("38","cata_producto.php","Lista de Productos","Pantalla"),
("39","persona.php","Agregar una nueva persona","Pantalla"),
("40","tablapersonas.php","Lista de personas","Pantalla"),
("41","editarpersona.php","Editar datos de una persona ya existente","Pantalla"),
("42","eliminarpersona.php","Se elimino una persona","Pantalla"),
("43","compras.php","Ingreso en la pantalla de tabla Compras Registradas","Pantalla"),
("44","compras_nueva.php","Agregar una nueva compras","Pantalla"),
("45","compras_editar.php","Editar la compra de costo","Pantalla"),
("46","eliminarCompra.php","Se elimino una compra","Pantalla"),
("47","tablapedidos.php","Lista de todos los pedidos","Pantalla"),
("48","agregarpedidos.php","Ingresar un nuevo pedido","Pantalla"),
("49","catalogoMinutas.php","Lista de las minutas en venta","Pantalla"),
("50","agregarminuta.php","Agregar una nueva minuta a catalogo de minutas","Pantalla"),
("51","editarminuta.php","Editar un minuta existente de catalago de minutas","Pantalla"),
("52","eliminarminuta.php","Se elimino una minuta","Pantalla"),
("53","eliminarpedido.php","Se elimino un pedido","Pantalla"),
("54","eliminarPedidotabla.php","Se elimino un pedido","Pantalla"),
("55","pagoPedido.php","Pago de pedido","Pantalla"),
("56","detallespedido.php","Lista de pedido","Pantalla");



DROP TABLE IF EXISTS tbl_parametros;

CREATE TABLE `tbl_parametros` (
  `CodigoParametro` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoUsuario` int(11) DEFAULT NULL,
  `Parametro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Valor` int(11) NOT NULL,
  `Creado_Por` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  `Modificado_Por` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`CodigoParametro`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_parametros_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_parametros VALUES("1","","ADMIN_DIAS_VIGENCIA","120","","","",""),
("2","","ADMIN_No_PREGUNTAS_SECRETAS","1","","","",""),
("3","","ADMIN_INTENTOS_INVALIDOS","5","","","",""),
("4","","ADMIN_DIAS_PAQUETE","150","","","",""),
("5","","ADMIN_ISV_EVENTOS","15","","","",""),
("6","","ADMIN_ISV","0","","","","");



DROP TABLE IF EXISTS tbl_pedidos;

CREATE TABLE `tbl_pedidos` (
  `NumeroPedido` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCliente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NombreUsuario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `ISV` decimal(9,2) NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  `FechaPedido` datetime NOT NULL,
  PRIMARY KEY (`NumeroPedido`),
  KEY `CodigoEstado` (`CodigoEstado`),
  CONSTRAINT `tbl_pedidos_ibfk_1` FOREIGN KEY (`CodigoEstado`) REFERENCES `tbl_estadopedido` (`CodigoEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_pedidotemporal;

CREATE TABLE `tbl_pedidotemporal` (
  `CodigoTemporal` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroPedido` int(11) DEFAULT NULL,
  `Minuta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Toppings` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Extra` decimal(9,2) DEFAULT NULL,
  `PrecioTotal` decimal(9,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`CodigoTemporal`),
  KEY `NumeroPedido` (`NumeroPedido`),
  CONSTRAINT `tbl_pedidotemporal_ibfk_1` FOREIGN KEY (`NumeroPedido`) REFERENCES `tbl_pedidos` (`NumeroPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS tbl_permisos;

CREATE TABLE `tbl_permisos` (
  `CodigoPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoRol` int(11) NOT NULL,
  `CodigoObjeto` int(11) NOT NULL,
  `Permiso_Insercion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Permiso_Eliminacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Permiso_Actualizacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Permiso_Consultar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoPermiso`),
  KEY `CodigoRol` (`CodigoRol`),
  KEY `CodigoObjeto` (`CodigoObjeto`),
  CONSTRAINT `tbl_permisos_ibfk_1` FOREIGN KEY (`CodigoRol`) REFERENCES `tbl_roles` (`CodigoRol`),
  CONSTRAINT `tbl_permisos_ibfk_2` FOREIGN KEY (`CodigoObjeto`) REFERENCES `tbl_objetos` (`CodigoObjeto`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_permisos VALUES("1","1","19","0","0","0","1"),
("2","1","20","0","0","0","1"),
("3","1","21","0","0","0","1"),
("4","1","22","1","0","0","1"),
("5","1","23","0","0","1","1"),
("6","1","24","0","1","0","1"),
("7","1","25","1","0","0","1"),
("8","1","26","1","0","0","1"),
("9","1","27","0","0","1","1"),
("10","1","28","0","1","0","1"),
("11","1","29","1","0","0","1"),
("12","1","30","0","1","0","1"),
("13","1","31","0","0","1","1"),
("14","1","32","0","0","0","1"),
("15","1","33","0","0","0","1"),
("16","1","34","0","0","0","1"),
("17","1","35","1","0","0","1"),
("18","1","36","0","0","1","1"),
("19","1","37","0","1","0","1"),
("20","1","38","0","0","0","1"),
("21","1","39","1","0","0","1"),
("22","1","40","0","0","0","1"),
("23","1","41","0","0","1","1"),
("24","1","42","0","1","0","1"),
("25","1","43","0","0","0","1"),
("26","1","44","1","0","0","1"),
("27","1","45","0","0","1","1"),
("28","1","46","0","1","0","1"),
("29","1","47","0","0","0","1"),
("30","1","48","1","0","0","1"),
("31","1","49","0","0","0","1"),
("32","1","50","1","0","0","1"),
("33","1","51","0","0","1","1"),
("34","1","52","0","1","0","1"),
("35","1","53","0","1","0","1"),
("36","1","54","0","1","0","1"),
("37","1","55","0","1","0","1"),
("38","1","56","0","0","0","1"),
("39","2","22","0","0","0","0");



DROP TABLE IF EXISTS tbl_personas;

CREATE TABLE `tbl_personas` (
  `CodigoPersona` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoTipoPersona` int(11) NOT NULL,
  `NombreCompleto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NumeroIdentidad` char(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoPersona`),
  KEY `CodigoTipoPersona` (`CodigoTipoPersona`),
  CONSTRAINT `tbl_personas_ibfk_1` FOREIGN KEY (`CodigoTipoPersona`) REFERENCES `tbl_tipopersona` (`CodigoTipoPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_personas VALUES("1","2","ADMIN",""),
("2","2","INDIRA LÓPEZ","0987654345678");



DROP TABLE IF EXISTS tbl_preguntapredeterminada;

CREATE TABLE `tbl_preguntapredeterminada` (
  `CodigoPreguntaPredeterminada` int(11) NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoPreguntaPredeterminada`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_preguntapredeterminada VALUES("1","¿Cuál es tu serie favorita?"),
("2","¿Cuál es tu comida favorita?"),
("3","Nombre de tu familiar favorito"),
("4","¿Cuál es tu canción favorita?"),
("5","¿Cuál es tu color favorito?"),
("6","Nombre del colegio en que te graduaste");



DROP TABLE IF EXISTS tbl_preguntausuario;

CREATE TABLE `tbl_preguntausuario` (
  `CodigoPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoUsuario` int(11) NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pregunta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Respuesta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Creado_Por` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`CodigoPregunta`),
  KEY `CodigoUsuario` (`CodigoUsuario`),
  CONSTRAINT `tbl_preguntausuario_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `tbl_usuario` (`CodigoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_preguntausuario VALUES("1","2","INDIRAGAR","¿Cuál es tu comida favorita?","PIZZA","","2022-03-09 15:55:13","","0000-00-00 00:00:00");



DROP TABLE IF EXISTS tbl_roles;

CREATE TABLE `tbl_roles` (
  `CodigoRol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_roles VALUES("1","Admin","Posee todos los permisos"),
("2","Default","Usuario que se autoregistra"),
("3","Usuario","Editor de datos");



DROP TABLE IF EXISTS tbl_tipocatalogoevento;

CREATE TABLE `tbl_tipocatalogoevento` (
  `CodigoTipoCatalogo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoTipoCatalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_tipocatalogoevento VALUES("1","COMIDA"),
("2","GOLOSINAS"),
("3","SERVICIOS"),
("4","POSTRES");



DROP TABLE IF EXISTS tbl_tipokardex;

CREATE TABLE `tbl_tipokardex` (
  `CodigoTipoKardex` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoTipoKardex`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_tipokardex VALUES("1","Entrada"),
("2","Salida");



DROP TABLE IF EXISTS tbl_tipopersona;

CREATE TABLE `tbl_tipopersona` (
  `CodigoTipoPersona` int(11) NOT NULL AUTO_INCREMENT,
  `TipoPersona` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodigoTipoPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_tipopersona VALUES("1","Cliente"),
("2","Empleado"),
("3","Proveedor");



DROP TABLE IF EXISTS tbl_toppings;

CREATE TABLE `tbl_toppings` (
  `CodigoToppings` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`CodigoToppings`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_toppings VALUES("1","Cereza",""),
("2","Tamarindo",""),
("3","Fresa",""),
("4","Mango",""),
("5","Coco",""),
("6","Piña",""),
("7","Melocoton",""),
("8","Guayaba",""),
("9","Ciruela",""),
("10","Tutti-frutti",""),
("11","Nance",""),
("12","Extra leche","10.00"),
("13","Extra Fruta","10.00");



DROP TABLE IF EXISTS tbl_usuario;

CREATE TABLE `tbl_usuario` (
  `CodigoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoRol` int(11) DEFAULT NULL,
  `CodigoPersona` int(11) NOT NULL,
  `Usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `NombreUsuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CodigoEstadoUsuario` int(11) NOT NULL,
  `Contraseña` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Preguntas_Contestadas` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Primer_Ingreso` datetime DEFAULT NULL,
  `Fecha_Vencimiento` datetime DEFAULT NULL,
  `Correo_Electronico` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Creado_Por` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`CodigoUsuario`),
  KEY `CodigoRol` (`CodigoRol`),
  KEY `CodigoEstadoUsuario` (`CodigoEstadoUsuario`),
  KEY `CodigoPersona` (`CodigoPersona`),
  CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`CodigoRol`) REFERENCES `tbl_roles` (`CodigoRol`),
  CONSTRAINT `tbl_usuario_ibfk_2` FOREIGN KEY (`CodigoEstadoUsuario`) REFERENCES `tbl_estadousuario` (`CodigoEstado`),
  CONSTRAINT `tbl_usuario_ibfk_3` FOREIGN KEY (`CodigoPersona`) REFERENCES `tbl_personas` (`CodigoPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_usuario VALUES("1","1","1","ADMIN","","2","Admin@1231","","","","sistemaminutasva@gmail.com","","2022-03-09 15:46:25"),
("2","2","2","INDIRAGAR","INDIRA LÓPEZ","2","$2y$10$Eb4w81C6sZEpSQ7gJCddP.TmfV3ibDvcnIqQlIAt5qUoF3xnCcFLW","1","","2022-07-07 15:54:50","yengarmendia@gmail.com","","2022-03-09 15:54:50");



