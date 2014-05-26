function displayFiles() {
	$("#content").load('getFiles.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "Files";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("DeleteButton").disabled = true;
}
function displayFields() {
	$("#content").load('getFields.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "Fields";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("DeleteButton").disabled = true;
}
function displayCSCG() {
	$("#content").load('getCSCGs.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "CSCG";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("EditButton").name = "CSCG";
	document.getElementById("DeleteButton").disabled = true;
	document.getElementById("DeleteButton").name = "CSCG";
}
function displayUnits() {
	$("#content").load('getUnits.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "Units";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("DeleteButton").disabled = true;
}
function displayTypes() {
	$("#content").load('getTypes.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "Types";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("DeleteButton").disabled = true;
}
function displayDocumentations() {
	$("#content").load('getDocumentations.php');
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "Documentations";
	document.getElementById("EditButton").disabled = true;
	document.getElementById("DeleteButton").disabled = true;
}
function displayFileDetails(name) {
	$("#content").load('getFileDetails.php?name=' + name);
	document.getElementById("AddButton").disabled = false;
	document.getElementById("AddButton").name = "FileDetails";
	document.getElementById("EditButton").disabled = false;
	document.getElementById("EditButton").name = "FileDetails";
	document.getElementById("DeleteButton").disabled = false;
	document.getElementById("DeleteButton").name = "FileDetails";
}
function addPushed(source) {
	switch (source.name) {
	case "CSCG":
		var newCSCG = window.prompt("Adding a new CSCG\nPlease enter the name",
				"");
		if (newCSCG != null) {
			$.ajax({
				url : 'addCSCG.php?CSCGname=' + newCSCG,
				type : 'GET',
				dataType : 'html',
				error : function(xhr, status, error) {
					alert("" + error);
				},
				success : function() {
					displayCSCG();
				}
			})

		}
		break;

	default:
		alert("Not yet implemented...");
		break;
	}
}

function editPushed(source) {
	alert("Edit Function not yet implemented...");
}
function deletePushed(source) {
	switch (source.name) {
	case "CSCG":
		var listCB = document.getElementsByClassName("CheckBox");
		j = 0;
		for (i = 0; i < listCB.length; i++) {
			if (listCB[i].checked) {
				if (j == 0) {
					j++;
					query = "DELETE FROM CSCG WHERE CSCGname='"
							+ listCB[i].name + "'";
					warning = listCB[i].name;
				} else {
					query += " OR CSCGname='" + listCB[i].name + "'";
					warning += ", " + listCB[i].name;
				}
			}
		}
		if (window.confirm("Confirm deletion of\n" + warning)) {
			$.ajax({
				url : 'deleteCSCG.php?query=' + query,
				type : 'GET',
				dataType : 'html',
				error : function(xhr, status, error) {
					alert("" + error);
				},
				success : function() {
					displayCSCG();
				}
			})
		}
		break;

	default:
		alert("Not yet implemented...");
		break;
	}
}

function updtCheckboxes(source) {
	var listCB=document.getElementsByClassName("CheckBox");
	nb=0;
	for(i=0;i<listCB.length;i++) {
		if (listCB[i].checked) {
			nb++;
		}
	}
	switch (nb) {
	case 0:
		document.getElementById("EditButton").disabled = true;
		document.getElementById("DeleteButton").disabled = true;
		break;
	case 1:
		document.getElementById("EditButton").disabled = false;
		document.getElementById("DeleteButton").disabled = false;
		break;
	default:
		document.getElementById("EditButton").disabled = true;
		document.getElementById("DeleteButton").disabled = false;
		break;
	}
}

function essaiJson() {
	$.ajax({
		url : 'sqlQuery.php',
		dataType : "json",
		data : {
			query : "SELECT * FROM CSCG"
		},
		error : function(xhr, status, error) {
			alert("Error: " + xhr + "," + error);
		},
		success : function(data) {
		    var append= [];
		    append.push("<table>");
			$.each ( data, function(i, value) {
			      if (( i % 2 ) == 0) {
			          fmt="odd";
			        }
			        else {
			          fmt="even";
			        }
			   
				append.push("<tr class='"+fmt+"'><td class='title'>"+"title"+"</td><td class='value'>"+value.CSCGname+"</td></tr>");
			});
			append.push("</table>");
			document.getElementById("content").innerHTML=append.join('');
		}
	});
}

function loginDB() {
	$.ajax({
		url : 'log.php',
		dataType : "json",
		type : 'POST',
		data : {
			username : document.getElementById("username").value,
			password : document.getElementById("password").value
		},
		error : function(xhr, status, error) {
			alert("Error: " + error);
		},
		success : function(data) {
			window.location.assign('main.html');
		}
	});
}

function logoutDB() {
	if (window.confirm("Confirm Logout?")) {
		$.ajax({
			url : 'logout.php',
			dataType : "json",
			type : 'POST',
			error : function(xhr, status, error) {
			},
			success : function(data) {
				window.location.assign('index.html');
			}
		});
	}

}

function load() {
	$.ajax({
		url : 'session.php',
		dataType : "json",
		type : 'POST',
		error : function(xhr, status, error) {
			alert("It seems that you're session has expired\nYou'll be redirect to the login page");
			window.location.assign('index.html');
		},
		success : function(data) {
			document.getElementById("logoutButton").disabled = false;		}
	});
}

