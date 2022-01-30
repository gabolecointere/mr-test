## ManyRequests - Prueba de codigo 

La siguiente prueba consta de dos ejercicios para evaluar sus conocimientos con el Framework Laravel. Se provee una aplicacion basica con modelos y relaciones correspondientes y se espera que usted complete dos tareas para mejorar dicha aplicacion. 

Preferiblemente, complete el ejercicio en un periodo de tiempo continuo. Deberia tomar entre 3 - 5 horas.

Usted recibira un pago de 50 USD en un maximo de 3 dias despues de completar la prueba.

## Preparacion 

1) Haga fork de este repositorio y mantengalo publico en su perfil de GitHub e instale el proyecto en local.

2) Cree una base de datos para el proyecto, corra las migraciones y seed para tener la data necesaria para completar el ejercicio.

`php artisan migrate`

`php artisan db:seed`

3) Resuelva el ejercicio en un branch distinto de Main.

3) Haga tantos commits como sea posible para poder apreciar el procedimiento que usted lleva a cabo para resolver el problema.

4) Al terminar, cree un PR hacia main. Agrege tantos comentarios en el PR como considere necesario. La entrega del ejercicio sera el link hacia dicho PR que contiene la solucion.

## Ejercicio 1

En la aplicacion se proveen los siguientes modelos: `User`, `Post`, `Comment`, `PostAttachment` y `CommentAttachment`.

Relaciones definidas:
* `User` has many `Post`
* `Post` has many `Comment`
* `Post` has many `PostAttachment`
* `Comment` has many `CommentAttachment`

`PostAttachment` y `CommentAttachment` representan archivos adjuntos a los modelos `Post` y `Comment` respectivamente. 

Se desea sustituir estos dos modelos (`PostAttachment` y `CommentAttachment`) por un solo modelo `Attachment` que mantenga una relacion One To Many (Polimorfica) con Post y Comment. Es decir, en lugar de una tabla de archivos adjuntos para cada modelo, se quiere tener una sola tabla de attachments usada por ambos modelos.

1) Cree dicho modelo y defina las relaciones necesarias para sustituir las dos relaciones mencionadas por la nueva relacion polimorfica con el modelo `Attachment`.

2) Los modelos `Post` y `Comment` tienen un numero respectivo de `PostAttachment` y `CommentAttachment`creados anteriormente (durante el seed). Escriba un Script que luego de haber definido el nuevo modelo y la nueva relacion, migre la data de las tablas post_attachments y comment_attachments a la nueva tabla attachments perteneciente al modelo `Attachment`. No debe haber perdida de informacion. Cree el siguiente comando de consola que ejecute dicho Script: 

`php artisan migrate_attachments_data`

3) Escriba pruebas automatizadas para probar y garantizar la funcionalidad del comando de la migracion. 

4) Documente como parte del contenido  del PR los pasos que debe seguir otro desarrollador para incluir los cambios realizados en este ejercicio en su proyecto. 

## Ejercicio 2

En la ruta `/index` se muestra una serie de tablas con informacion sobre los posts que posee cada usuario. Este proyecto instala la herramienta `barryvdh/laravel-debugbar` con la cual puede observar al visitar dicha ruta, que para cargar la informacion se ejecutan 656 queries y se cargan 555 modelos. 

1) Realize los cambios que considere necesarios tanto en el controlador de dicha ruta como en la vista respectiva para reducir la cantidad de queries y mejorar el desempeño en dicha ruta tanto como sea posible. En la herramienta laravel debugbar podra identificar # queries, # modelos, tiempo de carga y uso de memoria.

2) Escriba pruebas automatizadas antes de realizar los cambios para asegurarse de que el resultado en la ruta `/index` sigue siendo el despues de aplicar los cambios.  

3) Documente como parte del contenido del PR las mejoras realizadas, justifique su decision e incluya una comparativa de los datos de desempeño mostrados en la herramienta laravel debugbar antes y despues de aplicar dichas mejoras. 

Si tiene alguna duda, escriba al correo `gabriel@manyrequests.com`


