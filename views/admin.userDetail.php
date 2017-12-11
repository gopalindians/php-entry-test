<?php defined( 'APP_VERSION' ) or die(); ?>

<div>
    <div class="row justify-content-md-center">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Street</th>
                <th scope="col">City</th>
                <th scope="col">Zip</th>
                <th scope="col">State</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Total Score</th>
            </tr>
            </thead>
            <tbody id="user_list">
			<?php foreach ( $result as $item ): ?>
                <tr>
                    <td><?= $item['first_name'] ?></td>
                    <td><?= $item['last_name'] ?></td>
                    <td><?= $item['street'] ?></td>
                    <td><?= $item['city'] ?></td>
                    <td><?= $item['zip'] ?></td>
                    <td><?= $item['state'] ?></td>
                    <td><?= $item['phone'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['skill_category_1_rating'] + $item['skill_category_2_rating'] + $item['skill_category_3_rating'] + $item['skill_category_4_rating'] ?></td>
                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <input type="hidden" id="hidden_lat">
    <input type="hidden" id="hidden_long">

    <div id="map" style="clear:both;height: 400px;width: 100%;"></div>


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

        /*var latitude = document.getElementById('hidden_lat').value;
        var longitude = document.getElementById('hidden_long').value;*/

        var chandigarh = {lat: 30.7333, lng: 76.7794};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: chandigarh,
            draggable: true
        });
        map.setOptions({draggable: true});

        if (contentString === '') {
            contentString = '<div id="map_detail">Hello</div>';
        }


        infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        marker = new google.maps.Marker({
            position: chandigarh,
            map: map,
            title: ''
        });

        map.setCenter(marker.getPosition());


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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-sL4GbQ54JtinDpdeCCWPJG2zbfZv7aQ&callback=initMap">
</script>

<script>
    $(document).ready(function () {
        var url = $('meta[name=app-url]').attr("content");

        var address = "<?= $result[0]['street'] . ',' . $result[0]['city'] . ',' . $result[0]['state'] ?>";

        fetch('http://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&sensor=false')
            .then(function (value) {
                return value.json()
            })
            .then(function (val) {
                if (val.status == "OVER_QUERY_LIMIT") {
                    alert('Google geo coding Api limit exceeded for the day')
                } else if (val.status == "ZERO_RESULTS") {
                    alert('This users location is not available, default sets to Chandigarh');
                } else if (val.status == "OK") {
                    var latlng = new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng);
                    marker.setPosition(latlng);
                    marker.title = "<?= $result[0]['street'] ?>";
                    map.setZoom(1);

                    map.setOptions({draggable: true});
                    contentString = '<div id="map_detail">' +
                        '<table class="table table-striped"><thead><tr>' +
                        '<th>First Name</th>' +
                        '<th>Last Name</th>' +
                        '<th>Address</th>' +
                        '<th>Skills</th>' +
                        '<tr></thead><tbody>' +
                        '<tr>' +
                        '<td><?= $result[0]['first_name']?></td>' +
                        '<td><?= $result[0]['last_name']?></td>' +
                        '<td><?= $result[0]['street'] . ', ' . $result[0]['city'] . ', ' . $result[0]['state']?></td>' +
                        '<td><?= $result[0]['skill_category_1_name'] . ',  ' . $result[0]['skill_category_2_name'] . ', ' . $result[0]['skill_category_3_name'] . ', ' . $result[0]['skill_category_4_name']?></td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table></div>';

                    infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                }
            })
            .catch(function (err) {
                console.log(err);
            });
    })

</script>