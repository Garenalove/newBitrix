$(function () {
    var dialog, form;

    function addUser() {
        var textarea = $("textarea").val().toString().trim();
        if (textarea.length > 2000) {
            $(".exceptions").empty();
            $(".exceptions").append("Длина вашего сообщения привышает 2000 символов.");
        }
        else if (!textarea.length) {
            $(".exceptions").empty();
            $(".exceptions").append("Введите сообщение");
        }
        else {
            $.ajax(
                {
                    url: "/ajax/detail.php",
                    type: "POST",
                    dataType: "html",
                    data: {
                        "PAGE": "FORM",
                        "ID": $(".main").attr("id"),
                        "CL": $("textarea").val()
                    },
                    success: function (data) {
                        if (!data) {
                            alert("Произошла ошибка при добавлении.");
                            location.reload();
                        }
                        else {
                            $("#responseVacancy").empty();
                            $("#responseVacancy").append("Вы уже откликнутлись");
                            $("#responseVacancy").attr('disabled', true);
                            $(".response").append("Вы успешно откликнутлись на вакансию!");
                            dialog.dialog("close");
                        }
                    }
                });
        }
    }

    dialog = $("#dialog-form").dialog
    ({
        autoOpen: false,
        height: 420,
        width: 350,
        modal: true,
        buttons: {
            "Откликнуться": addUser,
            "Отмена": function () {
                dialog.dialog("close");
            }
        },
    });

    $("#responseVacancy").button().on("click", function () {
        dialog.dialog("open");
    });
});