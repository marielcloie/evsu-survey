				
function addQuestion<?php echo $start;?>($start)
	{
		var d = document.getElementById('add_Question<?php echo $start; ?>');
		d.innerHTML += "<input class='form-control' type='text' name='<?php echo $start?>question[]'><br>";
	}
function addChoices() 
	{
	var dynamicTextBox= "";
		for (var i = 0; i < 4; i++) {
		    dynamicTextBox+= "<input class='form-control'  name='<?php echo $i?>choices[]'  id= 'DynamicTextBox'  type='text' +'";
		}

	document.getElementById("add_Choices").innerHTML=dynamicTextBox;
	}


function addTextBox<?php echo $i;?>()
	{
		var d = document.getElementById('addhere<?php echo $i; ?>');
		d.innerHTML += "<input class='form-control' type='text' name='<?php echo $i?>choices[]'><br>";
	}


