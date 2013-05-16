function in_array (needle, haystack, argStrict) {

  var key = '',
    strict = !! argStrict;

  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }

  return false;
}




function cv_ou_livro(lista_cv)
{
    
	if(in_array(document.getElementById("ItemFormato").value, lista_cv))
	{
		 document.getElementById("ItemUrlCapa").style.display='none';
		
	}else{
            document.getElementById("ItemUrlCapa").style.display='inline';
        }
	
}