function showImage(input, containImage) {
  if (input.files) {
    var filesAmount = input.files.length;
    containImage.html('');
    for (i = 0; i < filesAmount; i++) {
      var reader = new FileReader();
      reader.onload = function (e) {
        image = '<div class="contain-image"><img class="image" src="' + e.target.result + '"></div>';
        containImage.append(image);
      }
      reader.readAsDataURL(input.files[i]);
    }
  }
}

function imagePreview(inputElm)
{
  $(inputElm).on('change', function() {
    preview = $(this).closest(".form-group").find("div.preview-image");
    showImage(this, preview);
  });
}