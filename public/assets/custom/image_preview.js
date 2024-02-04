// image preview
$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});

// image-ar preview
$(".image-ar").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview-ar').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});
// image-en preview
$(".image-en").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview-en').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});