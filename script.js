document.getElementById("css-list").addEventListener(
  "change", 
  function() {
  var new_css = this.value;
  document.getElementById("css-link").setAttribute("href", new_css);
 
  document.cookie = "css=" + new_css;
  }
  
);
// get the cookie with css value
var css_cookie = document.cookie.replace(/(?:(?:^|.*;\s*)css\s*\=\s*([^;]*).*$)|^.*$/, "$1");

// if the cookie is not empty, set the css file
if (css_cookie != "") {
  console.log("css cookie is " + css_cookie);
  document.getElementById("css-link").setAttribute("href", css_cookie);
  document.getElementById("css-list").value = css_cookie;
}else{
  if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    console.log('User has dark mode enabled');
    document.getElementById("css-link").setAttribute("href", "css/dark.css");
    document.getElementById("css-list").value = "css/dark.css"; 
  }
  console.log("css cookie is empty");
}
var collapsed;
if(window.innerHeight > window.innerWidth){
  collapsed = true;
}else{
  collapsed = false;
}
var menuLinks = document.getElementsByClassName("menu-link");
function collapseMenu(){
  if(collapsed){
    for(var i = 0; i < menuLinks.length; i++){
      menuLinks[i].style.display = "block";
      collapsed = false;
    }
  }else{
      for(var i = 0; i < menuLinks.length; i++){
        menuLinks[i].style.display = "none";
        collapsed = true;
      }
    } 
}
document.getElementById("menu").addEventListener("click", collapseMenu);
window.addEventListener("resize", function(){
  if(window.innerHeight < window.innerWidth && collapsed){
    collapseMenu();
  } 
});
//collapse and hide menu button on window orientation change to landscape
//and show menu button on window orientation change to portrait
/*
function orientationChange(){
  if(window.innerHeight > window.innerWidth){
    for(var i = 0; i < menuLinks.length; i++){
      menuLinks[i].style.display = "block";
    }
    }else{
      for(var i = 0; i < menuLinks.length; i++){
        menuLinks[i].style.display = "none";
      }
    }
}

window.addEventListener("orientationchange", orientationChange);
orientationChange();*/