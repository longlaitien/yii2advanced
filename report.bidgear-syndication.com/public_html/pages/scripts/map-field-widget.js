var MapField = function () {
    this.id = '';
    this.fieldLatId = '';
    this.fieldLngId = '';
    this.lat_center = '21.0277644';
    this.lng_center = '105.83415979999995';
    this.javaObject = '';
    this.map = '';
    this.auto = '';
    this.secondAuto = '';
};

MapField.prototype.init = function () {

};

//TODO init input
MapField.prototype.initInput = function (id) {
    var self = this;

    self.auto = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById(id)),
        {types: ['geocode']});

    self.auto.addListener('place_changed', function() {
        var place = self.auto.getPlace();
        if (!place.geometry) {
            return;
        }

        // If the place has a geometry, then present it on a map.
        self.setLat(place.geometry.location.lat());
        self.setLng(place.geometry.location.lng());
        self.setSecondText($('#'+id).val());

    });
};

//TODO init second input
MapField.prototype.initSecondInput = function (id) {
    var self = this;

    self.secondAuto = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById(id)),
        {types: ['geocode']});

    self.secondAuto.addListener('place_changed', function() {
        var place = self.secondAuto.getPlace();
        if (!place.geometry) {
            return;
        }
        self.setSecondLat(place.geometry.location.lat());
        self.setSecondLng(place.geometry.location.lng());

        self.map.setCenter(place.geometry.location.lat(), place.geometry.location.lng());
        self.map.removeMarkers();
        self.map.addMarker({
            lat: self.getSecondLat(),
            lng: self.getSecondLng(),
        });

    });
};

//TODO get click event on map
MapField.prototype.clickMap = function(e){
    var self = this;
    self.map.removeMarkers();
    self.map.setCenter(e.latLng.lat(), e.latLng.lng())
    self.map.addMarker({
        lat: e.latLng.lat(),
        lng: e.latLng.lng(),
    });
    self.setSecondLat(e.latLng.lat());
    self.setSecondLng(e.latLng.lng());
}

//TODO convert to out
MapField.prototype.convert = function(){
    var self = this;
    var text = self.getSecondText();
    var lat = self.getSecondLat();
    var lng = self.getSecondLng();
    if(text.length > 0 && lat.length >0 && lng.length >0){
        self.setTex(text);
        self.setLat(lat);
        self.setLng(lng);
    }

    self.closeModal();
}

//TODO second
//TODO set text for second input
MapField.prototype.setSecondText = function (value) {
    var self = this;
    $('#second-'+self.javaObject).val(value);
}

//TODO set second lat
MapField.prototype.setSecondLat = function(value){
    var self = this;
    $('#second-lat-' + self.javaObject).val(value);
}

//TODO set second lng
MapField.prototype.setSecondLng = function(value){
    var self = this;
    $('#second-lng-' + self.javaObject).val(value);
}

//TODO get text for second input
MapField.prototype.getSecondText = function () {
    var self = this;
    return $('#second-'+self.javaObject).val();
}

//TODO get second lat
MapField.prototype.getSecondLat = function(){
    var self = this;
    return $('#second-lat-' + self.javaObject).val();
}

//TODO get second lng
MapField.prototype.getSecondLng = function(){
    var self = this;
    return $('#second-lng-' + self.javaObject).val();
}

//TODO text
//TODO get text for input
MapField.prototype.getTex = function(){
    var self = this;
    return $('#' + self.id).val();
};

//TODO set text for input
MapField.prototype.setTex = function(value){
    var self = this;
    $('#' + self.id).val(value);
};

//TODO set lat
MapField.prototype.setLat = function(value){
    var self = this;
    console.log(self);
    $('#' + self.fieldLatId).val(value);
}

//TODO set lng
MapField.prototype.setLng = function(value){
    var self = this;
    $('#' + self.fieldLngId).val(value);
}

//TODO get lat
MapField.prototype.getLat = function(){
    var self = this;
    var lat = $('#' + self.fieldLatId).val();
    if(lat.length >0){
        return lat;
    }else {
        return self.lat_center;
    }
}

//TODO get lng
MapField.prototype.getLng = function(){
    var self = this;
    var lng = $('#' + self.fieldLngId).val();
    if(lng.length >0){
        return lng;
    }else {
        return self.lng_center;
    }

}

//TODO share current location
MapField.prototype.shareLocation = function(){
    var self = this;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            // get location  by lat & lng
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            geocoder.geocode({'latLng': latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        console.log(latitude);
                        self.setLat(latitude);
                        self.setLng(longitude);
                        self.setTex(results[0].formatted_address);
                    }
                }
            });
        });
    }
}

//TODO second share current location
MapField.prototype.shareSecondLocation = function(){
    var self = this;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            // get location  by lat & lng
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            geocoder.geocode({'latLng': latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        self.setSecondLat(latitude);
                        self.setSecondLng(longitude);
                        self.setSecondText(results[0].formatted_address);

                        //TODO set center and marker
                        self.map.setCenter(latitude, longitude);
                        self.map.removeMarkers();
                        self.map.addMarker({
                            lat: self.getSecondLat(),
                            lng: self.getSecondLng(),
                        });
                    }
                }
            });
        });
    }
}

//TODO get city name
MapField.prototype.codeLatLng = function(lat, lng) {
    var itemLocality = '';
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({latLng: latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                var arrAddress = results;
                //console.log(results);
                $.each(arrAddress, function(i, address_component) {
                    if (address_component.types[0] == "locality") {
                        console.log(address_component.address_components[0].long_name);
                        if(itemLocality == '')
                            itemLocality = address_component.address_components[0].long_name;
                    }
                });
            } else {
                //alert("No results found");
            }
        } else {
            //alert("Geocoder failed due to: " + status);
        }
    });
    return itemLocality;
}

//TODO open map modal
MapField.prototype.openModal = function (){
    var self = this;

    self.beforeOpenEnd();

    //TODO open modal
    $('#modal-map-' + self.javaObject).modal('show');
}

//TODO close modal
MapField.prototype.closeModal = function (){
    var self = this;

    //TODO close modal
    $('#modal-map-' + self.javaObject).modal('hide');

    self.afterCloseEnd();

}

//TODO run before open end modal
MapField.prototype.beforeOpenEnd = function () {

}

//TODO run after close end modal
MapField.prototype.afterCloseEnd = function () {

}


