<?php

namespace App\Http\Controllers;

use App\Exports\DepartamentosExport;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;





class DepartamentoController extends Controller // Cambiamos el nombre de la clase a DepartamentoController
{
    /**
     * Muestra una lista de los departamentos.
     */
    public function index(Request $request): View // Cambiamos el tipo de retorno a View
    {
        // Obtener los parámetros de búsqueda y ordenación desde la solicitud
        $search = $request->input('search');
        $sortOrder = $request->input('sort', 'asc'); // Orden ascendente por defecto

        // Filtrar y ordenar los departamentos
        $departamentos = Departamento::query() 
            ->when($search, function ($query) use ($search) { // Filtrar por nombre si se especifica la búsqueda
                $query->where('nombre_departamento', 'like', '%' . $search . '%');  // Filtrar por nombre
            })
            ->orderBy('nombre_departamento', $sortOrder) // Ordenar por nombre
            ->paginate(20);

        // Pasar los datos a la vista
        return view('departamentos.index', compact('departamentos', 'search', 'sortOrder'));
    }

    /**
     * Función para buscar departamentos por nombre.
     */
    public function searchByName(Request $request): View // Cambiamos el tipo de retorno a View
    {
        // Obtener el parámetro de búsqueda desde la solicitud
        $search = $request->input('search');

        // Filtrar los departamentos cuyo nombre coincida con la búsqueda
        $departamentos = Departamento::where('nombre_departamento', 'like', '%' . $search . '%')
            ->paginate(20);

        // Retornar la vista con los resultados de búsqueda
        return view('departamentos.index', compact('departamentos', 'search'));
    }


    /**
     * Muestra el formulario para crear un nuevo departamento.
     */
    public function create(): View
    {
        $departamento = new Departamento();
        return view('departamentos.create', compact('departamento'));
    }

    /**
     * Guarda un nuevo departamento en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_departamento' => 'required|string|max:60',
        ]);

        //testeo con json 
        $json = file_get_contents(storage_path('app/public/departamentos.json'));
        $data = json_decode($json, true);

        $nuevoDepartamento = [
            'id_departamento' => count($data) + 1,
            'nombre_departamento' => $request->input('nombre_departamento'),
        ];

        $data[] = $nuevoDepartamento;

        file_put_contents(storage_path('app/public/departamentos.json'), json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', value: 'Departamento agregado exitosamente.');

        /*
        Departamento::create($request->all());
        return redirect()->route('departamentos.index');
        */
    }

    /**
     * Muestra los detalles de un departamento específico.
     */
    public function show($id): View
    {
        // Buscamos un departamento por su ID.
        $departamento = Departamento::find($id);

        return view('departamentos.show', compact('departamento'));
    }

    /**
     * Muestra el formulario para editar un departamento existente.
     */
    public function edit($id): View
    {
        // Buscamos un departamento por su ID.
        $departamento = Departamento::find($id);

        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Actualiza un departamento en la base de datos.
     */
    public function update(Request $request, Departamento $departamento): RedirectResponse
    {
        $request->validate([
            'nombre_departamento' => 'required|string|max:60',
        ]);
        $departamento->update($request->all());

        return redirect()->route('departamentos.index');
    }

    /**
     * Elimina un departamento de la base de datos.
     */
    public function destroy($id): RedirectResponse
    {
        // Buscamos un departamento por su ID.
        $departamento = Departamento::find($id);
        $departamento->delete();

        return redirect()->route('departamentos.index');
    }

    //export a excel/pdf
    public function exportarAllDepartamentos_Excel()
    {
        return Excel::download(new DepartamentosExport, 'Departamentos.xlsx');
    }

    public function exportarAllDepartamentos_Pdf()
    {
        return Excel::download(new DepartamentosExport, 'Departamentos.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
