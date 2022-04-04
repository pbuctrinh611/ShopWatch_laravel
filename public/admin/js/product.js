function loadFormAdd(value) {
  value = parseInt(value);
  const LAPTOP = 1;
  const PHONE = 2;
  const ACCESSORIES = 3;
  var component = '';
  switch (value) {
    case LAPTOP: case PHONE:
      component = addLaptopPhone();
      break;
    default:
      break;
  }
  return component;
}

function addLaptopPhone() {
  return `<div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="screen">Screen:</label>
                    <input type="text" class="form-control" id="screen" name="screen">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="os">OS:</label>
                    <input type="text" class="form-control" id="os" name="os">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="ram">Ram:</label>
                    <input type="text" class="form-control" id="ram" name="ram">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="pin">Pin:</label>
                    <input type="text" class="form-control" id="pin" name="pin">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="weight">Weight:</label>
                    <input type="text" class="form-control" id="weight" name="weight">
                  </div>
                </div>`;
}

function loadFormDetail(value, obj)
{
  value = parseInt(value);
  const LAPTOP = 1;
  const PHONE = 2;
  const ACCESSORIES = 3;
  var component = '';
  switch (value) {
    case LAPTOP: case PHONE:
      component = detailLaptopPhone(obj);
      break;
    default:
      break;
  }
  return component;
}

function detailLaptopPhone(obj) {
  return `<div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="screen">Screen:</label>
                    <input type="text" class="form-control" id="screen" name="screen" value="${obj.info.screen}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="os">OS:</label>
                    <input type="text" class="form-control" id="os" name="os"  value="${obj.info.os}">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="ram">Ram:</label>
                    <input type="text" class="form-control" id="ram" name="ram" value="${obj.info.ram}">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="pin">Pin:</label>
                    <input type="text" class="form-control" id="pin" name="pin" value="${obj.info.pin}">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="weight">Weight:</label>
                    <input type="text" class="form-control" id="weight" name="weight" value="${obj.info.weight}">
                  </div>
                </div>`;
}


function replaceNull(someObj, replaceValue = "***") {
  const replacer = (key, value) => 
    String(value) === "null" || String(value) === "undefined" ? replaceValue : value;
  //^ because you seem to want to replace (strings) "null" or "undefined" too

  return JSON.parse( JSON.stringify(someObj, replacer));
}