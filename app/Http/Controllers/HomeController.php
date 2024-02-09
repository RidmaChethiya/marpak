<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Model\PageSize;
use App\Model\PageOrientation;
use App\Model\Code;
use App\Model\Attribute;
use App\Model\Prints;
use App\Model\PrintDetails;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Prints $prints) {
        $this->middleware('auth');
		$this->print = $prints;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page_sizes = PageSize::all();
        $page_orientations = PageOrientation::all();
        $codes = Code::all();
        $attributes = Attribute::all();
        return view('home', compact('page_sizes','page_orientations','codes','attributes'));
    }

    public function generatePdf(Request $request)
    {
        $fields = $request->validate([
            'page_size_id' => 'required',
            'label_width' => 'required',
            'label_height' => 'required',
            'page_orientation_id' => 'required',
            'label_date' => 'required',
            'label_start_id' => 'required',
            'label_end_id' => 'required'
        ]);
        
        $check = $this->print->checkDuplicate($fields['label_date'], $fields['label_start_id'], $fields['label_end_id']);
        if (!$check->isEmpty()) {
            return redirect()->back()->with('error', 'Some product labels already printed for selected date. Check again.!');
        }

        $print_id = Prints::create($request->all());
        $codes = Code::all();
        $attributes = Attribute::all();
        $start_code = Code::find($fields['label_start_id'])->name;
        $end_code = Code::find($fields['label_end_id'])->name;
        $is_code = 0;

        foreach ($codes as $c) {
            if ($c->name == $start_code || $is_code > 0) {
                $is_code = 1;
                if ($c->name == $end_code) {
                    $is_code = 0;
                }
                foreach ($attributes as $a) {
                    $tt= PrintDetails::create([
                        'print_id' => $print_id->id,
                        'code_id' => $c->id,
                        'attribute_id' => $a->id
                    ]);
                }
            }
        }

        $for_pdf = $this->print->getPdfDetails($print_id->id);
        $page_size = PageSize::find($request->page_size_id)->name;
        $page_orientation = PageOrientation::find($request->page_orientation_id)->name;
        $pdf = Pdf::loadView('pdf', compact('for_pdf'))->setPaper($page_size, $page_orientation);
        return $pdf->stream();
    }
}
