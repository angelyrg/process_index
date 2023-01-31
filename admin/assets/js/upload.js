// Global variables
let picker = document.getElementById("picker");
let listing = document.getElementById("listing");
let box = document.getElementById("box");
let elem = document.getElementById("myBar");
let counter = 1;
let total = 0;

// On button input change (picker), process it
picker.addEventListener("change", (e) => {
  // Reset previous upload progress
  elem.style.width = "0px";
  listing.innerHTML = "None";

  // Get total of files in that folder
  total = picker.files.length;
  counter = 1;

  var process_id_bizagi = $("#process_id_bizagi").val();
  //Get main folder name
  var theFiles = e.target.files;
  var relativePath = theFiles[0].webkitRelativePath;
  var filepath = relativePath.split("/");
  var foldername = filepath[0];

  // Process every single file
  for (var i = 0; i < picker.files.length; i++) {
    var file = picker.files[i];
    sendFile(file, file.webkitRelativePath);
  }

  // Send via AJAX to update json file
  $.post( "update_bizagi.php", { id: process_id_bizagi, bizagi_folder: foldername } )
  .done(function( data ) {
    console.log(data);
    window.location.reload();    
  });
  
});

// Function to send a file, call PHP backend
sendFile = function (file, path) {
  var item = document.createElement("li");
  var formData = new FormData();
  var request = new XMLHttpRequest();

  request.responseType = "text";

  // HTTP onload handler
  request.onload = function () {
    if (request.readyState === request.DONE) {
      if (request.status === 200) {
        //console.log(request.responseText); //Show all files upaloaded in conosole

        listing.innerHTML =
          request.responseText + " (" + counter + " of " + total + " ) ";

        // Show percentage
        box.innerHTML = Math.min((counter / total) * 100, 100).toFixed(2) + "%";

        // Show progress bar
        elem.innerHTML = Math.round((counter / total) * 100, 100) + "%";
        elem.style.width = Math.round((counter / total) * 100) + "%";

        // Increment counter
        counter = counter + 1;
      }
      if (counter >= total) {
        listing.innerHTML = "Uploading " + total + " file(s) is done!";
      }
    }
  };

  // Set post variables
  formData.set("file", file); // One object file
  formData.set("path", path); // String of local file's path
  //formData.set("info", info);

  // Do request to PHP
  request.open("POST", "upload.php");
  request.send(formData);
};

