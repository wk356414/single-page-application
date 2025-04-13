
function saveEmployee(){
    var formData = $('#employeeForm').serialize();
    $.ajax({
        url: 'employees/save.php',
        method: 'POST',
        data: formData,
        success: function(response){
            alert(response);

            if(response.indexOf("Error:") !== 0){
                pageLoad('employees/index.php'); // reload the employee list on success
            }
        },
        error: function(){
            alert("Error saving employee data.");
        }
    });
}
