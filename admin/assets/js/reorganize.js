var itemDraged = null;

document.addEventListener("dragstart", function (e) {
  itemDraged = e.target;
});

document.addEventListener("dragenter", function (e) {
  e.preventDefault();
  e.target.classList.add("dragallowed");
});

document.addEventListener("dragleave", function (e) {
  e.preventDefault();
  e.target.classList.remove("dragallowed");
});

document.addEventListener("drop", function (e) {
  e.preventDefault();
  e.target.classList.remove("dragallowed");
});

function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
  if ( (itemDraged.className.includes("level_3") && event.target.className.includes("level_2")) || (itemDraged.className.includes("level_2") && event.target.className.includes("level_1")) ) {
    
    $.ajax({
      type: "POST",
      url: "process.reorganize.php",
      data: { id_from: itemDraged.id, id_to: event.target.id },
      success: function (e) {
        console.log(e);
        event.target.append(itemDraged);
        window.location.reload();        
      }
    });
  }

  //window.location.reload();
}

function handleDragStart(e) {
  this.style.opacity = "0.4";
}

function handleDragEnd(e) {
  this.style.opacity = "1";
}
