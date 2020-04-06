<?php
//Yii::import('application.extensions.tcpdf.*');
require_once (dirname(__FILE__).'/tcpdf/tcpdf.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    protected $lung_consegna = array(15, 70, 50, 95, 37, 10); // tot: 277

    protected $headerColor = [36,125,212];
    protected $drawColor = [0,125,212];

    protected function getLength($type){
        switch ($type){

            default:
                $this->lung = $this->lung_consegna;
                break;
        }
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        //$text = CHtml::encode(Yii::app()->name).' '.CHtml::encode(Yii::app()->params['versione']).' - '. Yii::app()->params['adminName'];
        $text = 'I dati sono stati raccolti in rispetto del Regolamento europeo in materia di protezione dei dati personali e dal Codice privacy - d.lgs. 196/2003';
        $this->Cell(0, 10, $text, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Colored table
	public function ColoredTable($header,$data, $type = null) {

        // imposto la lunghezza dell'array
        self::getLength($type);
        // imposto l'header
        self::setmyHeader($header);

		// Data
		$fill = 0;
		foreach($data as $row) {
            $y = $this->GetY();
            if (($y + $this->h) >= 380) {
                $this->Cell(array_sum($this->lung), 0, '', 'T');
                self::setmyHeader($header);
            }
            // Color and font restoration
    		$this->SetFillColor(224, 235, 255);
    		$this->SetTextColor(0);
    		$this->SetFont('','',10);

			$this->Cell($this->lung[0], 4, $row[0], 'LR', 0, 'C', $fill);
			$this->Cell($this->lung[1], 4, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($this->lung[2], 4, $row[2], 'LR', 0, 'L', $fill);
			$this->Cell($this->lung[3], 4, $row[3], 'LR', 0, 'L', $fill);
      $this->Cell($this->lung[4], 4, $row[4], 'LR', 0, 'L', $fill);
      $this->Cell($this->lung[5], 4, $row[5], 'LR', 0, 'C', $fill);

      // NOTE
      $this->Ln();
      $this->Cell($this->lung[0], 4, ' ', 'LR', 0, 'L', $fill);
      $this->Cell(262, 4, 'Note: '.$row[6], 'LR', 0, 'L', $fill);

			$this->Ln();
			$fill=!$fill;

		}
		$this->Cell(array_sum($this->lung), 0, '', 'T');

	}

    protected function setmyHeader($header){
        $this->AddPage();
        $this->SetTextColor(80,80,80);
		$this->SetFont('dejavusans', '', 13);
    $this->writeHTML('<h2>'.$header['title'].'</h2>', true, false, true, false, '');

        // Colors, line width and bold font
		$this->SetFillColor($this->headerColor[0],$this->headerColor[1],$this->headerColor[2]);
		$this->SetTextColor(255);
		$this->SetDrawColor($this->drawColor[0],$this->drawColor[1],$this->drawColor[2]);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B',11);

        $num_headers = count($header['head']);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($this->lung[$i], 6, $header['head'][$i], 1, 0, 'L', 1);
		}
		$this->Ln();

    }
}
?>
