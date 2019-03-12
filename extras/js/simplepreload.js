// JavaScript Document
function simplePreload()
{ 
  var args = simplePreload.arguments;
  document.imageArray = new Array(args.length);
  for(var i=0; i<args.length; i++)
  {
    document.imageArray[i] = new Image;
    document.imageArray[i].src = args[i];
  }
}
//window.onload = simplePreload( 'img/btn2hover.jpg', 'img/btn2-long-hover.jpg', 'img/btn2-longmc-hover.jpg','img/btnhover.jpg', 'img/btnhover1.jpg');