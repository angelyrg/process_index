
$(document).ready(
  $.ajax({
    dataType: "json",
    url: "dataFolder/data.json",
    success: function (data) {
      processes = data;
    },
  })
);

