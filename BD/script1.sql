drop database if EXISTS tiendaRopa;
create database tiendaRopa;
use tiendaRopa;

create table if not exists usuarioTipo (
    idTipo varchar(2) not null PRIMARY key,
    privilegiosUsuario varchar(64) not NULL

);

create table if not exists proveedores(
    id_proveedor int not null auto_increment PRIMARY KEY,
    nombre varchar(64) not null,
    telefono VARCHAR(11) not null,
    direccion VARCHAR(100) not null,
    email VARCHAR(64) not null


);
create table if not exists productos (
    idProducto int not null auto_increment PRIMARY KEY,
    nombre varchar(255) not null,
    marca varchar(255) not null,
    categoria varchar(64) not null,
    precio float not null,
    talla varchar(64) not null,
    imagen varchar(255) not null,
    description varchar(255) not null,
    id_proveedor int not null,
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor) ON UPDATE CASCADE ON DELETE CASCADE

) ;


create table if not exists empleados (
    dniEmpleado varchar(10) not null PRIMARY key,
    email varchar(64) not null,
    nombre varchar(255) not null,
    appellidos varchar(255) not null,
    pass varchar(255) not null,
    tipoUsuario varchar(2) not null,
    foreign key (tipoUsuario) references usuariotipo(idTipo) ON UPDATE CASCADE ON DELETE CASCADE
   
);
create table if not exists clientes  (

    dniCliente varchar(10) not null PRIMARY KEY,
        -- idCliente int auto_increment primary key,
    nombre varchar(64) not null,
    apellidos varchar(128) not null,
    email varchar(255) not null,
    pass varchar(64) not null,
    direccion varchar(255) not null,
    telefono varchar(9) not null

);
create table if not exists ventas(
    idVenta int not null AUTO_INCREMENT primary key,
    fechaVenta date not null,
    importe int(4) not null,
    idProducto int not null ,
    dniCliente varchar(10) not null,
    foreign key (idProducto) REFERENCES productos(idProducto) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (dniCliente) REFERENCES clientes(dniCliente) ON UPDATE CASCADE ON DELETE CASCADE
   
);


CREATE TABLE IF NOT EXISTS carrito_usuarios(
    id_sesion VARCHAR(255) NOT NULL,
    idProducto int NOT NULL,
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto)
    ON UPDATE CASCADE ON DELETE CASCADE
);


-- Inserciones
insert into usuariotipo values(0,"Admin");
insert into usuariotipo VALUES(1,"Empleado");

-- Proveedores
insert into proveedores values(1,'Nike','983 45 67 89','Oregón','nike@gmail.com');
insert into proveedores values(2,'Adidas','925 77 79 75','Californnia','adidas@gmail.com');
insert into proveedores values(3,'Joma','925 80 15 66','Florida','joma@gmail.com');
insert into proveedores values(4,'Polo','980 08 72 34','Arizona','polo@gmail.com');
insert into proveedores values(5,'Lacoste','951 87 67 65','Oregón','lacoste@gmail.com');
insert into proveedores values(6,'Dior','958 85 96 25','Montana','dior@gmail.com');
insert into proveedores values(7,'Chanel','941 46 08 28','Nueva York','chanel@gmail.com');
insert into proveedores values(8,'Nautica','972 03 72 86','Utah','nautica@gmail.com');
insert into proveedores values(9,'Hollister','982 37 57 18','Washington','hollister@gmail.com');
insert into proveedores values(10,'North Face','945 54 05 81','Texas','northface@gmail.com');
insert into proveedores values(11,'Levis','967 13 71 92','Texas','levis@gmail.com');




-- ADMIN

INSERT into empleados VALUES('12345678A','admin@gmail.com','admin','admin',MD5('admin'),0); 


insert into productos VALUES(1,'Sudadera negra', 'NIke','Hombre',80,'M','sudaderaNegraNike.jpg','Sudadera negra para hoombre',1);

insert into productos VALUES(2,'Camiseta militar', 'Hollister','Hombre',40,'S','camisetaHombreHollister.jpg','Camiseta militar hombre ',9);

insert into productos VALUES(3,'Camiseta blanca', 'Chanel','Mujer',100,'S','camisetaMujerChannel.jpg','Camiseta mujer blanca',7);

insert into productos VALUES(4,'Camiseta', 'Dior','Mujer',100,'S','camisetaMujerDior.jpg','Camiseta mujer blanca',6);

insert into productos VALUES(5,'Plumas', 'North Face','Hombre',150,'L','cazadoraHombreNorthface.jpg','Cazadora morada hombre',10);

insert into productos VALUES(6,'Jersey', 'Lacoste','Mujer',70,'S','jerseyNegro.jpg','Jersey negro mujer',5);

insert into productos VALUES(7,'Polo', 'Nutica','Hombre',70,'L','poloHombreNautica.jpg','Polo rojo y azul',8);

insert into productos VALUES(8,'Sudadera', 'Joma','Hombre',55,'M','sudaderaJoma.jpg','Sudadera negra para hoombre',3);

insert into productos VALUES(9,'Sudadera gris', 'Polo','Mujer',66,'S','susdaderaMujerPolo.jpg','Sudadera gris par mujer',4);

insert into productos VALUES(10,'Zapatillas', 'Adidas','Hombre',44,'42','zapatillasAdidas.jpg','Zapatillas adidaas superstar',2);











