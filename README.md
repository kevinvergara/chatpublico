## CHATPUBLICO

Proyecto hecho con el framework de php, laravel, trata a grandes rasgos de un chat publico, donde se puede postear texto, y se puede comentar con texto, videos o imagenes. Lo cual todos los registrados pueden ver, debido a que es público.

## Ambiente

- Ambiente **docker**.
- En el repositorio esta el Dockerfile (Dockerfile1) de la primera imagen creada, en base a **ubuntu**, donde se instalan las dependencias necesarias para correr un proyecto **laravel**, principalmente php y sus librerias, junto con la configuración de **apache**.
- También se encuentra la imagen final usada en el proyecto (Dockerfile) , donde se configura el volumen compartido para tener el proyecto.
- Está por supuesto el docker-compose, donde se levanta el ambiente, junto con los dockers de **mysql** y **redis**.

## Tecnología

- El proyecto esta desarrollado en la versión 5.6 de laravel.
- Se complementa con la versión 7.2 de php.
- Los almacenes de datos usados, son mysql-5.7 y redis-4.0.
- Otra tecnología importante usada es **Pusher**, la librería que se encarga de las notificaciones.

## Descripción

- El proyecto esta conectado con dos almacenes de datos, una es mysql, donde esta el modelo que tiene como principales tablas usuario, post, comentario.
- El otro es el almacen, donde se alojan los tokens en relacion con los nick de usuario, y tambien los textos de los comentarios.
- Se cuenta con la vista principal donde se ingresa el nick con el cual se podran realizar todas las acciones dentro del sistema.
- Al entrar se encuentra un menú, donde se puede seleccionar post para comentar (acá tamnien se puede ver la información del post, tanto comentarios como descripción) , y tambien se puede crear un post.
- En la página principal del sistema, se recibirán las notificaciones de cuando un usuario comente un post, entregando el nick de ese usario, y el id del post.

## Dificultades y Consideraciones

- Lo que principalmente me costo, fue levantar un ambiente en dockers, la verdad no conocia la tecnología, solo a nivel conceptual.
- También no conocia redis, y tambien pusher, pero no fue tan complicado.
- Me hubiese gustado agregarle mas funcionalidades, pero por temas de tiempo no pude profundizar mas, por lo que me enfoque sólo en lo pedido.
- Lo mas débil del sistema es la seguridad, o sea no es necesaria mayor seguridad en realidad, pero por ejemplo lo de los tokens en redis, solo esta básicamente desarrollado, o sea solo funcional.
- En el proyecto dejare el modelo de la base de datos (modelo_base.mwb y chatpublicodb.sql).
- También si es útil, quite el .env del .gitignore para poder subirlo (se que no es seguro, pero mas que todo por si es útil).

## License

**Kevin Andres Vergara Muñoz**
**Ing. civil informático**
**Pontificia universidad católica de valparaíso**
