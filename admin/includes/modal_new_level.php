<!-- Modal New level-->
<div class="modal fade" id="modal_new_level" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New level</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="member-form" action="process.store.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= isset($data->id) ? $data->id : '' ?>">

          <div class="mb-3">
            <label for="level_name" class="form-label">Level name</label>
            <input type="text" class="form-control rounded" id="level_name" name="level_name" required autofocus autocomplete="off">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>