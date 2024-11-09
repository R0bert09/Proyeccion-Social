<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fetchProyectos = async () => {
                try {
                    // Definir el endpoint
                    const url = '/proyectos';

                    // Realizar la solicitud GET utilizando fetch
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    // Verificar si la respuesta es exitosa
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Manejar la respuesta JSON
                    const proyectos = await response.json();
                    console.log(proyectos);

                    // Lógica para manejar y mostrar los datos en el frontend
                    const proyectosContainer = document.getElementById('proyectos-container');
                    proyectos.forEach(proyecto => {
                        const proyectoElement = document.createElement('div');
                        proyectoElement.innerText = `ID: ${proyecto.id}, Nombre: ${proyecto.nombre_proyecto}, Estado: ${proyecto.estado}`;
                        proyectosContainer.appendChild(proyectoElement);
                    });
                } catch (error) {
                    console.error('Error fetching proyectos:', error);
                }
            };

            // Llamar a la función fetchProyectos cuando la página se carga
            fetchProyectos();
        });
    </script>
</head>
<body>
    <h1>Lista de Proyectos</h1>
    <div id="proyectos-container"></div>
</body>
</html>