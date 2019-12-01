var gallery = {
  show : function(img){
  // show() : show selected image in light box

    var clone = img.cloneNode();
    clone.onclick = gallery.hide;
    var front = document.getElementById("lfront");
    front.innerHTML = "";
    front.appendChild(clone);
    front.classList.add("show");
    document.getElementById("lback").classList.add("show");
  },

  hide : function(){
  // hide() : hide the lightbox

    document.getElementById("lfront").classList.remove("show");
    document.getElementById("lback").classList.remove("show");
  }
};