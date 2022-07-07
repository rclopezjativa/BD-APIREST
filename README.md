# BD-APIREST
Un servicio API desarrollado con PHP 
Permite realizar la conexión a una base de datos MySQL, proporcionando las interfases necesarias para la administración y consulta de sus datos.

Dada la siguiente Base de Datos.

![Base de datos](https://user-images.githubusercontent.com/81062997/177688219-b08948d0-4d51-4736-b558-2c857673a2fd.JPG)

Primera fase:

Método GET

Interfases - Listar registros de tabla o tablas relacionadas de MySQL

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros

SELECT * from usuarios

http://portafoliorc.epizy.com/apirest/usuarios

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros mostrando los campos correo_usuario y nombre_usuario

SELECT correo_usuario,nombre_usuario from usuarios

http://portafoliorc.epizy.com/apirest/usuarios?campos=correo_usuario,nombre_usuario

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros ordenados por el campo correo_usuario de forma ascendente.

SELECT * from usuarios order by correo_usuario ASC

http://portafoliorc.epizy.com/apirest/usuarios?ordenarPor=correo_usuario&orden=ASC

-----------------------------------------------------------------------------------------------------------------------------------------------------

Los registros entre los indices 0 y 2



http://portafoliorc.epizy.com/apirest/usuarios?desde=0&hasta=2 

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros con el valor del campo id_usuario "entre" los valores 1 y 3, y ordenados por el campo correo_usuario de forma ascendente.



http://portafoliorc.epizy.com/apirest/usuarios?entre=id_usuario&val1=1&val2=3&{ordenarPor=correo_usuario&orden=ASC

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros con el valor del campo id_usuario cuyo valor se encuentre entre los valores (1,3,4) y el campo id_usuario tambien esté "entre" los valores 1 y 3, 
y ordenados por el campo correo_usuario de forma ascendente.



http://portafoliorc.epizy.com/apirest/usuarios?pertenece=id_usuario&conjunto=1,3,4&entre=id_usuario&val1=1&val2=3&ordenarPor=correo_usuario&orden=ASC

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros donde el campo tipo_documento_usuario contiene el texto "CED"



http://portafoliorc.epizy.com/apirest/usuarios?c_where=tipo_documento_usuario&buscar=CED

-----------------------------------------------------------------------------------------------------------------------------------------------------

Todos los registros donde el campo date_create_usuarios es igual a 2022-05-30 (Se puede agregar más de un campo en el parámetro c_where, cada item por una "," [coma])
(Se puede agregar más de un campo en el parámetro v_where, cada item por "(,)")



http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios&v_where=2022-05-30

http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios,id_usuario&v_where=2022-05-30(,)1

-----------------------------------------------------------------------------------------------------------------------------------------------------

Registros de tablas relacionadas



http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario, correo_usuario, nombre_oferta_trabajo

-----------------------------------------------------------------------------------------------------------------------------------------------------

Registros de tablas relacionadas aplicándo where, order by



http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?ordenarPor=usuarios.id_usuario&orden=DESC&relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario,correo_usuario,nombre_oferta_trabajo&c_where=id_usuario&v_where=2

-----------------------------------------------------------------------------------------------------------------------------------------------------

NOTA: En cualquier caso si se agrega el parámerto verLog=Si se podrá ver el query de SQL a ejecutar

-----------------------------------------------------------------------------------------------------------------------------------------------------

Segunda Fase:

Método POST

En Desarrollo
