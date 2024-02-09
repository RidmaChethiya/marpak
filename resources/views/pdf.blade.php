<html>
    <body>
        <div class="row">
            @foreach($for_pdf as $pdf)
                <label style="border-style: solid; display: inline-block; width: {{$pdf->label_width}}px; height: {{$pdf->label_height}}px; margin-top: -1px; margin-bottom: -1px; margin-right: -1px; margin-left: -1px;text-align: center;"><br>
                    {{$pdf->code_name}}<br>
                    {{$pdf->label_date}}<br>
                    Color: {{$pdf->color_name}}<br>
                    Size: {{$pdf->size_name}}<br>
                </label>
            @endforeach
        </div>
    </body>
</html>