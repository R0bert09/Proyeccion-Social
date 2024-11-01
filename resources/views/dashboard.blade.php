<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">
</head>
<body>

    <div class="contenedorPrincipal">

        <div class="contenedorPrincipal__titulo">
            <h1>Dashboard</h1>
        </div>

        <div class="informacion">
            <div class="informacion__estudiantes">
                <h3>Total Estudiantes</h3>
                <p>estudiantes activos</p>
                <h2>120</h2>
            </div>
            <div class="informacion__proyectos">
                <h3>Proyectos Activos</h3>
                <p>Proyectos en curso</p>
                <h2>23</h2>
            </div>
            <div class="informacion__asesores">
                <h3>Asesore/Estudiantes</h3>
                <p>Total de asesores</p>
                <h2>12</h2>
            </div>
        </div>

        <div class="graficos">
            <div class="graficos__Estado">
                <h2>Estado de Proyectos</h2>
            </div>
            <div class="graficos__Estudiantes">
                <h2>Estudiantes y Proyectos por Mes</h2>
            </div>
        </div>

    </div>

</body>
</html>
