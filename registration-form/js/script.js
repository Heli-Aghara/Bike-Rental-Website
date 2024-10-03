document.addEventListener('DOMContentLoaded', function () {
  const firstNameInput = document.getElementById('f_name');
  const lastNameInput = document.getElementById('l_name');
  const phoneInput = document.getElementById('phone_no');
  const userNameInput = document.getElementById('username');

  const invalidUserNameText = document.getElementById('invalid_username-text');
  const form = document.forms['registration-form']

  form.addEventListener('submit', (e) => {

    //checking if all the fields are filled
    let isValid = true;
    Array.prototype.forEach.call(form.elements, (element) => {
      if (element.tagName === 'INPUT' && element.type !== 'submit') {
        if (element.value.trim() === '') {
          isValid = false;
        }
      }
    });
    if (!isValid) {
      e.preventDefault();
      alert('Please fill in all the required fields!');
    }

    // checking that there are no numbers and special symbols in first name and last name
    if (firstNameInput.value.match(/[0-9!@#$%^&*(),.?":{}|<>`~\/\\]/) || lastNameInput.value.match(/[0-9!@#$%^&*(),.?":{}|<>`~\/\\]/)) {
      alert('First name and last name cannot contain numbers or special symbols!');
      e.preventDefault(); // prevent the form from being submitted
    }

    //checking there are no alphabets and special symbols in phone no.
    if (phoneInput.value.match(/[a-zA-Z!@#$%^&*(),.?":{}|<>`~\/\\]/)) {
      alert('Phone number cannot contain alphabets or special symbols!');
      e.preventDefault(); // prevent the form from being submitted
    }

    //checking phone no.'s length
    if (phoneInput.value.length < 10) {
      alert("Phone no. must be 10 digits long!!");
      e.preventDefault();
    }


  });



  // | ****************checking the availability + validity of username(jquery)************** |


  $(document).ready(function () {


    $('#username').on('input', function () {
      const username = $(this).val();

      const isValidUserName = /^(?=.*[a-z])[a-z0-9_@]{5,16}$/.test(username);
      if (!isValidUserName) {
        invalidUserNameText.classList.add('invalid_message-text')
        invalidUserNameText.innerHTML = "Invalid Username. Only lowercase letters, numbers, @, and _ are allowed. Minimum length is 5 characters and maximum length is 16 characters. At least one lowercase alphabet letter is required in username."
        $('#username-status').html('');
        $('#register_btn').prop('disabled', true).addClass('disabled-button');

      } else {
        invalidUserNameText.innerText = "";
        $.ajax({
          url: 'check-username.php',
          type: 'POST',
          dataType: 'json',
          data: { 'username': username },
          success: function (response) {

            if (response['status'] == 'unavailable') {
              console.log(response['status']);
              $('#username-status').html('<i class="fas fa-times-circle"></i><span>&nbsp;Username already exists!</span>').css('color', 'red');
              $('#register_btn').prop('disabled', true).addClass('disabled-button');
            }
            else if (response['status'] == 'available') {
              console.log(response['status']);
              $('#username-status').html('<i class="fas fa-check-circle"></i><span>&nbsp;Username available!</span>').css('color', 'green');
              $('#register_btn').prop('disabled', false).removeClass('disabled-button');
            } else {
              $('#username-status').text('Error checking username!!').css('color', 'orange');
              $('#register_btn').prop('disabled', true).addClass('disabled-button');
            }



          },
          error: function () {
            $('#username-status').text('Error connecting to the server!').css('color', 'red');
            $('#register_btn').prop('disabled', true).addClass('disabled-button');
          }
        })
      }

    })

    // Clear both availability and validity messages when the username input is empty and the cursor is still in the textbox
    $('#username').on('keyup', function () {
      const username = $(this).val();
      if (username.length === 0) {
        $('#username-status').text('');
        $('#invalid_username-text').text('');
        $('#register_btn').prop('disabled', false).removeClass('disabled-button');
      }
    });


  })




  // ***************** | Password Validation | *******************
  $('#password').on('input', function () {
    const password = $(this).val();
    const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/.test(password);

    console.log(password, isValid);
    if (!isValid) {
      $('#invalid_password-text').html('<i class="fas fa-times-circle"></i><span>Password must contain at least 8 characters, including a lowercase letter, an uppercase letter, a number, and a special character.</span>').css('color', 'red');
    } else {
      $('#invalid_password-text').html('<i class="fas fa-check-circle"></i><span>Strong password!!</span>').css('color', 'green');
    }
  })

  $('#password').on('keyup', function () {
    const password = $(this).val();
    if (password.length === 0) {
      $('#invalid_password-text').text('');
    }
  });

  /**********************|Checking whether the phone no./email already exists|************************** */

  $(document).ready(function() {
    // Function to check availability
    function checkAvailability() {
        const email_id = $('#email_id').val();
        const phone_no = $('#phone_no').val();

        $.ajax({
            url: 'check-email-phone.php',
            type: 'POST',
            data: {
                email_id: email_id,
                phone_no: phone_no
            },
            success: function(response) {
                // Disable the register button if email/phone already exists
                if(response['email_exists'] || response['phone_exists']){
                  $('#register_btn').prop('disabled', true).addClass('disabled-button');
                }
                else{
                  $('#register_btn').prop('disabled', false).removeClass('disabled-button');
                }



                if (response['email_exists']) {
                    $('#email-result').html('<p>Email is already registered <span>&#10060;</span></p>').css('color','red');
                    
                } else {
                    $('#email-result').html('');
                }

                if (response['phone_exists']) {
                    $('#phone-result').html('<p>Phone number is already registered <span>&#10060;</span></p>').css('color','red');
                } else {
                    $('#phone-result').html('');
                }
                
                
            },
            error: function() {
                $('#email-result').html('<p>An error occurred</p>');
                $('#phone-result').html('<p>An error occurred</p>');
            }
        });
    }

    // Attach blur event to both email and phone fields
    $('#email_id, #phone_no').on('blur', checkAvailability);
});
  

    // clear the availability message when the email and phone input is empty and enable the registration button
    $('#email_id').on('keyup', function () {
      const email = $(this).val();      
      if (email.length === 0) {
        $('#email-result').html('');
        $('#register_btn').prop('disabled', false).removeClass('disabled-button');
      }
    });

    $('#phone_no').on('keyup', function () {
      const phone = $(this).val();
      if (phone.length === 0) {
        $('#phone-result').html('');
        $('#register_btn').prop('disabled', false).removeClass('disabled-button');
      }
    });


})


