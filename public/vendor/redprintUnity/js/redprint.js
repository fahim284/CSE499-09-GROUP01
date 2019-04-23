$(document).ready(function() {
  $('.dateTime').datetimepicker({
      format : 'YYYY-MM-DD hh:mm:ss'
  });
  
  $(document).on('change', '.btn-file :file', function() {
    var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '')
    input.trigger('fileselect', [label])
  })

  $('.btn-file :file').on('fileselect', function(event, label) {
    var input = $(this).parents('.input-group').find(':text'),
      log = label
    if( input.length ) {
      input.val(log)
    } else {
      // if( log ) alert(log)
    }
  })

  function readURL(input, element) {
    if (input.files && input.files[0]) {
      var reader = new FileReader()
      reader.onload = function (e) {
        element.parents('.input-group').next('.img-upload').attr('src', e.target.result)
      }
      reader.readAsDataURL(input.files[0])
    }
  }


  function setExt(input, element) {
    if (input.files && input.files[0]) {
      var fileLabel = element.val().replace(/\\/g, '/').replace(/.*\//, '')
      fileLabel = fileLabel.split('.').pop()
      fileLabel = fileLabel ? fileLabel : '?'
      element.parents('.input-group').next('.file-type-container').text(fileLabel)
    }
  }

  $(".imgInp").change(function(){
      readURL(this, $(this))
  })


  $(".fileInp").change(function(){
      setExt(this, $(this))
  })


  var redprintButtons = document.querySelector('button[type="submit"]')
  if (redprintButtons) {
    var originalInnerHtml = redprintButtons.innerHTML
    var spinnerHtml = '<i class="fas fa-circle-notch fa-spin"></i>&nbsp;'
    
    redprintButtons.addEventListener('click', function () {
        redprintButtons.innerHTML = spinnerHtml + originalInnerHtml
        setTimeout( 
            function () {
                redprintButtons.innerHTML = originalInnerHtml
        
        }, 6000)
    }, false)    
  }
})

