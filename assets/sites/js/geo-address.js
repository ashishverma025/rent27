let autocomplete;
let address1Field;
let address2Field;
let postalField;

function initAutocomplete() {
  address1Field = document.querySelector("#pickup_location");
  dropping_location = document.querySelector("#dropping_location");
  from_location = document.querySelector("#from_location");
  to_location = document.querySelector("#to_location");
  postalField = document.querySelector("#postcode");
  

  autocomplete = new google.maps.places.Autocomplete(address1Field, {
    componentRestrictions: { country: ["uk"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });

  autocomplete1 = new google.maps.places.Autocomplete(dropping_location, {
    componentRestrictions: { country: ["uk"]  },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });

  autocomplete2 = new google.maps.places.Autocomplete(from_location, {
    componentRestrictions: { country:["uk"]  },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  
  autocomplete2 = new google.maps.places.Autocomplete(to_location, {
    // componentRestrictions: { country: ["us","uk","ca","in"] },
    componentRestrictions: { country: ["uk"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });

  address1Field.focus();
  dropping_location.focus();
  if(from_location){
    from_location.focus();
  }
  if(to_location){
    to_location.focus();
  }

  autocomplete.addListener("place_changed", fillInAddress);

}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  const place = autocomplete.getPlace();
  let address1 = "";
  let postcode = "";
  var addStr = "";
  

  for (const component of place.address_components) {
    const componentType = component.types[0];
      console.log(component)
    switch (componentType) {
      case "street_number": {
        address1 = `${component.long_name} ${address1}`;
        addStr += address1+',';
        break;
      }

      case "route": {
        address1 += component.short_name;
        addStr += address1+',';
        break;
      }

      case "postal_code": {
        postcode = `${component.long_name}${postcode}`;
        addStr += postcode+',';
        break;
      }

      case "postal_code_suffix": {
        postcode = `${postcode}-${component.long_name}`;
        addStr += postcode+',';
        break;
      }
      case "locality":
        document.querySelector("#locality").value = component.long_name;
        addStr += component.long_name+',';

        break;

      case "administrative_area_level_1": {
        document.querySelector("#state").value = component.short_name;
        addStr += component.short_name+',';
        break;
      }
      case "country":
        let country = component.long_name;
        document.querySelector("#country").value = component.long_name;
        addStr += component.long_name+',';
        break;
    }
  }
  address1Field.value = address1;
  postalField.value = postcode;
  $("#pickup_location").val(addStr)
  address2Field.focus();
}
