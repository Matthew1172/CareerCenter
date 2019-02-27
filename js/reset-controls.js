$(document).ready(function(){
  $('#change-sector-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your sectors?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var med = $('#change-sector-med');
          var it = $('#change-sector-it');
          var bus = $('#change-sector-bus');
          var health = $('#change-sector-health');
          var food = $('#change-sector-food');
          var hosp = $('#change-sector-hosp');
          var cul = $('#change-sector-cul');

          var submit = $('#change-sector-submit').val();

          $('.form-message').load('php/reset-sectors.php', {
            med: med.prop('checked'),
            it: it.prop('checked'),
            bus: bus.prop('checked'),
            health: health.prop('checked'),
            food: food.prop('checked'),
            hosp: hosp.prop('checked'),
            cul: cul.prop('checked'),
            submit: submit,
            success: function(response){
              console.log(response);
            }
          });
        }
      }
    });
  });
  $('#change-pw-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your password?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_pw = $('#change-pw-input').val();
          var change_pw2 = $('#change-pw2-input').val();
          var submit = $('#change-pw-submit').val();
          $('.form-message').load('php/reset-pw.php', {
            change_pw: change_pw,
            change_pw2: change_pw2,
            submit: submit
          });
        }
      }
    });
  });
  $('#change-phone-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your phone number?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_phone = $('#change-phone-input').val();
          var change_phone2 = $('#change-phone2-input').val();
          var submit = $('#change-phone-submit').val();
          $('.form-message').load('php/reset-phone.php', {
            change_phone: change_phone,
            change_phone2: change_phone2,
            submit: 1
          });
        }
      }
    });
  });
  $('#change-email-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your email?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_email = $('#change-email-input').val();
          var change_email2 = $('#change-email2-input').val();
          var submit = $('#change-email-submit').val();
          $('.form-message').load('php/reset-email.php', {
            change_email: change_email,
            change_email2: change_email2,
            submit: submit
          });
        }
      }
    });
  });
  $('#change-web-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your company URl?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_web = $('#change-web-input').val();
          var change_web2 = $('#change-web2-input').val();
          var submit = $('#change-web-submit').val();
          $('.form-message').load('php/reset-web.php', {
            change_web: change_web,
            change_web2: change_web2,
            submit: 1
          });
        }
      }
    });
  });
  $('#upload-form').submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var x = 'Are you sure you want to upload this resume? (This will override your previous resume.)'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $.ajax({
            url: 'php/upload-resume.php', // Url to which the request is send
            type: 'POST',                 // Type of request to be send, called as method
            data: formData,               // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,           // The content type used when sending data to the server.
            cache: false,                 // To unable request pages to be cached
            processData:false            // To send DOMDocument or non processed data file it is set to false
          });
        }
      }
    });
  });
  $('#change-stateNum-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your state unemployment number?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_stateNum = $('#change-stateNum-input').val();
          var change_stateNum2 = $('#change-stateNum2-input').val();
          var submit = $('#change-stateNum-submit').val();
          $('.form-message').load('php/reset-stateNum.php', {
            change_stateNum: change_stateNum,
            change_stateNum2: change_stateNum2,
            submit: 1
          });
        }
      }
    });
  });
  $('#change-unemp-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your state unemployment number?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_unemp = $('#change-unemp-input').val();
          var change_unemp2 = $('#change-unemp2-input').val();
          var submit = $('#change-unemp-submit').val();
          $('.form-message').load('php/reset-unemp.php', {
            change_unemp: change_unemp,
            change_unemp2: change_unemp2,
            submit: submit
          });
        }
      }
    });
  });
  $('#change-tax-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your tax number?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_tax = $('#change-tax-input').val();
          var change_tax2 = $('#change-tax2-input').val();
          var submit = $('#change-tax-submit').val();
          $('.form-message').load('php/reset-tax.php', {
            change_tax: change_tax,
            change_tax2: change_tax2,
            submit: submit
          });
        }
      }
    });
  });
});
