# PORTAFOLIO
Contiene un servicio API REST desarrollado con PHP.
<br>Permite la conexión a una base de datos en MySQL, se proporcionan las interfases (vía HTTPREQUEST) necesarias para la administración y consulta de sus datos (Procesos CRUD).
<br><br><b>Autor: Ing. Roberto López</b>
<br><img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/rlopezj?color=blue&style=flat-square">
<hr>
<h1>Fase 1</h1>
<h4>Método GET</h4>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado&message=Publicado&color=success"></p>
Dada la siguiente Base de Datos.<br><br>
![Base de datos](https://user-images.githubusercontent.com/81062997/177688219-b08948d0-4d51-4736-b558-2c857673a2fd.JPG)
<b>Interfases (HttpRequest) - Listar/consultar registros de una tabla o tablas relacionadas en una base de datos de MySQL</b>
<br>El nombre de la tabla funciona como EndPoint para el requerimeinto del servicio.  En este caso: Usuarios, Ofertastrabajo, Usuariosoferta
<br><hr>
<OL>
<li><u>Listar todos los registros de una tabla</u>
    <br><label style="color:darkblue;">SELECT * from usuarios</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios
</li>
<li><u>Listar todos los registros mostrando campos específicos de una tabla (correo_usuario y nombre_usuario)</u>
    <br><label style="color:darkblue;">SELECT correo_usuario,nombre_usuario from usuarios</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?campos=correo_usuario,nombre_usuario
</li>
<li><u>Listar todos los registros de una tabla y ordenados por un campo (correo_usuario) de forma ascendente.</u>
    <br><label style="color:darkblue;">SELECT * from usuarios order by correo_usuario ASC</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?ordenarPor=correo_usuario&orden=ASC
</li>
<li><u>Listar todos los registros entre los indices 0 y 2</u>
    <br><label style="color:darkblue;">SELECT * from usuarios LIMIT 0, 2</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?desde=0&hasta=2 
</li>
<li><u>Listar todos los registros de una tabla, donde un campo específico (id_usuario) se encuentra en un rango de valores, también se lo ordena por un campo (correo_usuario) de forma ascendente.</u>
    <br><label style="color:darkblue;">SELECT * from usuarios WHERE id_usuario BETWEEN 1 and 3</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?entre=id_usuario&val1=1&val2=3&{ordenarPor=correo_usuario&orden=ASC
</li>
<li><u>Listar todos los registros de una tabla, donde un campo específico (id_usuario) se encuentre en un conjunto de valores y además un campo específico (id_usuario) se encuentre en un rango de valores, también se lo ordena por un campo (correo_usuario) de forma ascendente.</u>
    <br><label style="color:darkblue;">SELECT * from usuarios WHERE id_usuario IN (1,3,4) AND id_usuario BETWEEN 1 and 3 order by correo_usuario ASC</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?pertenece=id_usuario&conjunto=1,3,4&entre=id_usuario&val1=1&val2=3&ordenarPor=correo_usuario&orden=ASC
</li>
<li><u>Listar todos los registros donde un campo específico (tipo_documento_usuario) contenga un texto específico ("CED").</u>
    <br><label style="color:darkblue;">SELECT * from usuarios WHERE tipo_documento_usuario LIKE '%CED%'</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=tipo_documento_usuario&buscar=CED
</li>
<li><u>Listar todos los registros filtrados (WHERE) donde un campo específico (date_create_usuarios) tenga un determinado valor (2022-05-30) (Se puede agregar más de un campo en el parámetro c_where, cada item por una "," [coma]) (Se puede agregar más de un valor de campo en el parámetro v_where, cada item por "(,)")</u>
    <br><label style="color:darkblue;">SELECT * from usuarios WHERE date_create_usuarios = :date_create_usuarios</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios&v_where=2022-05-30
    <br><label style="color:darkblue;">SELECT * from usuarios WHERE date_create_usuarios = :date_create_usuarios AND id_usuario = :id_usuario</label>
    <br>http://portafoliorc.epizy.com/apirest/usuarios?c_where=date_create_usuarios,id_usuario&v_where=2022-05-30(,)1
</li>
<li><u>Listar campos específicos de los registros en tablas relacionadas</u>
    <br><label style="color:darkblue;">Select nombre_usuario, correo_usuario, nombre_oferta_trabajo from usuariosoferta INNER JOIN usuarios ON usuariosoferta.usuario_usuarios_oferta = usuarios.id_usuario INNER JOIN ofertastrabajo ON usuariosoferta.oferta_usuarios_oferta = ofertastrabajo.id_oferta_trabajo</label>
    <br>http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario, correo_usuario, nombre_oferta_trabajo
</li>
<li><u>Listar campos específicos de los registros en tablas relacionadas aplicándo filtro (where) y ordenamiento</u>
    <br><label style="color:darkblue;">Select nombre_usuario,correo_usuario,nombre_oferta_trabajo from usuariosoferta INNER JOIN usuarios ON usuariosoferta.usuario_usuarios_oferta = usuarios.id_usuario INNER JOIN ofertastrabajo ON usuariosoferta.oferta_usuarios_oferta = ofertastrabajo.id_oferta_trabajo WHERE id_usuario = :id_usuario order by usuarios.id_usuario DESC</label>
    <br>http://portafoliorc.epizy.com/apirest/ListaUsuariosXOferta?ordenarPor=usuarios.id_usuario&orden=DESC&relaciones=usuariosoferta,usuarios,ofertastrabajo&claves_relaciones=null,usuario_usuarios_oferta;id_usuario,oferta_usuarios_oferta;id_oferta_trabajo&campos=nombre_usuario,correo_usuario,nombre_oferta_trabajo&c_where=id_usuario&v_where=2
</li>
</OL>
<b><h4>NOTA:</h4></b>En cualquier caso si se agrega el parámerto verLog=Si se podrá ver el query de SQL a ejecutar.
<br><br>Las pruebas de este método pueden realizarse sin problemas en línea ya que se trata de devoluciones de archivos en formato JSON, lo único que habrá que realizar es click en el enlace correspondiente a cada caso
<br><br>Se pueden hacer varias combinaciones de criterios según sea la necesidad de la consulta.
<br><hr>
<b><h4>RECORDAR:</h4></b>El nombre de la tabla es un EndPoint en el caso de hacer una operación directamente a esa tabla.
<br><br>Para este API REST si se desean combinar tablas en relaciones se debe usar como EndPoint "ListaUsuariosXOferta" (En el código se puede modificar se desea hacerse un poco más general la descripción del EndPoint)
<br><br>Resumen de los parámetros programados.<br>
<table width="50%">
<tr><td>Parámetro</td><td>Descripción</td></tr>
<tr><td>campos</td><td>Lista de campos del EndPoint (Tabla-s) a mostrar, separados por "," (coma)</td></tr>
<tr><td>c_where</td><td>Lista de campos del EndPoint (Tabla-s) con los que se filtrará la tabla (Operador de igualdad), separados por "," (coma), debe estar acompañado del parámetro "v_where" o "buscar" </td></tr>
<tr><td>v_where</td><td>Lista de valores de campos del EndPoint (Tabla-s) con los que se filtrará (Operador de igualdad), separados por "(,)" (abre paréntesis+coma+cierra paréntesis), debe estar acompañado del parámetro "c_where"</td></tr>+
<tr><td>buscar</td><td>Valor con el que se filtrará el EndPoint (Tabla-s) usando el operador LIKE, debe estar acompañado del parámetro "c_where" (sólo al primer campo de esta lista se le aplicará el operador LIKE)</td></tr>
<tr><td>pertenece</td><td>Campo del EndPoint (Tabla-s) con el que se filtrará (Operador IN), debe estar acompañado del parámetro "conjunto"</td></tr>
<tr><td>conjunto</td><td>Conjunto de valores de un campo del EndPoint (Tabla-s) con los que se filtrará (Operador IN), debe estar acompañado del parámetro "pertenece"</td></tr>
<tr><td>entre</td><td>Campo del EndPoint (Tabla-s) con el que se filtrará (Operador BETWEEN), debe estar acompañado de los parámetros "val1" y "val2"</td></tr>
<tr><td>val1</td><td>Valor inicial de un campo del EndPoint (Tabla-s) con el que se filtrará (Operador BETWEEN), debe estar acompañado de los parámetros "entre" y "val2"</td></tr>
<tr><td>val2</td><td>Valor final de un campo del EndPoint (Tabla-s) con el que se filtrará (Operador BETWEEN), debe estar acompañado de los parámetros "entre" y "val1"</td></tr>
<tr><td>ordenarPor</td><td>Campo del EndPoint (Tabla-s) con el que se ordenaran los registros (Cláusula ORDER BY), debe estar acompañado del parámetro "orden"</td></tr>
<tr><td>orden</td><td>Uno de dos valores recomendados "ASC" o "DESC" (cualquier otro mostrará error o no se procesará adecuadamente), debe estar acompañado del parámetro "ordenarPor"</td></tr>
<tr><td>desde</td><td>Valor correspondiente al indice de inicio utilizado con la cláusula LIMIT de MySQL, debe estar acompañado del parámetro "hasta"</td></tr>
<tr><td>hasta</td><td>Valor correspondiente al indice final utilizado con la cláusula LIMIT de MySQL, debe estar acompañado del parámetro "desde"</td></tr>
<tr><td>relaciones</td><td>Lista de tablas relacionadas y que se enlazaran con la cláusula INNER JOIN, separadas por "," (coma), debe estar acompañado del parámetro "claves_relaciones"</td></tr>+
<tr><td>claves_relaciones</td><td>Lista de pares de campos (campo;campo) que se relacionan en el INNER JOIN, separadas por "," (coma) (el primero en la lista debe ser un null, ver el ejemplo), debe estar acompañado del parámetro "relaciones"</td></tr>
</table>
<hr>
# PORTAFOLIO
<h1>Fase 2</h1>
<h4>Método POST</h4>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado API&message=Publicado&color=success"></p>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado Formulario REACT&message=Publicado&color=success"></p>
<br><b>Interfases (HTML y URLs) - Ingresar registros a las tablas de una base de datos en MySQL</b>
<br><hr>
Se crea la programación necesaria dentro del API REST para manejar los requerimientos POST utilizando como EndPoint el nombre de la tabla y como parámetros de formulario (Body) del método los nombres de los campos de la tabla.
<br><br>Adicionalmente, se crea un formulario con tecnología REACTJS, para realizar la inserción de los datos, el formulario se encuentra cargado en el repositorio <a href="https://github.com/rclopezjativa/PORTAFOLIO---BD-CRUD-REACTJS">PORTAFOLIO---BD-CRUD-REACTJS</a>.
<b><h4>NOTA:</h4></b>En cualquier caso si se agrega el parámertox verLog=Si al requerimiento se podrá ver el query de SQL a ejecutar.
<br><br>Las pruebas de este método pueden realizarse utilizando el formulario HTML creado con REACTJS de forma local.  En este repositorio se darán las indicaciones y consejos para hacer las pruebas de forma local
<hr>
# PORTAFOLIO
<h1>Fase 3</h1>
<h4>Método PUT</h4>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado API&message=Publicado&color=success"></p>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado Formulario REACT&message=En Desarrollo&color=orange"></p>
<br><b>Interfases (HTML y URLs) - Actualizar registros en las tablas de una base de datos en MySQL</b>
<br><hr>
Se crea la programación necesaria dentro del API REST para manejar los requerimientos PUT utilizando como EndPoint el nombre de la tabla y como parámetros de formulario (Body) del método los nombres de los campos de la tabla a actualizar.  Se programan dos parámetros adicionales que son $_GET["PUT"] y $_GET["criterio"], el primero para identificar que se trata de un procedimiento con el método PUT ya que no existe un metadata $_PUT con el que se pueda trabajar en PHP y el segundo contiene el criterio sobre el cual se aplicará la actualización (filtro); por prudencia no se ejecutará una sentencia UPDATE sin un criterio de actualización especificado.
<b><h4>NOTA:</h4></b>En cualquier caso si se agrega el parámertox verLog=Si al requerimiento se podrá ver el query de SQL a ejecutar.
# PORTAFOLIO
<h1>Fase 4</h1>
<h4>Método DELETE</h4>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado API&message=Publicado&color=success"></p>
<p align="left"><img src="https://img.shields.io/static/v1?label=Estado Formulario REACT&message=En Desarrollo&color=orange"></p>
<br><b>Interfases (HTML y URLs) - Eliminar registros de las tablas de una base de datos en MySQL</b>
<br><hr>
Se crea la programación necesaria dentro del API REST para manejar los requerimientos DELETE utilizando como EndPoint el nombre de la tabla.  Se programan dos parámetros que son $_GET["DELETE"] y $_GET["criterio"], el primero para identificar que se trata de un procedimiento con el método DELETE ya que no existe un metadata $_DELETE con el que se pueda trabajar en PHP y el segundo contiene el criterio sobre el cual se aplicará la eliminación (filtro); por prudencia no se ejecutará una sentencia DELETE sin un criterio de eliminación especificado.
<b><h4>NOTA:</h4></b>En cualquier caso si se agrega el parámertox verLog=Si al requerimiento se podrá ver el query de SQL a ejecutar.
