$(document).ready(function () {
    $("#choices").css("display", "none");
    $("#complete").css("display", "none");
    $("#ans").css("display", "block");
    $("#ans_choice").css("display", "none");
    $("#type_id").on("change", function () {
        $("#ans").css("display", "block");
        $("#ans_choice").css("display", "none");
        $("#choices").css("display", "none");
        $("#complete").css("display", "none");
        if (this.value == "0") {
            $("#complete").css("display", "block");
        } else if (this.value == "1") {
            $("#ans").css("display", "none");
            $("#ans_choice").css("display", "block");

            $("#choices").css("display", "block");
        }
    });
});
