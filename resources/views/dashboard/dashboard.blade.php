@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


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
            <h3>Tutores</h3>
            <p>Total de tutores</p>
            <h2>12</h2>
        </div>
    </div>

    <div class="graficos">
        <div class="graficos__Estado">
            <canvas id="estadoProyectosChart"></canvas>
        </div>
        <div class="graficos__Estudiantes">
            <canvas id="estudiantesProyectosChart"></canvas>
        </div>
    </div>

</div>
@endsection

