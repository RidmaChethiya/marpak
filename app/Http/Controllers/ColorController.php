<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Color;
use App\Model\Attribute;

class ColorController extends Controller
{
    public function __construct(Color $colors, Attribute $attributes) {
		$this->color = $colors;
		$this->attribute = $attributes;
	}

    public function index()
    {
        $color = $this->color->getColorList(1);
        return view('color/index', compact('color'));
    }
    
    public function create()
    {
        return view('color.create');
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $color = $this->color->getColorList(2, $fields['name']);
            if ($color) {
                return redirect()->back()->with('error', 'Duplicate color.!');
            }
            Color::create($request->all());
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('color.index')->with('success', 'Color created successfully.!');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $edit = Color::find($id);
        return view('color.edit', compact('edit'));
    }
    
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $color = $this->color->getColorList(3, $fields['name'], $id);
            if ($color) {
                return redirect()->back()->with('error', 'Duplicate color.!');
            }
            $update = Color::find($id);
            $update->update($request->all());
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('color.index')->with('success', 'Color updated successfully.');
    }
    
    public function destroy($id)
    {
        try {
            $delete = Color::find($id);
            $attribute_color = $this->attribute->checkAttribute(1, $delete->id);
            if ($attribute_color) {
                return redirect()->route('color.index')->with('error', 'Sorry. There are other relations.!');
            }
            $delete->delete();
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('color.index')->with('success', 'Color deleted successfully');
    }
}
