<?php

namespace Sgi\Base;

use PDF;

class BasePDF
{
	public function generateInform($data, $vista)
	{
        $data['titulo'] = $vista;//.$data['formatos']->nombre;        
        $pdf = PDF::loadView($vista, $data);
        $pdf->setPaper('Letter','Landscape');
        return $pdf->stream($data['titulo'].'.pdf'); 		
	}

    public function generatePrint($data)
    {
        $pdf = PDF::loadView($data['formatos']->controlador.'/imprimir', $data);
        return $pdf->stream($data['formatos']->controlador.'.pdf');         
    }    
}