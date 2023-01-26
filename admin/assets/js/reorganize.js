var itemDraged = null;

document.addEventListener("dragstart", function (e) {
  itemDraged = e.target;
});

function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
  event.target.append(itemDraged);
  $.ajax({
    type:"POST", 
    url:"process.reorganize.php", 
    data:{id_from:itemDraged.id, id_to:event.target.id}, 
    success:function(datos){
        console.log(datos)
    }
    });
}

document.addEventListener("dragenter", function (e) {
  e.preventDefault();
  e.target.style.opacity = "0.8";

  //$("#dragdrop_animation").addClass("d-none");


});
document.addEventListener("dragleave", function (e) {
  e.preventDefault();
  e.target.style.opacity = "1";
});
document.addEventListener("drop", function (e) {
  e.preventDefault();
  e.target.style.opacity = "1";
});
