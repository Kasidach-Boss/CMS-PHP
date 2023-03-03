$(document).ready(function() {
  $('#summernote').summernote({
      height: 200
      
  });
  $('#selectAllBoxes').on('click', function() {
    if(this.checked) {
        $('.checkBoxes').each(function() {
            this.checked = true;                      
        });
    }else{
         $('.checkBoxes').each(function() {
            this.checked = false;                      
        });
    }
  });
$('.checkBoxes').on('click', function() {
    if($('.checkBoxes:checked').length == $('.checkBoxes').length){
        $('#selectAllBoxes').prop('checked', true);
    }else{
        $('#selectAllBoxes').prop('checked', false);
    }
  });
    
    

});

