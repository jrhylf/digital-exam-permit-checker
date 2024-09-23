<?php

// permitManager_edit.php
if(isset($_POST["sectionsValues"])){
    $sectionsValues = $_POST["sectionsValues"];
    $options = "";
    $conn = new mysqli("localhost", "root", "", "db_sepc");
    $sql = "SELECT subject_description FROM tbl_subjects WHERE FIND_IN_SET('$sectionsValues',section)";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $options .= '<option value="">-- Select Subject -- </option>';
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="'.$row["subject_description"].'">'.$row["subject_description"].'</option>';
        }
    } else {
        $options .= '<option value="">-- Select Subject -- </option>';
    }
    echo $options;
}

// maintenanceStudent_add.php
if(isset($_POST["courseValue"])){
    $courseValue = $_POST["courseValue"];

    $options = "";
    $conn = new mysqli("localhost", "root", "", "db_sepc");
    $sql = "SELECT section FROM tbl_sections WHERE course = '".$courseValue."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $options .= '<option value="">-- Select Section -- </option>';
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="'.$row["section"].'">'.$row["section"].'</option>';
        }
    } else {
        $options .= '<option value="">-- Select Section -- </option>';
    }
    echo $options;
}

// maintenanceStudent_edit.php
if(isset($_POST["courseValues"])){

    function getCapitalLetters($str)
    {
      if(preg_match_all('#([A-Z]+)#',$str,$matches))
        return implode('',$matches[1]);
      else
        return false;
    }

    $courseValues = $_POST["courseValues"];
    $course = getCapitalLetters($courseValues);

    $options = "";
    $conn = new mysqli("localhost", "root", "", "db_sepc");
    $sql = "SELECT section FROM tbl_sections WHERE course = '".$course."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $options .= '<option value="">-- Select Section -- </option>';
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="'.$row["section"].'">'.$row["section"].'</option>';
        }
    } else {
        $options .= '<option value="">-- Select Section -- </option>';
    }
    echo $options;
}

// maintenanceSubject_add.php
if(isset($_POST["courseValuesSub"])){
    $courseValuesSub = $_POST["courseValuesSub"];

    $options = "";
    $conn = new mysqli("localhost", "root", "", "db_sepc");
    $sql = "SELECT section FROM tbl_sections WHERE course = '".$courseValuesSub."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // $options .= '<option value="">-- Select Section -- </option>';
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="'.$row["section"].'">'.$row["section"].'</option>';
        }
    } else {
        // $options .= '<option value="">-- Select Section -- </option>';
    }
    echo $options;
}

// maintenanceSubject_add.php
if(isset($_POST["courseValuesSubEd"])){
    $courseValuesSubEd = $_POST["courseValuesSubEd"];

    $options = "";
    $conn = new mysqli("localhost", "root", "", "db_sepc");
    $sql = "SELECT section FROM tbl_sections WHERE course = '".$courseValuesSubEd."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // $options .= '<option value="">-- Select Section -- </option>';
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="'.$row["section"].'">'.$row["section"].'</option>';
        }
    } else {
        // $options .= '<option value="">-- Select Section -- </option>';
    }
    echo $options;
}

?>