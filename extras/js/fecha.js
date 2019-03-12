	var months_of_the_year = new Array ("Enero","Febrero","Marzo","Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	var calendario = new Date();
	var year = calendario.getFullYear();			// Returns year
	var month = calendario.getMonth();	// Returns month (0-11)
	var today = calendario.getDate();   		// Returns day (1-31)
	var weekday = calendario.getDay();	//Returns day(1-31)
	document.write(today + ' de ' + months_of_the_year[month] + ' de ' + year);