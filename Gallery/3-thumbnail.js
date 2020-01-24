var gallery = {
  show : function(img){
  // show() : show selected image in light box

    var clone = img.cloneNode();
    var domain = clone.src.substr(0, clone.src.lastIndexOf("/",clone.src.lastIndexOf("/")-1)+1);
    var image = clone.src.substr(clone.src.lastIndexOf("/")+1);
    clone.onclick = gallery.hide;
    clone.src = domain + "gallery/" + image;
    var front = document.getElementById("lfront");
    front.innerHTML = "";
    front.appendChild(clone);
    front.classList.add("show");
    front.classList.add("foto");

    document.getElementById("lback").classList.add("show");
  },

  hide : function(){
  // hide() : hide the lightbox

    document.getElementById("lfront").classList.remove("show");
    document.getElementById("lback").classList.remove("show");
  }
};