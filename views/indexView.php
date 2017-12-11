<?php defined( 'APP_VERSION' ) or die(); ?>
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="alert alert-warning" id="error-div" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div id="error-div-content"></div>
        </div>


        <div class="alert alert-success" id="success-div" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div id="success-div-content"></div>
        </div>

        <form action="//<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>/handleUserForm" method="POST">
            <div class="form-row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="first_name"
                               placeholder="First Name" autocomplete="off" name="first_name" required maxlength="50"
                               tabindex="1" autofocus>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="last_name" required
                               placeholder="Last Name" autocomplete="off" name="last_name" maxlength="50" tabindex="2">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="street_name" required
                               placeholder="Street Name" autocomplete="off" name="street_name" maxlength="255"
                               tabindex="3">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="city_name" required
                               placeholder="City Name" autocomplete="off" name="city_name" maxlength="50" tabindex="4">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="zip_code" required
                               placeholder="Zip" autocomplete="off" name="zip_code" tabindex="5" maxlength="50">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <select class="form-control" name="state" id="states" tabindex="6">
                            <option value="" disabled selected>State</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="tel" class="form-control" id="phone" required
                               placeholder="Phone" autocomplete="off" name="phone" size="20" minlength="9"
                               maxlength="14" tabindex="7">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" required
                               placeholder="Email" autocomplete="off" name="email" tabindex="8">
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
                        '<div class="form-group row">\n' +
                        '                    <label class="col-sm-12 col-form-label">' + value.skill_category_name + '</label>\n' +
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
            var skill_1_rating = $("input[name='skill[1][rating]']:checked").val();

            var skill_2 = $('#skill_2').val();
            var skill_2_rating = $("input[name='skill[2][rating]']:checked").val();

            var skill_3 = $('#skill_3').val();
            var skill_3_rating = $("input[name='skill[3][rating]']:checked").val();

            var skill_4 = $('#skill_4').val();
            var skill_4_rating = $("input[name='skill[4][rating]']:checked").val();


            function logError(message, fieldId) {
                errors = message;
                $('#success-div').hide();
                $('#error-div').show();
                $('#error-div-content').html(errors);
                $(window).scrollTop($('#error-div').offset().top);
                if (fieldId !== '') {
                    setTimeout(
                        function () {
                        }, 2000);
                    $(fieldId).focus();
                }
            }


            function logSuccess(message) {
                $('#error-div').hide();
                $('#success-div').show();
                $('#success-div-content').html(message);
                $(window).scrollTop($('#success-div').offset().top);
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
            } else if (state === '') {
                logError('State Name cannot be empty', '#state')
            } else if (phone === '') {
                logError('Phone Name cannot be empty', '#phone')
            } else if (email === '') {
                logError('Email cannot be empty', '#email')
            } else if (skill_1_rating == undefined || skill_2_rating == undefined || skill_3_rating == undefined || skill_4_rating == undefined) {
                logError('Please rate one of the skills ')
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
                        skill_1_rating: skill_1_rating,

                        skill_2: skill_2,
                        skill_2_rating: skill_2_rating,

                        skill_3: skill_3,
                        skill_3_rating: skill_3_rating,

                        skill_4: skill_4,
                        skill_4_rating: skill_4_rating
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.type == 'error') {
                            logError(response.message);
                            return;
                        } else if (response.type == 'success') {
                            logSuccess(response.message);
                            return;
                        } else {
                            alert('Something went wrong! Please try again later');
                        }
                    }
                })
            }
        });
    });
</script>