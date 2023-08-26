// JavaScript Document
function popitup(url,name,hw) {
	newwindow=window.open(url,name,hw+",resizable=1,scrollbars=1");
	if (window.focus) {newwindow.focus()}
	return false;
}
