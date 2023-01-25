$(() => {
    const treeView = $('#treeview').dxTreeView({
      
      items: processes, //Data got from get_data.js
      searchEnabled: true,

      onItemClick: function(e){

        if( e.itemData['clickeable'] ){

          //Update files and data
          $("#process_title").text( e.itemData['text'] );

          if( e.itemData['file_name'] == "" || e.itemData['file_name'] == null){
            $("#pdf_viewer").attr("src", "").addClass("d-none");
            $("#no_pdf_viewer").removeClass("d-none");
          }else{
            $("#pdf_viewer").attr("src", "upload/pdfs/" + e.itemData['file_name'] + "#view=FitH").removeClass("d-none")
            $("#no_pdf_viewer").addClass("d-none");
          }
          
          if(e.itemData['bizagi_folder'] == "" || e.itemData['bizagi_folder'] == null){
            $("#link_bizagi_diagram").removeClass("btn-info").addClass("disabled", "btn-outline-info");
          }else{
            $("#link_bizagi_diagram").attr("href", "upload/bizagi/" + e.itemData['bizagi_folder'] + "/index.html");
          }

          // Prepare attachment files
          let atachment_list = '';
          $.each( e.itemData['attachment_files'], function(k, v){
            let item = `
              <li class="list-group-item d-flex justify-content-between align-items-center">
                ` + v['attach_name'] + `
                <a href="upload/attached/` + v['attach_file_name'] + `" class="btn btn-sm btn-outline-info rounded-pill" download>
                  <i class="fa-solid fa-download"></i> Download
                </a>
              </li>
            `;
            atachment_list += item;
          });
          $("#files_to_download").html(atachment_list);

          //Hide and show excel
          $("#excel_content").addClass("d-none");
          $("#info_content").removeClass("d-none");

        }
      }  

    }).dxTreeView('instance');

    $('#searchMode').dxSelectBox({
      items: ['contains', 'startswith', 'equals'],
      value: 'contains',
      onValueChanged(data) {
        treeView.option('searchMode', data.value);
      },
    });

  });
  