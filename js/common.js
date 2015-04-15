var imagePath = 'wp-content/themes/boyle/images/Menu/';

function GetElement(id)
{
	if(document.all) {
		return document.all[id];
	} else if(document.getElementById) {
		return document.getElementById(id);
	} else if(document.layers) {
		return document.layers[id];
	} else {
		alert('This browser doesn\'t support "document.all", "document.layers", or "document.getElementById". (Fix this).');
		return null;
	}
}

function ShowHideContainer(obj)
{
    if (obj.style.display == 'block')
        obj.style.display = 'none';
    else
        obj.style.display = 'block';
}

function OpenPopUp(obj)
{
	var StatusWindow = null;
	StatusWindow = window.open(obj.href, 'status', 'width=1000,height=800,scrollbars=yes,toolbar=no,status=yes,resizable=yes', true);
	StatusWindow.focus();
	return false;
}

function OpenInParent(obj)
{
	self.opener.location = obj.href;
	return false;
}

function ExpandCollapseList(ListId, Image)
{    
    var List = GetElement(ListId);
    
    if (Image.src.indexOf('Plus') > -1)
    {
        //alert('Expand');
        Image.src = Image.src.replace('Plus', 'Minus');
        List.style.display = 'block';
    }
    else
    {
        //alert('Collapse');
        Image.src = Image.src.replace('Minus', 'Plus');
        List.style.display = 'none';
    }
    
    return true;
}

function getImageRoot(str) {
    var slash = str.lastIndexOf('/') + 1;
    return str.substring(slash, str.lastIndexOf('-'));
}

function Button_Over(obj) {
    obj.src = imagePath + getImageRoot(obj.src) + '-On.gif';
}

function Button_Out(obj) {
    obj.src = imagePath + getImageRoot(obj.src) + '-Off.gif';
}

function Button_Down(obj) {
    obj.src = imagePath + getImageRoot(obj.src) + '-Click.gif';
}