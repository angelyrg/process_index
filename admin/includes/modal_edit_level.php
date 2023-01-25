<!-- Modal edit level-->
<div class="modal fade" id="modal_edit_level_<?=$id_item; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit level</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="member-form" action="process.update.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="process_id" value="<?=$id_item ?>">
          <div class="mb-3">
            <label for="edit_level_name" class="form-label">Level name</label>
            <input type="text" class="form-control rounded" value="<?= $title ?>" id="edit_level_name" name="edit_level_name" required autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info rounded-pill" name="btn_save_changes">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>