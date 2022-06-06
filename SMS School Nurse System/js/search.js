// search function for studentlist
function searchStudent() {
      
    let rowCountO = 0;
    let inputO, filterO, tableO, trO, i;
    let tdO0, tdO1, tdO2;
    let txtValO0, txtValO1, txtValO2;
    inputO = $('#searchStudent').val();
    console.log(inputO)
    filterO = inputO.toUpperCase();
    tableO = document.getElementById("studentTable");
    trO = tableO.getElementsByTagName("tr");
    for (i = 0; i < trO.length; i++) {
      tdO0 = trO[i].getElementsByTagName("td")[0];
      tdO1 = trO[i].getElementsByTagName("td")[1];
      tdO2 = trO[i].getElementsByTagName("td")[2];
      tdO3 = trO[i].getElementsByTagName("td")[3];
      tdO4 = trO[i].getElementsByTagName("td")[4];
      tdO5 = trO[i].getElementsByTagName("td")[5];
      tdO6 = trO[i].getElementsByTagName("td")[6];
      tdO7 = trO[i].getElementsByTagName("td")[7];
      tdO8 = trO[i].getElementsByTagName("td")[8];
      tdO9 = trO[i].getElementsByTagName("td")[9];
      tdO10 = trO[i].getElementsByTagName("td")[10];

      if (tdO1 || tdO2 || tdO3 || tdO4 || tdO5 || tdO6 || tdO7 || tdO8 || tdO9 || tdO10 ) {
        txtValO0 = tdO0.textContent || tdO0.innerText;
        txtValO1 = tdO1.textContent || tdO1.innerText;
        txtValO2 = tdO2.textContent || tdO2.innerText;
        txtValO3 = tdO3.textContent || tdO2.innerText;
        txtValO4 = tdO4.textContent || tdO2.innerText;
        txtValO5 = tdO5.textContent || tdO2.innerText;
        txtValO6 = tdO6.textContent || tdO2.innerText;
        txtValO7 = tdO7.textContent || tdO2.innerText;
        txtValO8 = tdO8.textContent || tdO2.innerText;
        txtValO9 = tdO9.textContent || tdO2.innerText;
        txtValO10 = tdO10.textContent || tdO2.innerText;
        if (txtValO0.toUpperCase().indexOf(filterO) > -1 || txtValO1.toUpperCase().indexOf(filterO) > -1 || txtValO2.toUpperCase().indexOf(filterO) > -1 || txtValO3.toUpperCase().indexOf(filterO) > -1 || txtValO4.toUpperCase().indexOf(filterO) > -1 || txtValO5.toUpperCase().indexOf(filterO) > -1 || txtValO6.toUpperCase().indexOf(filterO) > -1 || txtValO7.toUpperCase().indexOf(filterO) > -1 || txtValO8.toUpperCase().indexOf(filterO) > -1 || txtValO9.toUpperCase().indexOf(filterO) > -1 || txtValO10.toUpperCase().indexOf(filterO) > -1) {
          trO[i].style.display = "";
          rowCountO++;
        } else {
          trO[i].style.display = "none";
        }
      };       
    };
    if (rowCountO == 0) {
      $("#no-student").css("display", "block");
    } else {
      $("#no-student").css("display", "none");
      rowCountO = 0;
    }
  };


// search function for schedules
  function searchUsers() {
  
    let rowCountO = 0;
    let inputO, filterO, tableO, trO, i;
    let tdO0, tdO1, tdO2, tdO3, tdO4, tdO5, tdO6, tdO7;
    let txtValO0, txtValO1, txtValO2, txtValO3, txtValO4, txtValO5, txtValO6, txtValO7;
    inputO = $('#searchUsers').val();
    console.log(inputO)
    filterO = inputO.toUpperCase();
    tableO = document.getElementById("myTable");
    trO = tableO.getElementsByTagName("tr");
    for (i = 0; i < trO.length; i++) {
      tdO0 = trO[i].getElementsByTagName("td")[0];
      tdO1 = trO[i].getElementsByTagName("td")[1];
      tdO2 = trO[i].getElementsByTagName("td")[2];
      tdO3 = trO[i].getElementsByTagName("td")[3];
      tdO4 = trO[i].getElementsByTagName("td")[4];
      tdO5 = trO[i].getElementsByTagName("td")[5];
      tdO6 = trO[i].getElementsByTagName("td")[6];
      tdO7 = trO[i].getElementsByTagName("td")[7];
  
      if (tdO1 || tdO2 || tdO3 || tdO4 || tdO5 || tdO6 || tdO7 ) {
        txtValO0 = tdO0.textContent || tdO0.innerText;
        txtValO1 = tdO1.textContent || tdO1.innerText;
        txtValO2 = tdO2.textContent || tdO2.innerText;
        txtValO3 = tdO3.textContent || tdO3.innerText;
        txtValO4 = tdO4.textContent || tdO4.innerText;
        txtValO5 = tdO5.textContent || tdO5.innerText;
        txtValO6 = tdO6.textContent || tdO6.innerText;
        txtValO7 = tdO7.textContent || tdO7.innerText;
        if (txtValO0.toUpperCase().indexOf(filterO) > -1 || txtValO1.toUpperCase().indexOf(filterO) > -1 || txtValO2.toUpperCase().indexOf(filterO) > -1 || txtValO3.toUpperCase().indexOf(filterO) > -1 || txtValO4.toUpperCase().indexOf(filterO) > -1 || txtValO5.toUpperCase().indexOf(filterO) > -1 || txtValO6.toUpperCase().indexOf(filterO) > -1 || txtValO7.toUpperCase().indexOf(filterO) > -1) {
          trO[i].style.display = "";
          rowCountO++;
        } else {
          trO[i].style.display = "none";
        }
      };       
    };
    if (rowCountO == 0) {
      $("#no-search").css("display", "block");
    } else {
      $("#no-search").css("display", "none");
      rowCountO = 0;
    }
  };


