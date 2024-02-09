<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Color;
use App\Model\Size;
use App\Model\Attribute;
use App\Model\PrintDetails;

class AttributeController extends Controller
{
    public function __construct(Attribute $attributes, PrintDetails $print_details) {
		$this->attribute = $attributes;
		$this->print_detail = $print_details;
	}

    public function index()
    {
        $attribute = $this->attribute->getAttributeList();
        return view('attribute/index', compact('attribute'));
    }
    
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('attribute.create', compact('colors','sizes'));
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate([
            'color_id' => 'required',
            'size_id' => 'required'
        ]);
        try {
            $attribute = $this->attribute->checkDuplicate($fields['color_id'], $fields['size_id']);
            if ($attribute) {
                return redirect()->back()->with('error', 'Duplicate attribute.!');
            }
            Attribute::create($request->all());
        } catch (Exception $a) {
            return $a->getMessage();  
        }
        return redirect()->route('attribute.index')->with('success', 'Attribute created successfully.!');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $edit = Attribute::find($id);
        $colors = Color::all();
        $sizes = Size::all();
        return view('attribute.edit', compact('colors','sizes', 'edit'));
    }
    
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'color_id' => 'required',
            'size_id' => 'required'
        ]);
        try {
            $attribute = $this->attribute->checkDuplicate($fields['color_id'], $fields['size_id'], $id, 1);
            if ($attribute) {
                return redirect()->back()->with('error', 'Duplicate attribute.!');
            }
            $update = Attribute::find($id);
            $update->update($request->all());
        } catch (Exception $a) {
            return $a->getMessage();  
        }
        return redirect()->route('attribute.index')->with('success', 'Attribute updated successfully.');
    }
    
    public function destroy($id)
    {
        try {
            $delete = Attribute::find($id);
            $attribute = $this->print_detail->checkPrintDetail(2, $id);
            if ($attribute) {
                return redirect()->route('attribute.index')->with('error', 'Sorry. There are other relations.!');
            }
            $delete->delete();
        } catch (Exception $a) {
            return $a->getMessage();  
        }
        return redirect()->route('attribute.index')->with('success', 'Attribute deleted successfully');
    }
}
