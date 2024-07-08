<?php

namespace AppBundle\Service;

use Spipu\Html2Pdf\Html2Pdf as H2pdf;

class HTML2PDF{

    private $pdf;

    public function create($orientation=null, $format = null, $lang=null, $unicode=null, $encoding=null, $margin=null, $pdfa = null){

        $this->pdf = new H2pdf(
            $orientation ? $orientation:$this->_orientation,
            $format ? $format:$this->_format,
            $lang ? $lang:$this->_langue
           
        );
    }

    public function generatePdf($template,$name){
        $this->pdf->writeHTML($template);
        return $this->pdf->Output($name.'.pdf');


    }


}