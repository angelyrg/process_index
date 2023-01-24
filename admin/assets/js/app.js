
$(document).ready(function () {
    //Get all data
    $.ajax({
      type: "GET",
      url: "./../dataFolder/data.json",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        window.all_data = data;
      },
      failure: function (data) {
        alert(data.responseText);
      },
      error: function (data) {
        alert(data.responseText);
      },
    });

    //Get EXCEL data
    $.ajax({
      type: "GET",
      url: "./adminData/excel.json",
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
    });
});

// Search item to display info
function searchItem(full_id, data){
    let ids = full_id.split('_');
    data.forEach(values => {      

      if ( values.id == ids[0] ){
        const arr = Array.from( values.items );  

            arr.forEach(values2 => {
                if ( values2.id == ( ids[0]+"_"+ids[1] ) ){
                    const arr2 = Array.from( values2.items );

                    arr2.forEach(values3 => {                        
                        if ( values3.id == (ids[0]+"_"+ids[1]+"_"+ids[2]) ){

                            $("#process_title").text( values3.text );
                            $("#process_id").val( values3.id );
                            $("#process_id_bizagi").val( values3.id );
                            console.log(values3);

                            if(values3.bizagi_folder == null || values3.bizagi_folder == ""){
                              $("#link_bizagi_diagram").attr("href", "" );
                              $("#link_bizagi_diagram").addClass("d-none");
                            }else{
                              $("#link_bizagi_diagram").attr("href", "./../upload/bizagi/" + values3.bizagi_folder + "/index.html" );
                              $("#link_bizagi_diagram").removeClass("d-none");
                             }

                            if (values3.file_name == null && values3.file_name == ""){
                              $("#pdf_viewer").attr('src', "").addClass("d-none");
                              $("#no_pdf_viewer").removeClass("d-none");
                              $("#btn_update_pdf").addClass("d-none");

                            }else{
                              $("#pdf_viewer").attr('src', "./../upload/pdfs/" + values3.file_name + "#view=FitH" ).removeClass("d-none");
                              $("#no_pdf_viewer").addClass("d-none");
                              $("#btn_update_pdf").removeClass("d-none");

                            }

                        }                
                    });
                }
            });
        }
    });
}


// Update main content with selected process info
$(".item_clickeable").on("click", function () {
    $("#processes_excel").addClass("d-none");
    $("#process_info").removeClass("d-none");

    let item_id = $(this).attr("id");
    searchItem(item_id, window.all_data);
});

// Show Excel with processes list
$("#btn_processes_list").on('click', () => {
    $("#process_info").addClass("d-none");
    $("#processes_excel").removeClass("d-none");
});

