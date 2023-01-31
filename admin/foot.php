
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Upload script is executed automaticatly when select a folder. -->
    <script src="assets/js/upload.js"></script>
    <script>
        // Autofocus in new excel modal
        $('#modal_new_excel_link').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        $('#modal_new_level').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });

        $('#table_id').DataTable();

    </script>

</body>

</html>