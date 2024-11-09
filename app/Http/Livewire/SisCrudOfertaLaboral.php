<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Empresa;
use Livewire\Component;
use App\Models\OfertaLaboral;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Http\Request;

class SisCrudOfertaLaboral extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $isOpen = false;
    public $ruteCreate = false;
    public $ofertaLaboralState, $ofertaLaboralCategory, $ofertaLaboralEmpresa;
    public  $amount = 5;
    public $search, $ofertaLaboral;
    public $images = [];
    public $documentoOferta;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'ofertaLaboral.titulo' => 'required',
        'ofertaLaboral.remuneracion' => 'required',
        'ofertaLaboral.ubicacion' => 'required',
        'ofertaLaboral.descripcion' => 'required',
        'ofertaLaboral.body' => 'required',
        'ofertaLaboral.fecha_inicio' => 'required',
        'ofertaLaboral.fecha_fin' => 'required',
        'ofertaLaboral.limite_postulante' => 'required',
        'documentoOferta' => 'nullable|file|mimes:pdf,doc,docx,txt|max:4048', // Validación del archivo
        'ofertaLaboral.state' => 'required',
        'ofertaLaboral.empresa_id' => 'required',
        // 'ofertaLaboral.category_id' => 'required',

    ];

    public function render()
    {

        $userId = Auth::id();
        $user = User::find($userId);

        // Obtener los roles del usuario
        $roles = $user->roles->pluck('name')->toArray();

        // Inicializar la consulta de aplicaciones
        $query = OfertaLaboral::query();

        $query = OfertaLaboral::with('aplication'); // Cargar la relación 'aplication'
        // Aplicar condiciones según los roles del usuario
        if (in_array('Administrador', $roles)) {
            // Si el usuario tiene el rol Administrador, mostrar todos los registros
            $query->where(function ($q) {
                $q->where('titulo', 'like', '%' . $this->search . '%')
                    ->when($this->ofertaLaboralState, fn($query) => $query->where('state', $this->ofertaLaboralState))
                    ->when($this->ofertaLaboralEmpresa, fn($query) => $query->where('empresa_id', $this->ofertaLaboralEmpresa))
                    ->when($this->ofertaLaboralCategory, fn($query) => $query->where('category_id', $this->ofertaLaboralCategory));
            });
        } elseif (in_array('Empresa', $roles)) {

            $query->where('user_id', $userId);
        }

        // Aplicar búsqueda
        $query->where(function ($q) {
            $q->where('titulo', 'like', '%' . $this->search . '%')
                ->when($this->ofertaLaboralState, fn($query) => $query->where('state', $this->ofertaLaboralState))
                ->when($this->ofertaLaboralEmpresa, fn($query) => $query->where('empresa_id', $this->ofertaLaboralEmpresa))
                ->when($this->ofertaLaboralCategory, fn($query) => $query->where('category_id', $this->ofertaLaboralCategory));
        });

        //    $empresas = Empresa::all();
        // Obtener las empresas según el tipo de usuario
        if (in_array('Empresa', $roles)) {
            $empresas = Empresa::where('user_id', $userId)->get();
        } else {
            $empresas = Empresa::all();
        }

        $this->ofertaLaboral['user_id'] = auth()->user()->id;
        $ofertaLaborals = $query->latest('id')->paginate($this->amount);


        // Ahora puedes acceder a las aplicaciones de cada oferta laboral
        foreach ($ofertaLaborals as $ofertaLaboral) {
            $aplicaciones = $ofertaLaboral->aplication; // Acceder a las aplicaciones de cada oferta laboral
            // Hacer algo con las aplicaciones, por ejemplo, contarlas
            $cantidadAplicaciones = $aplicaciones->count();
        }
        return view('admin.pages.table-oferta-laboral', compact('ofertaLaborals', 'empresas'));
    }


    public function show($id)
    {
        $ofertaLaboraldetail = OfertaLaboral::findOrFail($id);

        $details = $ofertaLaboraldetail->aplication()->paginate(6);
        $cantidadAplicaciones = $details->count();
        return view('admin.pages.show-oferta-laboral', compact('ofertaLaboraldetail', 'details'));
    }

    public function create()
    {

        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset('ofertaLaboral');
        // $this->resetValidation();
    }


    public function store()
    {
        $this->validate();

        // Crear el directorio si no existe
        if (!Storage::disk('public')->exists('documentos_oferta')) {
            Storage::disk('public')->makeDirectory('documentos_oferta');
        }

        // Comprobar si se subió un nuevo documento
        if ($this->documentoOferta) {
            // Si la oferta laboral ya tiene un documento, eliminar el archivo anterior
            if (isset($this->ofertaLaboral['documentos_oferta']) && Storage::disk('public')->exists($this->ofertaLaboral['documentos_oferta'])) {
                Storage::disk('public')->delete($this->ofertaLaboral['documentos_oferta']);
            }
            // Guardar el nuevo archivo
            $documentosPath = $this->documentoOferta->store('documentos_oferta', 'public');
            $this->ofertaLaboral['documentos_oferta'] = $documentosPath;
        }

        if (!isset($this->ofertaLaboral['id'])) {
            OfertaLaboral::create($this->ofertaLaboral);
            $this->emit('alert', 'Registro creado satisfactoriamente');
        } else {
            $ofertaLaboral = OfertaLaboral::find($this->ofertaLaboral['id']);
            $ofertaLaboral->update($this->ofertaLaboral);
            $this->emit('alert', 'Registro actualizado satisfactoriamente');
        }

        $this->reset(['isOpen', 'ofertaLaboral', 'documentoOferta']);
        $this->emitTo('ofertaLaborals', 'render');
    }

    public function edit($ofertaLaboral)
    {

        $this->ofertaLaboral = $ofertaLaboral;
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function destroy(string $id)
    {
        try {
            $ofertaLaborals = OfertaLaboral::findOrFail($id);

            // Verificar si la oferta tiene un documento asociado y eliminar el archivo si existe
            if ($ofertaLaborals->documentos_oferta && Storage::disk('public')->exists($ofertaLaborals->documentos_oferta)) {
                Storage::disk('public')->delete($ofertaLaborals->documentos_oferta);
            }
            $ofertaLaborals->delete();

            return redirect()
                ->back()
                ->with('success', '¡item eliminado !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo eliminar el item de la lista ');
        }
    }


    public function createPDF()
    {
        $total = OfertaLaboral::count();

        $date = date('Y-m-d');
        $hour = date('H:i:s');
        $ofertaLaborals = OfertaLaboral::all();
        $pdf = FacadePdf::loadView('reports/pdf_oferta_laboral', compact('ofertaLaborals', 'total', 'date', 'hour'));
        $pdf->setPaper('a4', 'landscape');
        //return $pdf->download('pdf_file.pdf');    //desacarga automaticamente
        return $pdf->stream('reports/pdf_oferta_laboral'); //abre en una pestaña como pdf
    }

    public function createCSV()
    {

        $data = DB::table('oferta_laborals')->select('id', 'titulo', 'ubicacion', 'remuneracion', 'descripcion', 'body', 'fecha_inicio', 'fecha_fin', 'limite_postulante', 'empresa_id', 'created_at', 'updated_at')->get();


        $filename = 'reporte_oferta_laboral.csv';
        $filePath = storage_path('app/' . $filename);

        $file = fopen($filePath, 'w');
        fputcsv($file, ['ID', 'TITULO', 'UBICACION', 'REMUNERACION', 'DESCRIPCION', 'CUERPO', 'FECHA DE INICIO', 'FECHA FIN', 'LIMITE POSTULANTES', 'EMPRESA', 'Creacion', 'Actualizado']);
        foreach ($data as $item) {
            fputcsv($file, [$item->id, $item->titulo, $item->ubicacion, $item->remuneracion, $item->descripcion, $item->body, $item->fecha_inicio, $item->fecha_fin, $item->limite_postulante, $item->empresa_id, $item->created_at, $item->updated_at]);
        }

        fclose($file);
        return response()->download($filePath, $filename)->deleteFileAfterSend();
    }

    public function createEXCEL()
    {

        $data = DB::table('oferta_laborals')->select('id', 'titulo', 'ubicacion', 'remuneracion', 'descripcion', 'body', 'fecha_inicio', 'fecha_fin', 'limite_postulante', 'empresa_id', 'created_at', 'updated_at')->get()->toArray();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $encabezados =  ['ID', 'TITULO', 'UBICACION', 'REMUNERACION', 'DESCRIPCION', 'CUERPO', 'FECHA DE INICIO', 'FECHA FIN', 'LIMITE POSTULANTES', 'EMPRESA', 'Creacion', 'Actualizado'];
        foreach ($encabezados as $key => $encabezado) {
            $columna = chr(65 + $key); // Convertir el índice en letra de columna (A, B, C, ...)
            $celda = $columna . '1'; // Construir la referencia de celda (por ejemplo, A1, B1, C1, ...)
            $sheet->setCellValue($celda, $encabezado); // Establecer el valor del encabezado
        }

        // Aplicar estilo al encabezado
        $headerStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF426EBE',
                ],
            ],
            'font' => [
                'color' => [
                    'argb' => Color::COLOR_WHITE,
                ],
                'bold' => true, // Hacer que el texto esté en negrita
            ],
        ];

        // Aplicar el estilo al encabezado
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Aplicar formato y color a los datos
        $dataStyle1 = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFE6E6FA', // Celeste
                ],
            ],
        ];

        $dataStyle2 = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => Color::COLOR_WHITE,
                ],
            ],
        ];

        $row = 2;
        foreach ($data as $ofertaLaboral) {
            $style = ($row % 2 == 0) ? $dataStyle1 : $dataStyle2;
            $sheet->fromArray((array)$ofertaLaboral, null, 'A' . $row); // Escribir los datos en la fila actual
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($style); // Aplicar el estilo a la fila actual
            $row++;
        }

        // Ajustar el ancho de las columnas automáticamente
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Crear un objeto Writer y guardar el archivo
        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_oferta_laboral.xlsx';
        $filePath = storage_path('app/' . $filename);
        $writer->save($filePath);

        // Devolver el archivo como respuesta
        return response()->download($filePath, $filename)->deleteFileAfterSend();
    }
}
