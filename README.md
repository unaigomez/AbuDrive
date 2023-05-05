

INDICE DE CONTENIDOS

DESCRIPCIÓN DEL PROYECTO

Nuestro proyecto consiste en el desarrollo de una aplicación web destinada a la gestión de un portal de alquiler de coches para nuestros usuarios. Se va a disponer de varios coches los cuales estarán disponibles para ser alquilados a cambio de una cantidad monetaria previamente acordada. Dentro de la aplicación se podrá actualizar tanto los coches a alquilar como sus precios y dentro de la tienda habrá usuarios, los cuales podrán ver los coches disponibles y que después podrán alquilar.

La aplicación tendrá el objetivo de hacer que su uso sea práctico y útil para los usuarios que los usen. La creación de una cuenta será proporcionando: un correo, una contraseña, el nombre y apellidos de la persona, la fecha de nacimiento y el rol que tenga dentro de la institución educativa. Esta será la primera página mostrada al usuario.

Una vez se inserta una cuenta se mostrará una página con conceptos básicos y elementos esenciales para hacerla accesible visualmente y fácil de usar a escala usuaria, donde se muestran los diferentes coches disponibles para los usuarios de la web. Dentro de cada coche habrá información sobre él y la opción de poder alquilarlo si el usuario quiere.

Será desarrollada con los siguientes lenguajes de programación: MySQL, PHP, HTML, y CSS.

Para poder hacer una buena planificación y una buena estructura desarrollaremos un diagrama E-R, junto con un modelo relacional, un script DDL SQL y seeders SQL para hacer las pruebas.

Aparte de todos los elementos denominados antes también añadiremos una gestión CRUD en línea de todas las tablas de la base de datos con paginación.

Para la parte de PHP usaremos este lenguaje para implementar la aplicación en lenguaje de servidor PHP.

Para poder hacer un uso práctico y adecuado sobre los requisitos que nos interesan usaremos un CSS Bootstrap.

También usaremos una validación de los datos de entrada de formularios en el ámbito servidor junto con una validación de usuarios en uso de sesiones y para acabar usaremos una forestación de formularios.

Para poder mantener la aplicación activa y visible usaremos el repositorio de GitHub donde estará todo el código fuente compartido por el equipo de trabajo junto con una documentación de código y un control de versiones.

DIAGRAMA E-R

El diagrama de entidad relación esta implementado dentro de la carpeta de este proyecto, igualmente proporcionamos un enlace: https://drive.google.com/file/d/1A44PNnJJPBjlsO6AQ5TxRQ-hsXeUu4VG/view?usp=sharing

EXPLICACIÓN DIAGRAMA E-R

Un usuario puede hacer muchos alquileres, pero un alquiler solo se puede hacer por un usuario.

Cada alquiler del usuario solo puede tener un coche alquilado y un coche solo puede pertenecer a un único alquiler.

Además de poder alquilar coches, la aplicación web ofrecerá una opción para añadir dentro del mismo alquiler unos accesorios para el propio coche. Cada alquiler puede tener o 0 o muchos accesorios, y cada accesorio puede pertenecer a 0 o a muchos alquileres.

De cada usuario será necesario conocer: su id, nombre de usuario, contraseña, nombre, apellidos, teléfono, DNI y el correo electrónico.

De cada alquiler necesitaremos: su id, el id de usuario, el id del coche, la fecha inicio, la fecha fin, y precio final.

De cada coche será necesario conocer: su id, la marca, el modelo, el estado y el precio diario.

Y por último, de cada accesorio será necesario saber: el id, el nombre y el precio.

MODELO RELACIONAL

CREACIÓN DE TABLAS

USUARIOS:

CREATE TABLE usuarios( id_usuario int PRIMARY KEY NOT NULL, nombre_usuario varchar(255) NOT NULL, contraseña varchar(255) UNIQUE NOT NULL, nombre varchar(255) NOT NULL, cognom1 varchar(255) NOT NULL, cognom2 varchar(255) NULL, correo varchar(255) NOT NULL, teléfono varchar(255) NOT NULL, DNI varchar(255) NOT NULL );

