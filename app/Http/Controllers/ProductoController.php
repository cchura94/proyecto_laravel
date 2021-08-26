<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Sucursal;

use PDF;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_sucursales = Sucursal::all();
        $lista_productos = Producto::all();
        return view('admin.producto.principal', compact('lista_productos', 'lista_sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required"
        ]);
          // subir imagen
          $nom_imagen = "";
          if($file = $request->file("imagen")){
              // nombre original del archivo
              $nom_imagen = $file->getClientOriginalName();
              $file->move("imagenes", $nom_imagen);
              $nom_imagen = "imagenes/" . $nom_imagen;            
          }
        
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $nom_imagen;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->save();

        return redirect()->back()->with("mensaje", "Producto registrado");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function adicionar_productos_sucursal(Request $request, $id)
    {
        $sucursal = Sucursal::find($request->sucursal_id);
        $sucursal->productos()->attach($id, ['stock' => $request->cantidad]);
        
        return redirect()->back()->with('mensaje', 'Producto asignado a la sucursal');
    }

    public function reporte()
    {
          
		PDF::SetFontSubsetting(false);
		PDF::SetFontSize('10px');
		PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		PDF::AddPage('P', 'LETTER');
		PDF::SetX(10);//inicio posicion del contenido
		PDF::SetY(35);//inicio posicion del contenido

		PDF::SetFont('courier', 'B', 10);
		PDF::Cell(0, 1,'SIS VENTAS',0,1,'C');	
		PDF::Cell(0, 2,'"*****"',0,1,'C');	
        PDF::SetFont('courier', 'B', 15);
        //PDF::SetTextColor(0,0,255);
        PDF::Cell(0, 15,'LISTA DE PRODUCTOS',0,1,'C');		
        	
        PDF::Line(50,54,165,54);
        PDF::SetDrawColor(0,0,255);	
        PDF::Line(6,30,210,30);
        PDF::Line(6,72,210,72);
                
        
        //PDF::Line(6,80,210,80);
            
        //PDF::Image('logo/logo.jpg',10,8,0,20, '', '', '', false, 300, '', false, false, 0);
        

	    PDF::SetFontSubsetting(false);
		PDF::SetFontSize('10px');
		PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		//PDF::AddPage('P', 'LETTER');
		PDF::SetX(10);//inicio posicion del contenido
		PDF::SetY(55);//inicio posicion del contenido
		//PDF::writeHTML($html, true, false, true, false, '');
		PDF::SetFont('courier', 'B', 12);
		//PDF::Cell(0, 5,'DATOS PERSONALES',0,1,'L');
        PDF::SetFont('courier', 'B', 10);
        PDF::SetTextColor(0,0,0);
		PDF::Cell(0, 10,'Gestion: ',0,1,'L');
		PDF::Cell(0, 5,'Fecha Actual: ',0,1,'L');
        
        PDF::SetXY(10, 80);
    $html='<table width="100%" border="1">
    <thead>
    <tr>
    <th width="25px"><b>N°</b></th>
    <th width="170px"><b>NOMBRE.</b></th>
    <th width="135px"><b>PRECIO</b></th>
    <th width="165px"><b>DESCRIPCION</b></th>
    </tr>
    </thead>
    <tbody>';

    $lista_productos = Producto::all();
    foreach($lista_productos as $prod){
            $html.='<tr>
            <td width="25px">'. $prod->id .'</td>
            <td width="170px">'. $prod->nombre .'</td>
            <td width="135px">'. $prod->precio .'</td>
            <td width="165px">'. $prod->descripcion .'</td>
            </tr>';
        }

    $html.='</tbody></table>';


    PDF::writeHTML($html, true, false, true, false, '');
    //PDF::writeHTML('<img src="/logo/logo.jpg">', 100,100,100,100);

	    //PDF::Cell(0, 5,'La Paz: ' ,0,1,'L');
		PDF::lastPage();
        //PDF::Output('my_file.pdf', 'D');
        
        PDF::setFooterCallback(function($pdf){

            PDF::Image('logo/logo.jpg',10,8,30,20);
            PDF::Image('logo/nombre.jpg',160,8,50,20);
			$pdf->SetY(-15);
			$pdf->SetFont('courier', 'I', 7);
		    /* establecemos el color del texto */
          	$pdf->SetTextColor(0,0,0);
            $pdf->SetX(10);
            $pdf->Cell(0, 10, ''.date('d-m-Y H:i:s').'',
                             0, false, 'L', 0, '', 0, false, 'T', 'M');

            $pdf->SetFont('courier', 'I', 10);
            $pdf->Cell(0, 10, 'Pag. '.$pdf->getAliasNumPage().
                             ' de '.
                             $pdf-> getAliasNbPages(),
                             0, false, 'R', 0, '', 0, false, 'T', 'M');

            $pdf->SetFont('courier', 'B', 6);
            $pdf->SetXY(10,262);
            //$pdf->Cell(0, 5, "[0, false, 'R', 0, '', 0, false, 'T', 'M');

            $pdf->SetDrawColor(0,0,255);
            /* dibujamos una linea roja delimitadora del pie de página */
          	$pdf->Line(10,266,205,266);

        });
        

		$style = array(
		    'border' => false,//borde 2
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);
		PDF::SetFont('courier', 'B', 10);
		PDF::Ln();
		//PDF::write2DBarcode(, 'QRCODE,H', 160, 55, 30, 30, $style, 'N');

		//PDF::Text(20, 205, 'Codigo de verificación');

		PDF::Output('Certificado_trabajo.pdf');
		//exit;

    }
}
