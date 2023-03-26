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
  console.log("css cookie is empty");
}