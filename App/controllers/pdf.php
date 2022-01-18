<?php

use App\core\Controller;
use Dompdf\Dompdf;

class Pdf extends Controller
{
    public function index()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // Pegar todos os dados de saida
        ob_start();
        require 'teste.php';
        $dompdf->loadHtml(ob_get_clean());

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        //$dompdf->stream(); // Desse jeito baixa automático

        // 1- Nome, 2- Não baixar, apenas exibir
        $dompdf->stream('Seila PDF', ['Attachment' => false]);

        $this->views('pdf/index');
    }
}