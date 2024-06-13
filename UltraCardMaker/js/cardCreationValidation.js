$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='create_card']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        firstname: {
          required: true,
        minlength: 5,
        
      },
        password1: {
          required: true,
          minlength: 3,
          
        },
        password2:{
          required: true,
          equalTo: "#password1",
        }
      },
      // Specify validation error messages
      messages: {
        firstname: {
          required: "Potrebno je upisati korisničko ime",
          minlength: "Korisničko ime nesmije biti kraće od 5 znakova",
        },
        password2: {
          required: "Potrebno je ponoviti lozinku",
          equalTo: "Lozinke trebaju biti iste"
        },
     },

      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });