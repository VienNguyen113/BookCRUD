<?php

namespace VienNguyen113\BookCRUD\Controllers;

use Illuminate\Http\Request;
use VienNguyen113\BookCRUD\Requests\CreateBookRequest;
use VienNguyen113\BookCRUD\Requests\EditBookRequest;
use VienNguyen113\BookCRUD\Services\BookServiceContract;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
	protected $service;

	public function __construct(BookServiceContract $service)
	{
		$this->service = $service;
	}

	public function index()
	{
		$items = $this->service->paginate();
		return view('BookCRUD::books.index', compact('items'));
	}

	public function create()
	{
		return view('BookCRUD::books.create');
	}

    public function store(CreateBookRequest $request) 
    {
    	$this->service->store($request->all());
    	return redirect()->route('books.index');
    }

    public function show($id)
    {
        $item = $this->service->find($id);
        return view('BookCRUD::books.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->service->find($id);
        return view('BookCRUD::books.edit', compact('item'));
    }

    public function update(EditBookRequest $request, $id)
    {
        $this->service->update($id, $request->all());
        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('books.index');
    }
}
