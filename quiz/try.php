
<?php
# PHPlot Example: Using 'data:' URL scheme to embed an image
# Unlike other examples, this outputs a complete HTML page with embedded image.
require_once 'phplot.php';

# Generate data for: Y1 = sin(x), Y2 = cos(x)

$data=array();
for ($x = 0; $x <= 10; $x += 1)
  $data[$x] = array('', $x, sin($x));


$plot = new PHPlot(800, 600);
$plot->SetFailureImage(False); // No error images
$plot->SetPrintImage(False); // No automatic output
$plot->SetImageBorderType('plain');
$plot->SetPlotType('lines');
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetTitle('Line Plot, Sin and Cos - Embedded Image');
//$plot->SetLegend(array('sin(t)', 'cos(t)'));
$plot->SetPlotAreaWorld(0, -1, 6.8, 1);
$plot->SetXDataLabelPos('none');
//$plot->SetXTickIncrement(M_PI / 8.0);
$plot->SetXLabelType('data');
$plot->SetPrecisionX(3);
$plot->SetYTickIncrement(0.2);
$plot->SetYLabelType('data');
$plot->SetPrecisionY(1);
$plot->SetDrawXGrid(True);
$plot->SetDrawYGrid(True);
$plot->DrawGraph();

?>
<html>
<head>
<title>PHPlot Example - Inline Image</title>
</head>
<body>
<h1>PHPlot Example - Inline Image</h1>
<p>This is a plot of sin() and cos().</p>
<img src="<?php echo $plot->EncodeImage();?>" alt="Plot Image">
</body>
</html>


