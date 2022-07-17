# PORTAFOLIO
<h1>Fase 1</h1>
<h4>Método GET</h4>
<p align="left">
   <img src="https://img.shields.io/static/v1?label=Estado&message=Publicado en portafolio&color=success">
</p>
Contiene un servicio API REST desarrollado con PHP 
<br>Permite realizar la conexión a una base de datos MySQL, proporcionando las interfases necesarias para la administración y consulta de sus datos.
<br><br><b>Autor: Ing. Roberto López</b>
<br><img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/rlopezj?color=blue&style=flat-square">
Dada la siguiente Base de Datos.<br><br>

![Base de datos](https://user-images.githubusercontent.com/81062997/177688219-b08948d0-4d51-4736-b558-2c857673a2fd.JPG)

<b>Interfases (URLs) - Listar registros de tabla o tablas relacionadas de MySQL</b>
<br><hr>
<u>Todos los registros</u>
<br>SELECT * from usuarios
<br>http://portafoliorc.epizy.com/apirest/usuarios
<br><hr>
<u>Todos los registros mostrando los campos correo_usuario y nombre_usuario</u>
<br>SELECT correo_usuario,nombre_usuario from usuarios
<br>http://portafoliorc.epizy.com/apirest/usuarios?campos=correo_usuario,nombre_usuario
<br><hr>
<u>Todos los registros ordenados por el campo correo_usuario de forma ascendente.</u>
<br>SELECT * from usuarios order by correo_usuario ASC
<br>http://portafoliorc.epizy.com/apirest/usuarios?ordenarPor=correo_usuario&orden=ASC
<br><hr>
<u>Los registros entre los indices 0 y 2</u>
<br>SELECT * from usuarios LIMIT 0, 2
<br>http://portafoliorc.epizy.com/apirest/usuarios?desde=0&hasta=2 
<br><hr>
<u>Todos los registros con el valor del campo id_usuario "entre" los valores 1 y 3, y ordenados por el campo correo_usuario de forma ascendente.</u>
<br>SELECT * from usuarios WHERE id_usuario BETWEEN 1 and 3
<br>http://portafoliorc.epizy.com/apirest/usuarios?entre=id_usuario&val1=1&val2=3&{ordenarPor=correo_usuario&orden=ASC
<br><hr>
<u>Todos los registros con el valor del campo id_usuario cuyo valor se encuentre entre los valores (1,3,4) y el campo id_usuario tambien esté "entre" los valores 1 y 3, y ordenados por el campo correo_usuario de forma ascendente.</u>
<br>SELECT * from usuarios WHERE id_usuario IN (1,3,4) AND id_usuario BETWEEN 1 and 3 order by correo_usuario ASC
<br>http://portafoliorc.epizy.com/apirest/usuarios?pertenece=id_usuario&conjunto=1,3,4&entre=id_usuario&val1=1&val2=3&ordenarPor=correo_usuario&orden=ASC
<br><hr>
<u>Todos los registros donde el campo tipo_documento_usuario contiene el texto "CED"</u>
<br>SELECT * from usuarios WHERE tipo_documento_usuario LIKE '%CED%'
<br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=tipo_documento_usuario&buscar=CED
<br><hr>
<u>Todos los registros donde el campo date_create_usuarios es igual a 2022-05-30 (Se puede agregar más de un campo en el parámetro c_where, cada item por una "," [coma]) (Se puede agregar más de un campo en el parámetro v_where, cada item por "(,)")</u>
<br>SELECT * from usuarios WHERE date_create_usuarios = :date_create_usuarios
<br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios&v_where=2022-05-30
<br>SELECT * from usuarios WHERE date_create_usuarios = :date_create_usuarios AND id_usuario = :id_usuario
<br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios,id_usuario&v_where=2022-05-30(,)1
<br><hr>
<u>Registros de tablas relacionadas</u>
<br>Select nombre_usuario, correo_usuario, nombre_oferta_trabajo from usuariosoferta INNER JOIN usuarios ON usuariosoferta.usuario_usuarios_oferta = usuarios.id_usuario INNER JOIN ofertastrabajo ON usuariosoferta.oferta_usuarios_oferta = ofertastrabajo.id_oferta_trabajo
<br>http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario, correo_usuario, nombre_oferta_trabajo
<br><hr>
<u>Registros de tablas relacionadas aplicándo where, order by</u>
<br>Select nombre_usuario,correo_usuario,nombre_oferta_trabajo from usuariosoferta INNER JOIN usuarios ON usuariosoferta.usuario_usuarios_oferta = usuarios.id_usuario INNER JOIN ofertastrabajo ON usuariosoferta.oferta_usuarios_oferta = ofertastrabajo.id_oferta_trabajo WHERE id_usuario = :id_usuario order by usuarios.id_usuario DESC
<br>http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?ordenarPor=usuarios.id_usuario&orden=DESC&relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario,correo_usuario,nombre_oferta_trabajo&c_where=id_usuario&v_where=2
<br><hr>
<b><h4>NOTA:</h4></b>En cualquier caso si se agrega el parámerto verLog=Si se podrá ver el query de SQL a ejecutar
<br><hr>
<b><h4>NOTA:</h4></b>Las pruebas de este método pueden realizarse sin problemas en línea ya que se trata de devoluciones de archivos de formato JSON, lo único que habrá que realizar es click en el enlace correspondiente a cada caso
<br><hr>
# PORTAFOLIO
<h1>Fase 2</h1>
<h4>Método POST</h4>
<p align="left">
   <img src="https://img.shields.io/static/v1?label=Estado&message=Publicado en portafolio&color=success">
</p>
<br><b>Interfases (HTML y URLs) - Ingresar registros a las tablas de MySQL</b>
<br><hr>
Se crea la programación necesaria dentro del API REST para manejar los requerimientos POST utilizando como EndPoint el nombre de la tabla y como parámetros del método los nombres de los campos de la tabla.
<br><br>Adicionalmente, se crea un formulario con tecnología REACTJS, para realizar la inserción de los datos, el formulario se encuentra cargado en el repositorio <a href="https://github.com/rclopezjativa/PORTAFOLIO---BD-CRUD-REACTJS">PORTAFOLIO---BD-CRUD-REACTJS</a>.
