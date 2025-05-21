<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/user_int/FPDF/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

class PDF extends FPDF {
    function __construct() {
        parent::__construct();
        // Add Arial font (ensure font files are in fpdf/font)
        $this->AddFont('Arial', '', 'arialmt.php');
        $this->SetFont('Arial', '', 12);
    }

    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Technological Process', 0, 1, 'C');
        $this->Ln(10);
    }

    // Add process step
    public function addStep($number, $device, $component, $nominal, $operator) {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, "Step $number", 0, 1);
        
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Device: $device", 0, 1);
        $this->Cell(0, 10, "Component: $component", 0, 1);
        $this->Cell(0, 10, "Nominal: $nominal", 0, 1);
        $this->Cell(0, 10, "Operator: $operator", 0, 1);
        
        $this->Ln(8);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(12);
    }
}

try {
    $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
    $tp_id = $_POST['tp_id'] ?? null;

    // Fetch data
    $stmt = oci_parse($conn, 
        "SELECT t.tp_name, 
                d.device_name, 
                c.comp_name, 
                c.comp_value, 
                u.us_firstname||' '||u.us_secondname as operator
         FROM technology t
         JOIN device d ON t.tp_device_id = d.device_id
         JOIN job j ON j.job_tech_id = t.tp_id
         JOIN comp c ON j.job_comp_id = c.comp_id
         JOIN users u ON j.job_us_id = u.us_id
         WHERE t.tp_id = :tp_id
         ORDER BY j.job_id");

    oci_bind_by_name($stmt, ':tp_id', $tp_id);
    oci_execute($stmt);

    $pdf = new PDF();
    $pdf->AddPage();

    // Add steps
    $step = 1;
    while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $pdf->addStep(
            $step,
            $row['DEVICE_NAME'],
            $row['COMP_NAME'],
            $row['COMP_VALUE'],
            $row['OPERATOR']
        );
        $step++;
    }

    $pdf->Output("tech_process_$tp_id.pdf", 'I');

} catch (Exception $e) {
    die("Export Error: " . $e->getMessage());
}