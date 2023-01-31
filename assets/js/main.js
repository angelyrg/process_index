
$(document).ready(function(){

  $("#modal_success").modal("show");
  $("#modal_error").modal("show");


  //Get EXCEL data
  $.ajax({
      type: "GET",
      url: "./admin/adminData/excel.json",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (excel) {
        var link_excel  = excel[0]['spreadsheets_link'];
        $("#excel_viewer").attr("src", link_excel );
  
      },
      failure: function (excel) {
        alert(excel.responseText);
      },
      error: function (excel) {
        alert(excel.responseText);
      },
    })


});

// Show excel content when click on button
$("#btn_process_list").on("click", function(){
    $("#excel_content").removeClass("d-none");
    $("#info_content").addClass("d-none");
});


$("#btn_collapse_tree").on("click", function(){
  $("#treeview").dxTreeView("collapseAll");
});

$("#btn_expand_tree").on("click", function(){
  $("#treeview").dxTreeView("expandAll");
});

//$("#treeview").dxTreeView("expandItem", nodeKey);
// $("#treeViewContainer").dxTreeView("collapseItem", nodeKey);