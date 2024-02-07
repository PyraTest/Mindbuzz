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

    $("#add_choice").on("click", function () {
        var i = 0;
        var bar = $("#choice_div");
        bar.clone().attr("name", "choices[]").insertAfter(bar);
        console.log(bar.children()[0]);
        bar.children()[0].prop("disabled", false);
    });
    $("#add_to_select").on("click", function () {
        console.log($(this).parent().children());
        var value = $(this).parent().children()[0].value;
        $(this).prop("disabled", true);
        $("#choice_ans").append(
            "<option value=" + value + ">" + value + "</option>"
        );
    });

    $(".js-select-unit").select2();
});
