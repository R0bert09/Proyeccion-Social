document.addEventListener("DOMContentLoaded", function() {
    // Configuración del gráfico para Estado de Proyectos (tipo pastel)
    const ctxEstado = document.getElementById('estadoProyectosChart').getContext('2d');
    const estadoProyectosChart = new Chart(ctxEstado, {
        type: 'pie',
        data: {
            labels: ['En Progreso', 'Completados', 'En revisión'],
            datasets: [{
                label: 'Estado de Proyectos',
                data: [30, 45, 25],
                backgroundColor: ['#36A2EB', '#4BC0C0', '#FFCE56'],
                borderColor: ['#36A2EB', '#4BC0C0', '#FFCE56'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Estado de Proyectos',
                    align: 'start',
                    font: {
                        size: 23,
                        color: '#46de31' 
                    }
                },
                legend: {
                    position: 'bottom' 
                }
            }
        }
    });
    
    const ctxEstudiantes = document.getElementById('estudiantesProyectosChart').getContext('2d');
    const estudiantesProyectosChart = new Chart(ctxEstudiantes, {
        type: 'bar',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr'],
            datasets: [{
                label: 'Estudiantes',
                data: [80, 60, 75, 90],
                backgroundColor: 'rgba(153, 102, 255, 0.7)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }, {
                label: 'Proyectos',
                data: [40, 50, 60, 70],
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Estudiantes y Proyectos por Mes',
                    align: 'start',
                    font: {
                        size: 23,
                        color: '#000000' 
                    }
                },
                legend: {
                    position: 'bottom' 
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
