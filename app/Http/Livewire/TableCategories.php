<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class TableCategories extends Component
{
    use WithFileUploads;
    use WithPagination;


    public $isOpen = false;
    public $ruteCreate = false;
    public $amount = 5;
    public $search,$category,$image;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'category.name' => 'required',
        'category.slug' => 'required',
        'category.state' => 'required',
    ];

    public function render()
    {
        $this->category['user_id'] = auth()->user()->id;

        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate($this->amount);
        return view('admin.pages.table-categories', compact('categories'));
    }

    public function create(){
        $this->isOpen=true;
        $this->ruteCreate=true;
        $this->reset('category', 'image');
        $this->resetValidation();
    }


    public function store(){
        $this->validate();
        if(!isset($this->category['id'])){
            $category = Category::create($this->category);
            if ($this->image) {
                $image=Storage::disk('public')->put('galery',$this->image);
                $category->image()->create([
                    'url'=>$image
                ]);
            }
            $this->emit('alert','Registro creado satisfactoriamente');
        }else{
            $category = Category::find($this->category['id']);
            $category->update(Arr::except($this->category, 'image'));
            if($this->image){
                $image=Storage::disk('public')->put('galery',$this->image);
                if($category->image){
                    Storage::disk('public')->delete('galery', $category->image->url);
                    $category->image()->update([
                        'url'=>$image
                    ]);
                }else{
                    $category->image()->create([
                        'url'=>$image
                    ]);
                };
            };
            $this->emit('alert','Registro actualizado satisfactoriamente');
        }
        $this->reset(['isOpen','category','image']);
        $this->emitTo('SisCrudCategory','render');
    }

    public function edit($category){
        $this->reset('image');
        $this->category=array_slice($category,0,9);
        $this->isOpen=true;
        $this->ruteCreate=false;
        //dd($this->category); // imprimirá el contenido del arreglo $product en la página
    }

    public function updatedcategoryName(){
        $this->category['slug']=Str::slug($this->category['name']);
    }

    public function delete($id){
        Category::find($id)->delete();
    }

    public function createPDF() {
        $total = Category::count();
        $user = auth()->user()->name;
        $date = date('Y-m-d');
        $hour = date('H:i:s');
        $categories = Category::all();
        $pdf = FacadePdf::loadView('reports/pdf_categories',compact('categories','total','user','date','hour'));
        $pdf->setPaper('a4');
        //return $pdf->download('pdf_file.pdf');    //desacarga automaticamente
        return $pdf->stream('reports/pdf_categories'); //abre en una pestaña como pdf
    }

    public function createCSV(){
        // Obtener los datos de los productos desde la base de datos
        $data = DB::table('categories')->select('id', 'name', 'slug', 'created_at', 'updated_at')->get();

        // Crear un archivo CSV
        $filename = 'categorias.csv';
        $filePath = storage_path('app/' . $filename);

        $file = fopen($filePath, 'w');

        // Escribir los encabezados de las columnas
        fputcsv($file, ['ID', 'Nombre', 'Slug', 'Creacion', 'Actualizado']);

        // Escribir los datos de los productos
        foreach ($data as $category) {
            fputcsv($file, [$category->id, $category->name, $category->slug, $category->created_at, $category->updated_at]);
        }

        fclose($file);

        // Devolver el archivo como respuesta
        return response()->download($filePath, $filename)->deleteFileAfterSend();
    }
}
