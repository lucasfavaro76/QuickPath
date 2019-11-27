<?php

namespace app\view\dashboard;

use app\dao\PessoaJuridicaDao;
use app\dao\VendasDao;
use ArrayObject;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use TCPDF;

final class DashboardView extends HtmlPage
{

    protected $vendas;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/dashboard/dashboard_view.phtml';
        $this->showVendas();
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function renderFooter()
    {
        require_once('core\mvc\view\footer.phtml');
    }

    public function show()
    {
        $this->renderHeader();
        require_once($this->htmlFile);
        $this->renderFooter();
    }

    public function showVendas()
    {
        $rest = new VendasDao($this->connection);
        $result = $rest->select();
        $this->setVendas($result);
    }

    public function pdf()
    {
        /**
         * Creates an example PDF TEST document using TCPDF
         * @package com.tecnick.tcpdf
         * @abstract TCPDF - Example: Default Header and Footer
         * @author Nicola Asuni
         * @since 2008-03-04
         */

        // Include the main TCPDF library (search for installation path).
        require_once('core/vendor/TCPDF-6.3.2/tcpdf.php');

        // create new PDF document
        $pdf = new TCPDF('l', PDF_UNIT, 'A3', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('');
        $pdf->SetTitle('Resumo das Vendas');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'VENDAS');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(20, PDF_MARGIN_TOP, 17);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 12);

        // add a page
        $pdf->AddPage();

        // column titles
        $header = array('ID', 'NOME', 'EMAIL', 'CPF', 'TOTAL', 'DATA', 'HORA', 'TIPO', 'PRODUTO', 'UNITARIO', 'QUANTIDADE');

        // data loading
        $data = $this->LoadData($this->vendas);

        // print colored table

        // Colors, line width and bold font
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(0.5);
        $pdf->SetFont('', 'B');
        // Header
        $w = array(10, 35, 70, 35, 30, 25, 25, 44, 40, 35, 35);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $pdf->Cell($w[0], 6, $row[0], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $row[8], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, $row[10], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 6, $row[9], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, $row[1], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, $row[2], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[6], 6, $row[3], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[7], 6, $row[4], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[8], 6, $row[5], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[9], 6, $row[6], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[10], 6, $row[7], 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');

        // ---------------------------------------------------------

        // close and output PDF document
        $pdf->Output('example_011.pdf', 'I');    
    }

    public function LoadData($vendas)
    {
        // Read file lines
        $lines = $vendas;
        $data = new \ArrayObject();
        foreach ($lines as $line) {
            $data->append($line);
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header, $data)
    { }



    /**
     * Get the value of msg
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get the value of vendas
     */
    public function getVendas()
    {
        return $this->vendas;
    }

    /**
     * Set the value of vendas
     *
     * @return  self
     */
    public function setVendas($vendas)
    {
        $this->vendas = $vendas;

        return $this;
    }
}
