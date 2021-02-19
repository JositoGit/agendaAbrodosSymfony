# Decripción del proyecto 
La KnekroGenda es una aplicación diseñada para gestionar los contactos de un usario dividiéndolos en dos tipos: profesional (para la gente de negocios) y personal (personas amigables, familia, etc...).
Este programa permite agregar, visualizar, modificar, editar y eliminar los diferentes registros hechos. Cabe destacar que al visualizar los contactos, dispone de tres modos: uno genérico donde se visualizan todos haciendo una distinción mediante un emoticono en la sección de "Type" de la tabla, y dos para cada tipo de contacto. 


# Uso
Una vez iniciamos el servidor de symfony e introducir la siguiente url en el navegador de preferencia __http://localhost:8000/contact/__, se visualizará una web con un total de cinco interacciones:
| Entrada| Description |
| ------ | ----------- |
| *Add*|  permite agregar un contacto llevando al usuario a un formulario que debe de cubrir y dale al botón de *Save* para almacenar los datos una vez todos esten cubiertos y cumplan los requisitos. De no cunmplirlos se mostrarán unos mensajes sobre esos campos incorrectos indicando el modelo que se espera.|
| *Home* | redirige al index  |
| *LosBros*| muestra los contactos de tipo __personal__ |
| *Global*| muestra todos los contactos |
| *Business People*| muestra los contactos de tipo __profesional__ |
Para hacer una selección del tipo de contacto, se realiza un condicional al mostrar cada objeto __{% if (typeContact=contact.type or typeContact='all') %}__ (la sintaxis correcta es con 2 = para la comparción de datos, pero así se destacaría el texto).
 
## Requisitos e instalación
Xampp: __https://www.apachefriends.org/es/download.html__
Symfony: __https://symfony.com/download__
Composer: __https://getcomposer.org/download/__

## Desarrollador/es
Jose Manuel Abrodos Torres, ak Josito.


## Licencia
No.
## Contribución
No hace falta, es bueno compartir.

