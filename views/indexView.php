
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="alert alert-warning alert-dismissible fade show" id="error-div" style="display: none;" role="alert">
            <div id="error-div-content"></div>
        </div>


        <div class="alert alert-success alert-dismissible fade show" id="success-div" style="display: none;" role="alert">
            <div id="success-div-content"></div>
        </div>

        <form action="//<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>/handleUserForm" method="POST">
            <div class="form-row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="first_name"
                               placeholder="First Name" autocomplete="off" name="first_name" required maxlength="50"
                               tabindex="1" autofocus>
                        <div class="invalid-feedback">
                            Please provide a valid first name
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="last_name" required
                               placeholder="Last Name" autocomplete="off" name="last_name" maxlength="50" tabindex="2">
                        <div class="invalid-feedback">
                            Please provide a valid last name.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="street_name" required
                               placeholder="Street Name" autocomplete="off" name="street_name" maxlength="255"
                               tabindex="3">
                        <div class="invalid-feedback">
                            Please provide a valid street name.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="city_name" required
                               placeholder="City Name" autocomplete="off" name="city_name" maxlength="50" tabindex="4">
                        <div class="invalid-feedback">
                            Please provide a valid city name.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="number" class="form-control zip" id="zip_code" required
                               placeholder="Zip" autocomplete="off" name="zip_code" tabindex="5" maxlength="10"
                               size="10" style="width: 100%;" min="100000" max="999999">
                        <div class="invalid-feedback">
                            Please provide a valid zip code.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <select class="form-control" name="state" id="states" tabindex="6">
                            <option value="" disabled selected>State</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state name.
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="tel" class="form-control" id="phone" required
                               placeholder="Phone" autocomplete="off" name="phone" size="20" minlength="9"
                               maxlength="14" tabindex="7">
                        <div class="invalid-feedback">
                            Please provide a valid phone number
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="email" class=" form-control" id="email"
                               placeholder="Email" autocomplete="off" name="email" tabindex="8" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div id="loadCategoriesAndSkills" tabindex="9">
                    </div>
                </div>
                <button type="button" class="btn btn-primary" tabindex="10">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    /**
     * @author: Gopal Sharma <gopalindians@gmail.com>
     * @createdOn: 06-12-2017
     * @licence: cb_test copyright 2017
     */
    $(document).ready(function () {
        var url = $('meta[name=app-url]').attr("content");

        /**
         * Fetch states data
         */
        $.ajax({
            url: url + '/api/getStates',
            success: function (response) {
                response.forEach(function (value) {
                    $('#states').append('<option value="' + value.code + '">' + value.name + '</option>')
                });
            }
        });


        /**
         * Fetch Skills Category and Skills
         */
        var id;
        $.ajax({
            url: url + '/api/getCategoriesAndSkills',
            success: function (response) {
                response.forEach(function (value) {
                    id = value.skill_category_id;
                    $('#loadCategoriesAndSkills').append(
                        '<div class="form-group row" id="skill_category_div_' + value.skill_category_id + '">\n' +
                        '                    <label class="col-sm-6 col-form-label">' + value.skill_category_name + '</label>\n' +
                        '                    <div class="col-sm-6 row">\n' +
                        '                            <label class="col-form-label">Evaluate : </label>\n' +
                        '                            <input type="number" onkeyup="validate_value($(this).val(),' + value.skill_category_id + ')" id="eval_' + value.skill_category_id + '" class="form-control" placeholder="0-10" max="10" min="0">\n' +
                        '                        </div>' +
                        '                    <div class="col-sm-5">\n' +
                        '                        <select name="skill[' + value.skill_category_id + '][' + value.skill_category_id + ']" class="form-control" id="skill_' + value.skill_category_id + '">\n' +
                        '                        </select>\n' +
                        '                    </div>\n' +
                        '<div class="col-sm-7"><label>Rate : &nbsp;</label>' +
                        '<div class="form-check form-check-inline">\n' +
                        '  <label class="form-check-label">\n' +
                        '    <input class="form-check-input" required  type="radio" name="skill[' + value.skill_category_id + '][rating]" id="skill_rating" value="1"> 1\n' +
                        '  </label>\n' +
                        '</div>\n' +

                        '<div class="form-check form-check-inline">\n' +
                        '  <label class="form-check-label">\n' +
                        '    <input class="form-check-input" required type="radio" name="skill[' + value.skill_category_id + '][rating]" id="skill_rating" value="2">2\n' +
                        '  </label>\n' +
                        '</div>\n' +
                        '<div class="form-check form-check-inline">\n' +
                        '  <label class="form-check-label">\n' +
                        '    <input class="form-check-input" required type="radio" name="skill[' + value.skill_category_id + '][rating]" id="skill_rating" value="3">3\n' +
                        '  </label>\n' +
                        '</div>\n' +

                        '<div class="form-check form-check-inline">\n' +
                        '  <label class="form-check-label">\n' +
                        '    <input class="form-check-input" required type="radio" name="skill[' + value.skill_category_id + '][rating]" id="skill_rating" value="4">4\n' +
                        '  </label>\n' +
                        '</div>\n' +

                        '<div class="form-check form-check-inline">\n' +
                        '  <label class="form-check-label">\n' +
                        '    <input class="form-check-input" required type="radio" name="skill[' + value.skill_category_id + '][rating]" id="skill_rating" value="5">5\n' +
                        '  </label>\n' +
                        '</div>\n' +

                        '</div>\n' +
                        '</div>');


                    value.skills.forEach(function (value2) {
                        $('#skill_' + id + '').append(
                            '<option value="' + value2.skill_id + '">' + value2.skill_name + '</option>'
                        )
                    });
                });
            }
        });


        $('button').click(function () {
            var errors = false;
            var fn = $('#first_name').val();
            var ln = $('#last_name').val();
            var sn = $('#street_name').val();
            var cn = $('#city_name').val();
            var zc = $('#zip_code').val();
            var state = $('#states').val();
            var phone = $('#phone').val();
            var email = $('#email').val();

            var skill_1 = $('#skill_1').val();
            var eval_1 = $('#eval_1').val();
            var skill_1_rating = $("input[name='skill[1][rating]']:checked").val();

            var skill_2 = $('#skill_2').val();
            var eval_2 = $('#eval_2').val();
            var skill_2_rating = $("input[name='skill[2][rating]']:checked").val();

            var skill_3 = $('#skill_3').val();
            var eval_3 = $('#eval_3').val();
            var skill_3_rating = $("input[name='skill[3][rating]']:checked").val();

            var skill_4 = $('#skill_4').val();
            var eval_4 = $('#eval_1').val();
            var skill_4_rating = $("input[name='skill[4][rating]']:checked").val();


            function logError(message, fieldId) {
                errors = message;
                $('#success-div').hide();
                $('#error-div').show();
                $('#error-div-content').html(errors);

                if (fieldId !== '') {
                    setTimeout(
                        function () {
                        }, 2000);
                    $(fieldId).focus();
                    $(fieldId).removeClass('is-valid');
                    $(fieldId).addClass('is-invalid');
                    goToByScroll(fieldId);
                }
            }


            function logSuccess(message) {
                $('#error-div').hide();
                $('#success-div').show();
                $('#success-div-content').html(message);

            }

            function goToByScroll(id) {
                // Remove "link" from the ID
                id = id.replace("link", "");
                // Scroll
                $('html,body').animate({
                        scrollTop: $(id).offset().top
                    },
                    'slow');
            }


            if (fn === '') {
                logError('First Name cannot be empty', '#first_name')
            } else if (ln === '') {
                logError('Last Name cannot be empty', '#last_name')
            } else if (sn === '') {
                logError('Street Name cannot be empty', '#street_name')
            } else if (cn === '') {
                logError('City Name cannot be empty', '#city_name')
            } else if (zc === '') {
                logError('Zip Code cannot be empty', '#zip_code')
            } else if (state === null) {
                logError('State Name cannot be empty', '#states')
            } else if (phone === '') {
                logError('Phone Name cannot be empty', '#phone')
            } else if (email === '') {
                logError('Email cannot be empty', '#email')
            } else if (eval_1 === '' && eval_2 === '' && eval_3 === '' && eval_3 === '') {
                if (eval_1 == '') {
                    logError('Please evaluate one of the skill category', '#eval_1');
                    $("#eval_1").removeClass('is-valid');
                    $("#eval_1").addClass('is-invalid');
                } else if (eval_2 == '') {
                    logError('Please evaluate one of the skill category', '#eval_2');
                    $("#eval_2").removeClass('is-valid');
                    $("#eval_2").addClass('is-invalid');
                } else if (eval_3 == '') {
                    logError('Please evaluate one of the skill category', '#eval_3');
                    $("#eval_3").removeClass('is-valid');
                    $("#eval_3").addClass('is-invalid');
                } else if (eval_4 == '') {
                    logError('Please evaluate one of the skill category', '#eval_4');
                    $("#eval_4").removeClass('is-valid');
                    $("#eval_4").addClass('is-invalid');
                }

            } else if (skill_1_rating == undefined || skill_2_rating == undefined || skill_3_rating == undefined || skill_4_rating == undefined) {

                if (skill_1_rating == undefined) {
                    logError('Please rate one of the skills', '');
                    goToByScroll('#skill_category_div_1');
                    $('#skill_category_div_1').css({'background': 'antiquewhite'});

                    setTimeout(function () {
                        $('#skill_category_div_1').css({'background': ''})
                    },3000);
                } else if (skill_2_rating == undefined) {
                    logError('Please rate one of the skills', '');
                    goToByScroll('#skill_category_div_2');
                    $('#skill_category_div_2').css({'background': 'antiquewhite'});

                    setTimeout(function () {
                        $('#skill_category_div_2').css({'background': ''})
                    },3000);
                } else if (skill_3_rating == undefined) {
                    logError('Please rate one of the skills', '');
                    goToByScroll('#skill_category_div_3');
                    $('#skill_category_div_3').css({'background': 'antiquewhite'});

                    setTimeout(function () {
                        $('#skill_category_div_3').css({'background': ''})
                    },3000);
                } else if (skill_4_rating == undefined) {
                    logError('Please rate one of the skills', '');
                    goToByScroll('#skill_category_div_4');
                    $('#skill_category_div_4').css({'background': 'antiquewhite'});

                    setTimeout(function () {
                        $('#skill_category_div_4').css({'background': ''})
                    },3000);
                }


            } else {
                $.ajax({
                    url: url + '/api/handleUserForm',
                    method: 'POST',
                    data: {
                        first_name: fn,
                        last_name: ln,
                        street_name: sn,
                        city_name: cn,
                        zip_code: zc,
                        state: state,
                        phone: phone,
                        email: email,

                        skill_1: skill_1,
                        skill_1_eval: eval_1,
                        skill_1_rating: skill_1_rating,

                        skill_2: skill_2,
                        skill_2_eval: eval_2,
                        skill_2_rating: skill_2_rating,

                        skill_3: skill_3,
                        skill_3_eval: eval_3,
                        skill_3_rating: skill_3_rating,

                        skill_4: skill_4,
                        skill_4_eval: eval_4,
                        skill_4_rating: skill_4_rating
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.type == 'error') {
                            logError(response.message,'#error-div-content');
                            return;
                        } else if (response.type == 'success') {
                            logSuccess(response.message);
                            $('form').hide();
                            return;
                        } else {
                            alert('Something went wrong! Please try again later');
                        }
                    }
                })
            }
        });
    });


    // various validation checks bootstrap 4 style
    $(document).ready(function () {
        // first name
        $('#first_name').keyup(function (e) {
            if ($('#first_name').val().length < 1 || $('#first_name').val().length > 50) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //last name
        $('#last_name').keyup(function (e) {
            if ($('#last_name').val().length < 1 || $('#last_name').val().length > 50) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //street name
        $('#street_name').keyup(function (e) {
            if ($('#street_name').val().length < 1 || $('#street_name').val().length > 255) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //city name
        $('#city_name').keyup(function (e) {
            if ($('#city_name').val().length < 1 || $('#city_name').val().length > 50) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //zip code
        $('#zip_code').keyup(function (e) {
            if (!$.isNumeric($(this).val())) {
                $(this).val('');
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else if ($(this).val().length > 6) {
                $(this).val(this).val().slice(0, -1);
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //states
        $('#states').on('change', function (e) {
            if ($(this).val() === '') {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else if ($(this).val().length > 20) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        //phone
        $('#phone').keyup(function (e) {
            if (!$.isNumeric($(this).val())) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else if (($(this).val().length <= 11) && ($(this).val().length >= 10)) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            }

        });

        //email
        $('#email').keyup(function (e) {
            if (!validateEmail($('#email').val())) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else if ($(this).val().length > 100) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }

        });


        setTimeout(function () {
            //eval 1
            $('#eval_1').keyup(function (e) {
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else if ($(this).val() > 10 || $(this).val() < 0) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            });

            //eval 2
            $('#eval_2').keyup(function (e) {
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else if ($(this).val() > 10 || $(this).val() < 0) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            });


            //eval 3
            $('#eval_3').keyup(function (e) {
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else if ($(this).val() > 10 || $(this).val() < 0) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            });

            //eval 4
            $('#eval_4').keyup(function (e) {
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else if ($(this).val() > 10 || $(this).val() < 0) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            });

        }, 4000);
    });


    /**
     *  Validate skill category evaluation
     * @param value
     * @param id
     */
    function validate_value(value, id) {
        var ev = document.getElementById("eval_" + id);
        if (ev.value < 0 || ev.value > 10) {
            ev.value = '';
        }

        if (ev.value.indexOf("e") >= 0) {
            ev.value.replace(/\e/g, '');
        }

        if (!isNumeric(ev.value)) {
            ev.value = '';
        }
    }

    /**
     * Check if the number is positive number
     * @param n number
     * @returns {boolean}
     */
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    /**
     * Check if the email is valid or not
     * @param email string
     * @returns {boolean}
     */
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>