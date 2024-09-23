<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Dropdown Test </title>
</head>
<body>
	<select name="course" id="course" required>
        <option value="">-- Select Course --</option>
        <?php $db = new mysqli("localhost", "root", "", "db_sepc"); ?>
        <?php $courseResults = mysqli_query($db, "SELECT course_code, course_description FROM tbl_courses");?>
        <?php while($row = mysqli_fetch_array($courseResults)) { ?>
          <option value="<?php echo $row['course_code']; ?>"><?php echo $row['course_code']; ?>
          </option>
        <?php } ?>
      </select>

	<select name="section" id="section" required></select>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
      $(document).ready(function(){
        $('#course').on('change', function(){
            var courseValue = this.value;
            if(courseValue){
                $.ajax({
                    type:'POST',
                    url:'getDropdownValues.php',
                    data:'courseValue='+courseValue,
                    success:function(html){
                        $('#section').html(html);
                    }
                }); 
            }else{
                $('#section').html('<option value="">-- Select Section --</option>');
            }
        });

        var defaultOption = $('#course').find('option[value=""]');
        if(defaultOption.is(':selected')){
            $('#section').html('<option value="">-- Select Section --</option>');
        }
        
      });
    </script>

</body>
</html>