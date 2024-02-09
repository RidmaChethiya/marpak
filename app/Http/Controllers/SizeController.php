<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Size;
use App\Model\Attribute;

class SizeController extends Controller
{
    public function __construct(Size $sizes, Attribute $attributes) {
		$this->size = $sizes;
		$this->attribute = $attributes;
	}

    public function index()
    {
        $size = $this->size->getSizeList(1);
        return view('size/index', compact('size'));
    }
    
    public function create()
    {
        return view('size.create');
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $size = $this->size->getSizeList(2, $fields['name']);
            if ($size) {
                return redirect()->back()->with('error', 'Duplicate size.!');
            }
            Size::create($request->all());
        } catch (Exception $s) {
            return $s->getMessage();  
        }
        return redirect()->route('size.index')->with('success', 'Size created successfully.!');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $edit = Size::find($id);
        return view('size.edit', compact('edit'));
    }
    
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $size = $this->size->getSizeList(3, $fields['name'], $id);
            if ($size) {
                return redirect()->back()->with('error', 'Duplicate size.!');
            }
            $update = Size::find($id);
            $update->update($request->all());
        } catch (Exception $s) {
            return $s->getMessage();  
        }
        return redirect()->route('size.index')->with('success', 'Size updated successfully.');
    }
    
    public function destroy($id)
    {
        try {
            $delete = Size::find($id);
            $attribute_size = $this->attribute->checkAttribute(2, $delete->id);
            if ($attribute_size) {
                return redirect()->route('size.index')->with('error', 'Sorry. There are other relations.!');
            }
            $delete->delete();
        } catch (Exception $s) {
            return $s->getMessage();  
        }
        return redirect()->route('size.index')->with('success', 'Size deleted successfully');
    }
}
