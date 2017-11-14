

function addRecord() {
    // get values
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();

    // Add record
    $.post("ajax/addRecord.php", {
        first_name: first_name,
        last_name: last_name,
        email: email
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
    });
}

// READ records
function readRecords1() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function readRecords() {
    dataTable.ajax.reload();

    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
            id: id
        },
                function (data, status) {
                    // reload Users by using readRecords();
                    readRecords();
                }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
        id: id
    },
            function (data, status) {
                // PARSE json data
                var user = JSON.parse(data);
                // Assing existing values to the modal popup fields
                $("#update_first_name").val(user.first_name);
                $("#update_last_name").val(user.last_name);
                $("#update_email").val(user.email);
            }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function GetIdentificacaoDetails(id_identificacao) {
    var user_id = $(this).attr("id");
    $.ajax({
        url: "ajax/readIdentificacaoDetails.php",
        method: "POST",
        data: {id_identificacao: id_identificacao},
        dataType: "json",
        success: function (data)
        {
            $('#modalAvaliar').modal('show');
            //$(".records_content").html(response);
            //$('#view_identificacao').val(response);
            $('#last_name').val(data.last_name);
            $('.modal-title').text('Avaliação do candidato [' + data.id_usuario + ']');
            $('#user_id').val(user_id);
            $('#user_uploaded_image').html(data.user_image);
            $('#action').val("Edit");
            $('#operation').val("Edit");
        }
    })
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
        id: id,
        first_name: first_name,
        last_name: last_name,
        email: email
    },
            function (data, status) {
                // hide modal popup
                $("#update_user_modal").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
    );
}

$(document).ready(function () {
    // READ recods on page load
    //readRecords(); // calling function
    var dataTable = $('#candidato_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "ajax/fetch.php",
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 3, 4],
                "orderable": false,
            },
        ],

    });
});