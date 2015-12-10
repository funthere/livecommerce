<?php

namespace App\Http\Controllers;

use View;
use Form;
use Datatables;
use Illuminate\Http\Request as Request;
use App\Http\Controllers\Controller;
use App\BaseModel as Model;

class BackendController extends Controller
{
    protected $model;
    protected $base;

    public function __construct(Model $model, $base = '')
    {
        $this->model = $model;    
        $this->base = $base;   
        $this->baseClass = '\\'.static::class;

        View::share('base', $base);
        View::share('fields', $model->getTitleOfFields());
        View::share('model', Model::class);
        View::share('baseClass', $this->baseClass);
    }
    public function listjson()
    {
        $datas = $this->model->select([null => 'id']+$this->model->getFillable());

        return Datatables::of($datas)
            ->addColumn('menu', function($data) {
                return 
                '<a href="'.action($this->baseClass.'@edit', ['id' => $data->id]).'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'action' => [$this->baseClass.'@show', $data->id]]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
            })
            ->make();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.{$this->base}.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->model;
        ${$this->base} = $model;
        return view("backend.{$this->base}.create", compact($this->base));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $created = $this->model->create($request->all());

        if ($created)
        {
            return redirect('admin/'.$this->base);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);

        ${$this->base} = $model;
        return view("backend.{$this->base}.edit", compact($this->base));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);

        $this->validate($request, $model->rules());

        $updated = $model->update($request->all());

        if ($updated)
        {
            return redirect('admin/'.$this->base);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);

        $deleted = $model->delete();
        return redirect('admin/'.$this->base);
    }
}
