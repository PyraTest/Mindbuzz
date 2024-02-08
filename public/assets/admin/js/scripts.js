$(document).ready(function () {
    $("#choices").css("display", "none");
    $("#complete").css("display", "none");
    $("#ans").css("display", "block");
    $("#ans_choice").css("display", "none");
    $("#type_id").on("change", function () {
        $("#trueOrFalse").addClass("hidden");
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
        } else if (this.value == "2") {
            $("#trueOrFalse").removeClass("hidden");
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

    // $("#add_choice").on("click", function () {
    //     var i = 0;
    //     var bar = $("#choice_div");
    //     bar.clone().attr("name", "choices[]").insertAfter(bar);
    //     console.log(bar.children()[0]);
    //     for(var i ; i)
    //     bar.children()[0].prop("disabled", false);
    // });

    // $("#add_to_select").on("click", function () {
    //     console.log($(this).parent().children());
    //     var value = $(this).parent().children()[0].value;
    //     $(this).prop("disabled", true);
    //     $("#choice_ans").append(
    //         "<option value=" + value + ">" + value + "</option>"
    //     );
    // });

    $("#add_choice").on("click", function () {
        var newInput = $("<input>", {
            type: "text",
            class: "form-control",
            name: "choices[]",
        });
        var newButton = $("<button>", {
            type: "button",
            class: "btn btn-success",
            text: "ADD TO CHOICES",
        });
        newButton.on("click", function () {
            var value = newInput.val();
            if (value.trim() !== "") {
                $("#choice_ans").append(
                    $("<option>", { value: value, text: value })
                );
                newButton.prop("disabled", true);
            } else {
                // Handle empty value error
            }
        });
        $("#choices").append(newInput).append(newButton);
    });

    $("#add_to_select").on("click", function () {
        var value = $("#ans_choice input").val();
        if (value.trim() !== "") {
            $("#choice_ans").append(
                $("<option>", { value: value, text: value })
            );
            $(this).prop("disabled", true);
        } else {
            // Handle empty value error
        }
    });

    $(".js-select-unit").select2();
});
