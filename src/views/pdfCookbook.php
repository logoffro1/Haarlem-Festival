<?php
    require_once ('../../tcpdf/tcpdf.php');
    $pdf = new TCPDF('p','mm','A4');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();

    
    $pdf->Cell(190,20,"The Haarlem Festival Cookbook",1,1,'C');
    $pdf->Cell(190,10,"Coming soon...",1,1,'C');
    $pdf->Output();

?>