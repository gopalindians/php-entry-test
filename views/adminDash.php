<?php defined( 'APP_VERSION' ) or die(); ?>
<div>
    <a target="_blank" href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ).'allUsers' ?>">See all users
        on map</a>
    <div class="row justify-content-md-center" style="display: none" id="user-table">

        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">State</th>
            </tr>
            </thead>
            <tbody id="user_list">
            </tbody>
        </table>
        <div id="load_more_div">
            <button class="btn btn-primary" id="load_more">Load more</button>
        </div>
    </div>

    <div class="row justify-content-md-center" id="admin-main-div"></div>


    <!-- Modal -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		  aria-hidden="true">
		 <div class="modal-dialog modal-lg" role="document">
			 <div class="modal-content">
				 <div class="modal-header">
					 <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
				 </div>
				 <div class="modal-body">
					 <table class="table table-striped table-dark">
						 <thead>
						 <tr>
							 <th scope="col">Field Name</th>
							 <th scope="col">Value</th>
							 <th scope="col">Rating</th>
						 </tr>
						 </thead>
						 <tbody>
						 <tr>
							 <td>First Name</td>
							 <td id="modal_fn"></td>
						 </tr>
						 <tr>
							 <td>Last Name</td>
							 <td id="modal_ln"></td>
						 </tr>
						 <tr>
							 <td>Street Name</td>
							 <td id="modal_sn"></td>
						 </tr>
						 <tr>
							 <td>City Name</td>
							 <td id="modal_cn"></td>
						 </tr>
						 <tr>
							 <td>Zip Code</td>
							 <td id="modal_zc"></td>
						 </tr>
						 <tr>
							 <td>State</td>
							 <td id="modal_state"></td>
						 </tr>
						 <tr>
							 <td>Phone</td>
							 <td id="modal_phone"></td>
						 </tr>
						 <tr>
							 <td>Email</td>
							 <td id="modal_email"></td>
						 </tr>

						 <tr>
							 <td>Scripting Language</td>
							 <td id="modal_sl"></td>
							 <td id="modal_sl_rating"></td>
						 </tr>

						 <tr>
							 <td>Other languages</td>
							 <td id="modal_ol"></td>
							 <td id="modal_ol_rating"></td>
						 </tr>

						 <tr>
							 <td>Databases</td>
							 <td id="modal_database"></td>
							 <td id="modal_database_rating"></td>
						 </tr>

						 <tr>
							 <td>Personal skills</td>
							 <td id="modal_ps"></td>
							 <td id="modal_ps_rating"></td>
						 </tr>

						 <tr style="display: none">
							 <td>lat Long</td>
							 <td id="modal_lati"></td>
							 <td id="modal_longi"></td>
						 </tr>
						 </tbody>
					 </table>

					 <div id="map" style="clear:both;height: 400px;width: 100%;"></div>
				 </div>
				 <div class="modal-footer">
					 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					 <button type="button" class="btn btn-primary">Save changes</button>
				 </div>
			 </div>
		 </div>
	 </div>-->


    <form id="myHiddenForm"
          action="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . '/userDetail' ?>"
          method="POST" style="display: none">
        <input type="hidden" name="user_id" value="Hello" id="user_id">
    </form>
</div>
<!-- Replace the value of the key parameter with your own API key. -->
<script>

    // This example displays a marker at the center of Australia.
    // When the user clicks the marker, an info window opens.

    var marker;
    var map;
    var infowindow;
    var contentString;

    function initMap() {

        var latitude = document.getElementById('modal_lati').innerHTML;
        var longitude = document.getElementById('modal_longi').innerHTML;


        var uluru = {lat: -25.363, lng: 131.044};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });

        if (contentString === '') {
            contentString = '<div id="map_detail"> Hello' +
                '</div>';
        }


        infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        marker = new google.maps.Marker({
            position: uluru,
            map: map,
            title: 'Uluru (Ayers Rock)'
        });

        //map.setCenter(marker.getPosition());


        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        map.addListener('center_changed', function () {
            // 3 seconds after the center of the map has changed, pan back to the
            // marker.
            map.panTo(marker.getPosition());
            window.setTimeout(function () {
                //map.panTo(marker.getPosition());
            }, 3000);
        });

        marker.addListener('click', function () {
            map.setZoom(10);
            map.setCenter(marker.getPosition());
        });


    }
</script>
<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-sL4GbQ54JtinDpdeCCWPJG2zbfZv7aQ&callback=initMap">
</script>-->

