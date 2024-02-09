<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Code;

class CodeController extends Controller
{
    public function __construct(Code $codes) {
		$this->code = $codes;
	}

    public function index()
    {
        $code = $this->code->getCodeList(1);
        return view('code/index', compact('code'));
    }
    
    public function create()
    {
        return view('code.create');
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $code = $this->code->getCodeList(2, $fields['name']);
            if ($code) {
                return redirect()->back()->with('error', 'Duplicate code.!');
            }
            Code::create($request->all());
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('code.index')->with('success', 'Code created successfully.!');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $edit = Code::find($id);
        return view('code.edit', compact('edit'));
    }
    
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required'
        ]);
        try {
            $code = $this->code->getCodeList(3, $fields['name'], $id);
            if ($code) {
                return redirect()->back()->with('error', 'Duplicate code.!');
            }
            $update = Code::find($id);
            $update->update($request->all());
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('code.index')->with('success', 'Code updated successfully.');
    }
    
    public function destroy($id)
    {
        try {
            $delete = Code::find($id);
            $code = $this->print_detail->checkPrintDetail(1, $id);
            if ($code) {
                return redirect()->route('code.index')->with('error', 'Sorry. There are other relations.!');
            }
            $delete->delete();
        } catch (Exception $c) {
            return $c->getMessage();  
        }
        return redirect()->route('code.index')->with('success', 'Code deleted successfully');
    }
}
