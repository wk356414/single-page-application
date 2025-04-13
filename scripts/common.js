
function exportData(tableName){
    window.open('utils/export.php?table=' + tableName, '_blank');
}

function deleteRecord(module, id){
    if(confirm("Are you sure you want to delete this record?")){
        $.ajax({
            url: 'utils/delete.php',
            method: 'GET',
            data: { table: module, id: id },
            success: function(response){
                alert(response);
                pageLoad(module + '/index.php');
            },
            error: function(){
                alert("Error deleting record.");
            }
        });
    }
}
