//onmouseover event handler
function mouseover(image) {
	image.setAttribute('style','-webkit-filter: grayscale(100%)'); 
}

//onmouseout event handler
function mouseout(image) {
	image.setAttribute('style','-webkit-filter: grayscale(0%)'); 
}