
<style>
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
    }

    #legend h3 {
        margin-top: 0;
    }

    #legend img {
        vertical-align: middle;
    }
</style>

<div>
    <div id="map" style="clear:both;height: 600px;width: 100%;"></div>
    <div id="legend" style="bottom: 10px !important;"><h3>Legend</h3></div>
</div>

<ul>
    <li> Users with duplicate address are overlapped</li>
    <li> Users with invalid address are not shown</li>
</ul>

<script>

    var map;
    var addressArray = [];
    var allUserData =<?=  json_encode( $result );?>

    function initMap() {

        allUserData.forEach(function (value) {

            var address = value.street + ', ' + value.city + ', ' + value.state;
            fetch('http://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&sensor=false')
                .then(function (value) {
                    return value.json()
                })
                .then(function (val) {
                    if (val.status == "OVER_QUERY_LIMIT") {
                        alert('Google geo coding Api limit exceeded for the day')
                    } else if (val.status == "ZERO_RESULTS") {
                        console.debug('One of the users location is not available');
                    } else if (val.status == "OK") {

                        value.skills.forEach(function (value2, index2) {

                            var contentString = '<div id="map_detail">' +
                                '<table class="table table-striped"><thead><tr>' +
                                '<th>First Name</th>' +
                                '<th>Last Name</th>' +
                                '<th>Address</th>' +
                                '<th>Skills</th>' +
                                '<tr></thead><tbody>' +
                                '<tr>' +
                                '<td>' + value.first_name + '</td>' +
                                '<td>' + value.last_name + '</td>' +
                                '<td>' + value.street + ', ' + value.city + ', ' + value.state + '</td>' +
                                '<td>' + value2.skill_name + '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table></div>';


                            if (value2.skill_rating >= 2 && index2 == 0) {
                                addressArray.push({
                                    position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                                    type: 'scripting',
                                    data: contentString
                                });
                            } else if (value2.skill_rating >= 2 && index2 == 1) {
                                addressArray.push({
                                    position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                                    type: 'other',
                                    data: contentString
                                });
                            } else if (value2.skill_rating >= 2 && index2 == 2) {
                                addressArray.push({
                                    position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                                    type: 'database',
                                    data: contentString
                                });
                            } else if (value2.skill_rating >= 2 && index2 == 3) {
                                addressArray.push({
                                    position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                                    type: 'skills',
                                    data: contentString
                                });
                            }
                        });
                    }
                })
                .catch(function (err) {
                    console.log(err);
                });
        });


        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: new google.maps.LatLng(-33.91722, 151.23064),
            mapTypeId: 'roadmap'
        });

        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
            database: {
                name: 'Database',
                icon: iconBase + 'parking_lot_maps.png'
            },
            scripting: {
                name: 'Scripting language',
                icon: iconBase + 'library_maps.png'
            },
            other: {
                name: 'Other language',
                icon: iconBase + 'info-i_maps.png'
            },
            skills: {
                name: 'Personal skills',
                icon: 'https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/32x32/shadow/ok.png'
            }
        };


        setTimeout(function () {



            // Create markers.
            addressArray.forEach(function (feature) {

                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map
                });

                var content = feature.data;
                var infowindow = new google.maps.InfoWindow({
                    content: content
                });

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });


            });

            var legend = document.getElementById('legend');
            for (var key in icons) {
                var type = icons[key];
                var name = type.name;
                var icon = type.icon;
                var div = document.createElement('div');
                div.innerHTML = '<img src="' + icon + '"> ' + name;
                legend.appendChild(div);
            }

            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

        }, 3000);
    }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-sL4GbQ54JtinDpdeCCWPJG2zbfZv7aQ&callback=initMap">
</script>