COCHES:

CREATE TABLE coches( id_coche int PRIMARY KEY NOT NULL, marca int NOT NULL, modelo int NOT NULL, estado int NOT NULL, precio_diario int NOT NULL );

ALQUILERES:

CREATE TABLE alquileres( id_alquiler int PRIMARY KEY NOT NULL, fecha_inicio date NOT NULL, fecha_fin date NOT NULL, precio_final varchar(255) NOT NULL, FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario), FOREIGN KEY (id_coche) REFERENCES coche(id_coche) );

ACCESORIOS:

CREATE TABLE accesorios( id_accesorio int PRIMARY KEY NOT NULL, nombre int NOT NULL, precio int NOT NULL );

ALQUILER ACCESORIOS:

CREATE TABLE alquiler_accesorios( id_alquiler int PRIMARY KEY NOT NULL, id_accesorio int PRIMARY KEY NOT NULL, cantidad varchar(255) NOT NULL, costo_total varchar(255) NOT NULL, FOREIGN KEY (id_alquiler) REFERENCES alquiler(id_alquiler), FOREIGN KEY (id_accesorio) REFERENCES accesorios(id_accesorio) );

DISEÑO LÓGICO

USUARIO (id_usuario, nombre_usuario, contraseña, correo, nombre, apellidos, teléfono, DNI).

COCHES (id_coche, marca, modelo, estado, precio_diario)

ALQUILERES (id_alquiler, fecha_inicio, fecha_fin, id_usuario, id_coche, precio_final)

ALQUILERES.id_usuario es clave foránea que hace referencia al id_usuario de la tabla usuario.

ALQUILER.id_coche es clave foránea que hace referencia al id_coche de la tabla coche.

ACCESORIOS (id_accesorio, nombre, precio)

ALQUILER ACCESORIOS (id_alquiler, id_accesorio, cantidad, costo_total)

ALQUILER ACCESORIOS.id_alquiler es clave foránea que hace referencia al id_alquiler de la tabla alquiler. ALQUILER ACCESORIOS.id_accesorio es clave foránea que hace referencia al id_accesorio de la tabla accesorios.

AÑADIR DATOS COCHES

INSERT INTO coches (id_coche, marca, modelo, imagen, estado, precio_diario) VALUES (1, 'Seat', 'Leon', 'leon.jpg', 'libre', '49.99'), (2, 'Volkswagen', 'Golf', 'golf.jpg', 'libre', '59.99'), (3, 'Toyota', 'Supra MK5', 'supra.jpg', 'libre', '179.99'), (4, 'Renault', 'Clio', 'clio.jpeg', 'libre', '29.99'), (5, 'Mercedes', 'Clase A', 'clasea.jpg', 'libre', '99.99'), (6, 'Opel', 'Corsa', 'corsa.jpg', 'libre', '34.99'), (7, 'Audi', 'A1', 'a1.jpg', 'libre', '99.99'), (8, 'Fiat', 'Panda', 'panda.jpeg', 'libre', '79.99'), (9, 'Mazda', 'MX-5', 'mx5.jpg', 'libre', '199.99');

AÑADIR DATOS ACCESORIOS

INSERT INTO accesorios (id_accesorio, nombre, imagen, precio) VALUES (1, 'SillitaNiños', 'sillita.jpg', '9.99'), (2, 'Bluetooth', 'Bluetooth.jpg', '6.99'), (3, 'Cadenas Nieve', 'cadenasparanieve.jpg', '24.99'), (4, 'Baca', 'baca.jpg', '19.99'), (5, 'GPS', 'gps.png', '14.99'), (6, 'Bidón Gasolina Homologado', 'bidon.png', '9.99');

Enlace del proyecto: https://docs.google.com/document/d/140eEZ_4n-IHaiVpSaFbT0wIugZdHqVWn6GzKTOZRtsc/edit?usp=sharing