<!--/*onclick="userPop(\'' + value.id + '\')"*/   data-target="#exampleModal"
data-toggle="modal" data-target="#exampleModal"
-->
<script>
    $(document).ready(function () {
        var url = $('meta[name=app-url]').attr("content");

        /**
         * Fetch users
         */
        var users;
        var rowCount = 0;
        $.ajax({
            url: url + '/api/getUsers',
            success: function (response) {
                if (response.length > 0) {
                    //rowCount = $('table tr').length + response.length;
                    rowCount = response.length;
                    $('#user-table').show();
                    response.forEach(function (value) {
                        $('#user_list').show().append('' +
                            '<tr>' +
                            '<td></td>' +
                            '<td><a onclick="sendToDetail(\'' + value.id + '\')"  id="user_' + value.id + '" href="#" data-user-id="' + value.id + '">' + value.first_name + '</a></td>' +
                            '<td>' + value.last_name + '</td>' +
                            '<td>' + value.state + '</td>' +
                            '</tr>');
                    });
                } else {
                    $('#admin-main-div').html('<h1>No record found</h1>');
                }
            }
        });


        $('#load_more').click(function () {
            $.ajax({
                method: 'POST',
                data: {
                    offset: rowCount
                },
                url: url + '/api/getUsers',
                success: function (response) {
                    rowCount = $('table tr').length + response.length;
                    if (response.length === 0) {
                        $('#load_more_div').html('<i>End of records</i>');
                    } else {
                        response.forEach(function (value) {
                            $('#user_list').append('' +
                                '<tr>' +
                                '<td></td>' +
                                '<td><a  onclick="sendToDetail(\'' + value.id + '\')"  class="user_pop"  id="user_' + value.id + '" href="#">' + value.first_name + '</a></td>' +
                                '<td>' + value.last_name + '</td>' +
                                '<td>' + value.state + '</td>' +
                                '</tr>');
                        });
                    }
                }
            });


        });

    });

    function sendToDetail(user_id) {

        $('#user_id').val(user_id);
        $('#myHiddenForm').submit();
        return false;
    }


    /*var userPop = function (user_id) {
        console.log(user_id);
        var url = $('meta[name=app-url]').attr("content");

        var request = new Request(url + '/api/user/', {
            method: 'POST',
            mode: 'cors',
            headers: new Headers({
                'Content-Type': 'application/json'
            })
        });

        fetch(request, {
            body: JSON.stringify({
                user_id: user_id
            })
        }).then(function (response) {
            return response.json();
        }).then(function (res) {
            document.getElementById('modal_fn').innerHTML = res[0].first_name;
            document.getElementById('modal_ln').innerHTML = res[0].last_name;
            document.getElementById('modal_sn').innerHTML = res[0].street;
            document.getElementById('modal_cn').innerHTML = res[0].city;
            document.getElementById('modal_zc').innerHTML = res[0].zip;
            document.getElementById('modal_state').innerHTML = res[0].state;
            document.getElementById('modal_phone').innerHTML = res[0].phone;
            document.getElementById('modal_email').innerHTML = res[0].email;

            document.getElementById('exampleModalLabel').innerHTML = res[0].first_name + ' ' + res[0].last_name;
            var address = res[0].street + ', ' + res[0].city + ', ' + res[0].state;

            fetch('http://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&sensor=false')
                .then(function (value) {
                    return value.json()
                })
                .then(function (val) {
                    console.log(val.results[0].geometry.location);
                    document.getElementById('modal_lati').innerHTML = val.results[0].geometry.location.lat;
                    document.getElementById('modal_longi').innerHTML = val.results[0].geometry.location.lng;
                    var latlng = new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng);
                    //marker.setPosition(latlng);
                    //map.setZoom(10);
                    //console.log(res[0].first_name);
                    contentString = '<div id="map_detail">' +
                        '<table class="table table-striped"><thead><tr>' +
                        '<th>First Name</th>' +
                        '<th>Last Name</th>' +
                        '<th>Address</th>' +
                        '<tr></thead><tbody>' +
                        '<tr>' +
                        '<td>' + res[0].first_name + '</td>' +
                        '<td>' + res[0].last_name + '</td>' +
                        '<td>' + res[0].street + ', ' + res[0].city + ', ' + res[0].state + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table></div>';

                    /!*infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });*!/
                })
                .catch(function (err) {
                    console.log(err);
                })
        }).catch(function (err) {
            // Error :(
            console.log(err);
        });

    };*/
</script>