  <!-- Bootstrap Bundle with Popper -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn3.devexpress.com/jslib/22.2.3/js/dx.all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- <script src="assets/js/main.js"></script> -->
  <script>
      $(document).ready(function() {

          fetch("dataFolder/data.json")
              .then(resp => resp.json())
              .then(function(data) {
                  console.log(data);

                  const treeView = $('#treeview').dxTreeView({
                      items: data, //Data got from get_data.js
                      searchEnabled: true,
                      onItemClick: function(e) {

                        if( e.itemData['clickeable'] ){
                            console.log( e.itemData['id'] );
                            window.location.href = "./index2.php?id=" + e.itemData['id'];
                        }
                      }
                  }).dxTreeView('instance');

                  $('#searchMode').dxSelectBox({
                      items: ['contains', 'startswith', 'equals'],
                      value: 'contains',
                      onValueChanged(data) {
                          treeView.option('searchMode', data.value);
                      }
                  });

              })

          $("#btn_collapse_tree").on("click", function() {
              $("#treeview").dxTreeView("collapseAll");
          });

          $("#btn_expand_tree").on("click", function() {
              $("#treeview").dxTreeView("expandAll");
          });

      });
  </script>

  </body>

  </html>