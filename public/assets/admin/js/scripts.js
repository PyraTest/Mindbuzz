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
    $(".imageWord").css("display", "none");
    $("#gameType").on("change", function () {
        if (this.value == 3) {
            $(".imageWord").css("display", "flex");
        } else if (this.value == 4) {
            $(".imageWord").css("display", "flex");
        } else if (this.value == 5) {
            $(".imageWord").css("display", "flex");
        } else if (this.value == 6) {
            $(".imageWord").css("display", "flex");
        } else {
            $(".imageWord").css("display", "none");
        }
    });
    $(".js-select-unit").select2();
});
