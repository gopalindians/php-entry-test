<?php defined( 'APP_VERSION' ) or die(); ?>


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

<!-- Replace the value of the key parameter with your own API key. -->
<script>

    // This example displays a marker at the center of Australia.
    // When the user clicks the marker, an info window opens.
    /*
		var marker;
		var map;
		var infowindow;
		var contentString;

		function initMap() {

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
		}*/
</script>


<script>
    /*var map;
    var allUserData = < ?= json_encode( $result ); ?>;


    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 1,
            center: new google.maps.LatLng(-33.91722, 151.23064),
            mapTypeId: 'roadmap'
        });

        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
            parking: {
                name: 'Scripting languages',
                icon: iconBase + 'parking_lot_maps.png'
            },
            library: {
                name: 'Other languages',
                icon: iconBase + 'library_maps.png'
            },
            info: {
                name: 'Databases',
                icon: iconBase + 'info-i_maps.png'
            },
            skills: {
                name: 'Personal skills',
                icon: 'https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/32x32/shadow/ok.png'
            }

        };
        var addressArray = [];


        allUserData.forEach(function (value, index, array) {

            var address = value.street + ', ' + value.city + ', ' + value.state;
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

                        /!*var latlng = new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng);

						marker.setPosition(latlng);
						marker.title = address;
						map.setZoom(1);*!/

                        /!*'<table class="table table-striped"><thead><tr>' +
						'<th>First Name</th>' +
						'<th>Last Name</th>' +
						'<th>Address</th>' +
						'<th>Skills</th>' +
						'<tr></thead><tbody>' +
						'<tr>' +
						'<td>' + value.first_name + '' +
						'<td>' + value.last_name + '' +
						'<td>' + value.street + ', ' + value.city + ', ' + value.state +
						'<td></td>' +
						'</tr>' +
						'</tbody>' +
						'</table></div>';*!/


                        var contentString = value.street + ', ' + value.city + ', ' + value.state;

                        console.log(val.results[0].geometry.location.lat);
                        addressArray.push({
                            position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                            type: 'info'
                        });
                        console.log(addressArray);
                    }
                })
                .catch(function (err) {
                    console.log(err);
                });
        });


        var features = [
            {
                position: new google.maps.LatLng(-33.91721, 151.22630),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91539, 151.22820),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91747, 151.22912),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91910, 151.22907),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91725, 151.23011),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91872, 151.23089),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91784, 151.23094),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91682, 151.23149),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91790, 151.23463),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91666, 151.23468),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.916988, 151.233640),
                type: 'info'
            }, {
                position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
                type: 'parking'
            }, {
                position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
                type: 'library'
            }, {
                position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
                type: 'skills'
            }
        ];


        // Create markers.
        features.forEach(function (feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
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

    }*/

    var map;
    var addressArray = [];
    var allUserData =<?=  json_encode( $result )?>

        console.log(allUserData);

    function initMap() {

        allUserData.forEach(function (value, index, array) {

            var address = value.street + ', ' + value.city + ', ' + value.state;
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


                        //var contentString = value.street + ', ' + value.city + ', ' + value.state;

                        console.log(val.results[0].geometry.location.lat);


                        var skills;
                        value.skills.forEach(function (value2, index2, array2) {
                            console.log(value2.skill_nma);
                        });


                        value.skills.forEach(function (value2, index2, array2) {

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
                            } else {
                                /*addressArray.push({
                                    position: new google.maps.LatLng(val.results[0].geometry.location.lat, val.results[0].geometry.location.lng),
                                    type: 'database',
                                    data: contentString
                                });*/
                            }

                        });

                        console.log(addressArray);
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


            var features = [
                {
                    position: new google.maps.LatLng(-33.91721, 151.22630),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91539, 151.22820),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91747, 151.22912),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91910, 151.22907),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91725, 151.23011),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91872, 151.23089),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91784, 151.23094),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91682, 151.23149),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91790, 151.23463),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91666, 151.23468),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.916988, 151.233640),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
                    type: 'parking'
                }, {
                    position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
                    type: 'library'
                }
            ];

            // Create markers.
            addressArray.forEach(function (feature) {

                console.log(feature);
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

<script>
    /*$(document).ready(function () {


        var addressArray = [];
        var url = $('meta[name=app-url]').attr("content");

        var address = "< ?= $result[0]['street'] . ',' . $result[0]['city'] . ',' . $result[0]['state'] ?>";


        var result =< ?= json_encode( $result ) ?>;


        var self;
        result.forEach(function (value, index, array) {
            console.log(index, value);

            var address = value.street + ', ' + value.city + ', ' + value.state;

            self = this;

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
                        marker.title = address;
                        map.setZoom(1);

                        /!*contentString = '<div id="map_detail">' +
                            '<table class="table table-striped"><thead><tr>' +
                            '<th>First Name</th>' +
                            '<th>Last Name</th>' +
                            '<th>Address</th>' +
                            '<th>Skills</th>' +
                            '<tr></thead><tbody>' +
                            '<tr>' +
                            '<td>' + value.first_name + '' +
                            '<td>' + value.last_name + '' +
                            '<td>' + value.street + ', ' + value.city + ', ' + value.state +
                            '<td></td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table></div>';*!/


                        var contentString = value.street + ', ' + value.city + ', ' + value.state;
                        addressArray.push(contentString, val.results[0].geometry.location.lat, val.results[0].geometry.location.lng);


                        console.log(addressArray);

                        infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });


                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            animation: google.maps.Animation.DROP,
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
                })
                .catch(function (err) {
                    console.log(err);
                });
        });
    })*/
</script>
