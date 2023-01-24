<!-- Modal Insert new level-->
<div class="modal fade" id="modal_insert_level_<?=$id_item; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new level into level</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="member-form" action="process.insert.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="parent_level_id" value="<?= ($id_item != 0) ? $id_item : '' ?>">
          <div class="mb-3">
            <label for="new_level_name" class="form-label">New level name</label>
            <input type="text" class="form-control rounded" value="" id="new_level_name" name="new_level_name" required autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>