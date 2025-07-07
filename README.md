<h1>Prueba MerkurIA</h1>

<h2>Instrucciones de instalación</h2>
<ul>
  <li>Clonar repositorio dentro del directorio plugins/ de la instalación de WordPress</li>
  <li>Activar el plugin desde el dashboard de WordPress.</li>
  <li>Instalar las dependencias y compilar el bloque:</li>
</ul>

 ```
cd blocks/client-block
npm install
npm run build
```
<ul>
  <li>Importar el archivo SQL (wordpress_examen.sql) en la base de datos local para precargar la tabla extra y usuario registrado.</li>
</ul>

<h2>Parte 1: WordPress</h2>
<p><b>Objetivo: Evaluar integración de PHP con la arquitectura, plugins y bloques de WordPress</b></p>
<h3> * Registro de un Custom Post Type llamado `clientes`</h3>

<ul>
  <li>Se registró un CPT personalizado que permite registrar y visualizar 'clientes' por medio del dashboard de Wordpress.</li>
</ul>

```
client-cpt.php
```
<ul>
  <li>Se agregaron campos adicionales como correo electrónico y origen del cliente en la pantalla de registro y edición de cliente.</li>
</ul>

```
client-metaboxes.php
```
<ul>
  <li>Se realizó la función de guardado específico del cliente, 
    tomando el nombre como <b>post_title</b> en la tabla <b>wp_post</b>, 
    el email en la tabla <b>wp_postmeta</b> y el origen en el campo <b>origen_cliente</b> en la tabla <b>wp_clientes_extra</b>.</li>
</ul>

```
save-client.php
```
<sub>Visualización del CPT</sub>
![image](https://github.com/user-attachments/assets/69dedeb5-98d9-492b-a956-09715731ca6a)

<h3> * Bloque Gutenberg con configuración dinámica</h3>

<ul>
  <li>Una vez compilado, el bloque "Cliente destacado" se podrá ver y utilizar en el editor de bloques.</li>
  <li>Se puede elegir un color de fondo mediante un selector visual en el editor.</li>
  <li>El renderizado dinámico en el frontend mediante PHP.</li>
  <li><b>NOTA:</b> Tuve problemas al usar <b>render</b> directamente en <b>block.json</b> porque la función aún no estaba registrada al momento de su carga. 
    Se solucionó utilizando <b>render_callback</b> directamente dentro del <b>register_block_type()</b>.</li>
</ul>

```
/blocks/client-block/
```

<sub>Visualización bloque en editor</sub>
![image](https://github.com/user-attachments/assets/fb391918-4cd0-4af5-b6da-7d12e0107c23)

<sub>Visualización bloque en vista renderizada</sub>
![image](https://github.com/user-attachments/assets/da7abfde-fba3-407e-b161-5ba0f67002a4)

<h3> * API REST personalizada</h3>

<ul>
  <li>Se creó un función que crea y permite el uso de una API REST <b>/wp-json/empresa/v1/clientes</b>.</li>
</ul>

```
client-api.php
```
<sub>Visualización respuesta endpoint</sub>
![image](https://github.com/user-attachments/assets/17d29dfb-c031-4f2b-a606-6adcf2a0adf5)

<h2>Comentarios</h2>
Este proyecto realmente fue un gran reto técnico para mí, ya que no tenía experiencia previa con el desarrollo de WordPress a un nivel 'bajo' para el desarollo de cosas especificas,
investigue de manera general el funcionamiento de los Custom Post Types, metaboxes, bloques Gutenberg e implementación de WordPress y REST API.
En el proceso, investigue en foros, documentación, artículos técnicos y también la ayuda de ChatGPT para poder guiarme y consultar dudas y realización de procesos similares como guia.
Debido a motivos personales tuve un tiempo limitado para realizar esta prueba, me enfoqué en completar la primera parte del plugin de Wordpress funcional.
Espero que pueda apreciarse el esfuerzo realizado, aprendí mucho en el camino y me gustaría saber de un feedback del trabajo hecho, gracias.
