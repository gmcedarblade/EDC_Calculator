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
        <th>Allergies</th>
        <th>Height(cm)</th>
        <th>Admission Weight(kg)</th>
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

                    echo "Entered LMP is " . $lmpDate[0] . "/" . $lmpDate[1] . "/" . $lmpDate[2] . "!<br><br>";

                }

                foreach ($_SESSION['edcResults'] as $result) {

                    echo "Calculated EDC is " . $result[0] . "/" . $result[1] . "/" . $result[2] . "!<br><br>";

                }

            }
        } else {

            echo "<h1>Please enter a proper date on or after 01/01/1970 and before 01/01/$beforeYear</h1>";

        }
    } else if (isset($_SESSION['lmpDate']) && isset($_SESSION['edcResults'])) {

        foreach ($_SESSION['lmpDate'] as $lmpDate) {

            echo "Entered LMP is " . $lmpDate[0] . "/" . $lmpDate[1] . "/" . $lmpDate[2] . "!<br><br>";

        }

        foreach ($_SESSION['edcResults'] as $result) {

            echo "Calculated EDC is " . $result[0] . "/" . $result[1] . "/" . $result[2] . "!<br><br>";

        }

    } else {

        echo "<h1>Please enter in patients LMP.</h1>";

    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!--Link for the jquery auto-complete code-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</script>
<script type="text/javascript" src="https://www.wisc-online.com/ARISE_Files/JS/PatientInfo/HectorFernandezInfo.js"></script>
<script type="text/javascript" src="https://www.wisc-online.com/ARISE_Files/JS/ptntInfoInclude.js"></script>
</body>
</html>