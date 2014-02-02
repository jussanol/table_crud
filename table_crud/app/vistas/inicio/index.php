<div>
    <h2>Ejercicio table_crud</h2>
    <h3>Introducción</h3>
    <p>De la lectura de http://en.wikipedia.org/wiki/Create,_read,_update_and_delete 
        In Database applications, the acronym CRUD refers to all of the major functions that are 
        implemented in relational database applications. Each letter in the acronym can map to a 
        standard SQL statement and HTTP method: 
    </p>	
    <table>
        <tr>
            <th>Operation</th>
            <th>SQL</th>
            <th>HTTP</th>            
        </tr>
        <tr>
            <td>Create</td>
            <td>INSERT</td>
            <td>PUT / POST</td>
        </tr>
        <tr>
            <td>Read (Retrieve)</td>
            <td>SELECT</td>
            <td>GET</td>
        </tr>
        <tr>
            <td>Update (Modif)</td>
            <td>UPDATE</td>
            <td>PUT / PATCH</td>
        </tr>
        <tr>
            <td>Delete (Destroy)</td>
            <td>DELETE</td>
            <td>DELETE</td>
        </tr>
    </table>
    <p>Hasta ahora ya somos capaces de manejar todos los comandos SQL y también de enviar peticiones 
        HTTP al servidor utilizando comandos POST y GET. 
    </p>
    <h3>Objetivo</h3>
    <p>Hacer el mantenimiento (altas, bajas, consultas y modificaciones de filas) de una tabla de datos 
        alojada en mysql con ayuda de una aplicación web escrita en php siguiendo el modelo vista 
        controlador. 
    </p>
</div>