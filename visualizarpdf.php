<?php
    $html = '';

    $pdf_name = $_POST['pdf_name'];

    $html .= '<object class="pdf" data="pdf/'. $pdf_name.'" type="application/pdf">
                <p>Parece que tu navegador no soporta PDF</p>
                <a href="pdf/CV-LOPEZ SAAVEDRA DAVID ANGEL.pdf" download="PDF-DNI.pdf">Descargar PDF</a>
            </object>';
    echo $html;

?>