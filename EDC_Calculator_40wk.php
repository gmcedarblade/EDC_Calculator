<?php

session_start();

?>
<!--EDC Calculator template-->
<!DOCTYPE html>
<html>
<head>
    <title>EDC Calculator</title>
    <meta charset="utf-8">
    <style>
        #lmpEnterArea {
            border:2px solid black;
            text-align: left;
        }
        #day, #month, #year  {
            width: 8%;
        }

        #submit {
            min-width: 10%;
        }

        #btnBegin {
            background: #fafafa;
            box-shadow: none;
            border-radius: 0;
            border-color: #dad6d3;
            border-width: 1px 0 0 0;
            color: #000;
            display:block;
            font-family: Helvetica Neue, Helvetica , Arial, sans-serif;
            font-size: 24px;
            font-weight: 200;
            margin: 0;
            position: absolute;
            bottom: -16px;
            right: -9px;
            text-align: right;
            width: 2000px;
            height: 60px;
        }

        .continueArrow {
            color: #106e9d;
            font-weight: bold;
        }

    </style>
    <link href="https://www.wisc-online.com/ARISE_Files/CSS/AriseMainCSS.css?random=wer" rel="stylesheet">
    <!-- CSS for AutoComplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- CSS for Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<body>
<table id="patientInfoTable">
    <tr>
        <th>Patient Name</th>
        <th>DOB</th>
        <th>MR#</th>
    </tr>
    <tr>
        <td><span id="ptntNameOutput"></span></td>
        <td><span id="ptntDOBOutput"></span></td>
        <td><span id="ptntMROutput"></span></td>
    </tr>
    <tr>
        <th>Gestational Age</th>
        <th>Blood Type</th>
        <th>EDC</th>
    </tr>
    <tr>
        <td><span id="ptntGestAgeOutput"></span></td>
        <td><span id="ptntBloodTypeOutput"></span></td>
        <td><span id="ptntEDCOutput"></span></td>
    </tr>
    <tr>
        <th>Allergies</th>
        <th>Height(cm)</th>
        <th>Usual Weight(kg)</th>
    </tr>
    <tr>
        <td><span id="ptntAllergyOutput"></span></td>
        <td><span id="ptntHeightOutput"></span></td>
        <td><span id="ptntWeightOutput"></span></td>
    </tr>
</table>
<br>
<br>
<div class="lmpEnterArea" id="lmpEnterArea">
    <form style="padding: 10px;" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="get">
        <label>Enter the LMP:</label>
        <label>Month (MM)</label>
        <input type="number" id="month" name="month" required="required">
        <label>Day (DD)</label>
        <input type="number" id="day" name="day" required="required">
        <label>Year (YYYY)</label>
        <input type="number" id="year" name="year" required="required">
        <button class="submit" id="submit" type="submit" name="submit" style="float: inherit;">Submit</button>
    </form>
</div>
<br>
<br>
<div class="edcCalculator">
    <?php

    $currentYear = date('Y');

    $yearCap = $currentYear + 19;

    $beforeYear = $currentYear + 20;

    if (isset($_GET['submit'])) {

        unset($_SESSION['lmpDate']);
        unset($_SESSION['edcResults']);

        $lmpDay = $_GET['day'];
        $lmpMonth = $_GET['month'];
        $lmpYear = $_GET['year'];

        if ($lmpYear >= "1970" && $lmpYear <= $yearCap && $lmpDay >= "1" && $lmpDay <= "31" && $lmpMonth >= "1" && $lmpMonth <= "12" ) {

            $_SESSION['lmpDate'][] = array($lmpMonth, $lmpDay, $lmpYear);

            $date = strtotime("$lmpMonth/$lmpDay/$lmpYear + 280 days");

            $day = date('d', $date);
            $month = date('m', $date);
            $year = date('Y', $date);

            $_SESSION['edcResults'][] = array($month, $day, $year);

            if (isset($_SESSION['lmpDate']) && isset($_SESSION['edcResults'])) {


                foreach ($_SESSION['lmpDate'] as $lmpDate) {

                    echo "<h1>Entered LMP is " . $lmpDate[0] . "/" . $lmpDate[1] . "/" . $lmpDate[2] . "</h1><br><br>";

                }

                foreach ($_SESSION['edcResults'] as $result) {

                    echo "<h1>Calculated EDC is " . $result[0] . "/" . $result[1] . "/" . $result[2] . "</h1><br><br>";

                }

            }
        } else {

            echo "<h1>Please enter a proper date on or after 01/01/1970 and before 01/01/$beforeYear</h1>";

        }
    } else if (isset($_SESSION['lmpDate']) && isset($_SESSION['edcResults'])) {

        foreach ($_SESSION['lmpDate'] as $lmpDate) {

            echo "<h1>Entered LMP is " . $lmpDate[0] . "/" . $lmpDate[1] . "/" . $lmpDate[2] . "</h1><br><br>";

        }

        foreach ($_SESSION['edcResults'] as $result) {

            echo "<h1>Calculated EDC is " . $result[0] . "/" . $result[1] . "/" . $result[2] . "</h1><br><br>";

        }

    } else {

        echo "<h1>Please enter in patients LMP.</h1>";

    }
    ?>
</div>
<button type="button" id="btnBegin">Continue<span class="continueArrow"> &rang; </span></button>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!--Link for the jquery auto-complete code-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</script>
<script type="text/javascript">
/*
 JS for the continue button
 */
var ARIS = {};

ARIS.ready = function() {
    document.getElementById("btnBegin").onclick = function() {
        ARIS.exit();
    }
}
</script>
<script type="text/javascript" src="https://www.wisc-online.com/ARISE_Files/JS/PatientInfo/OliviaBrooks_40w1d.js"></script>
<script type="text/javascript" src="https://www.wisc-online.com/ARISE_Files/JS/OBptntInfoInclude.js"></script>
</body>
</html>