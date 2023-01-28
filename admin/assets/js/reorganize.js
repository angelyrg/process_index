var itemDraged = null;


document.addEventListener("dragstart", function (e) {
  itemDraged = e.target;
});

document.addEventListener("dragenter", function (e) {
  e.preventDefault();
  e.target.style.opacity = "0.8";
  e.target.style.border = "1px dashed gray";
});

document.addEventListener("dragleave", function (e) {
  e.preventDefault();
  e.target.style.opacity = "1";
  e.target.style.border = "1px solid #057689";
});

document.addEventListener("drop", function (e) {
  e.preventDefault();
  e.target.style.opacity = "1";
  e.target.style.border = "1px solid #057689";
});


function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
  if ( $("#"+event.target.id).hasClass("my_draggable") ){
    event.target.append(itemDraged);
    $.ajax({
      type:"POST", 
      url:"process.reorganize.php", 
      data:{id_from:itemDraged.id, id_to:event.target.id}, 
      success:function(){
          window.location.reload();
      }
    });
  }else{
    window.location.reload();
  }
}

function handleDragStart(e) {
  this.style.opacity = '0.4';
}

function handleDragEnd(e) {
  this.style.opacity = '1';
}