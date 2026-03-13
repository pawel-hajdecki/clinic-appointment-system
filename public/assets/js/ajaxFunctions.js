const globalDebounceTimeouts = new Map(); // Mapowanie id_form
function clearDebounceTimeout(id_form) {
	if(globalDebounceTimeouts.has(id_form)) {
			clearTimeout(globalDebounceTimeouts.get(id_form));
		}
}

// Proste funkcje JavaScript, głównie dotyczące AJAX'a

// Funkcja przechodzi do URL, podanego jako parametr 'link', po potwierdzeniu przez użytkownika.
// (wyświetla zapytanie podane jako parametr 'message')
function confirmLink(link,message) {
	if(confirm(message)) {
		window.location.href=link;
	}
}

// Funkcja wysyłająca dane formularza identyfkowanego przez 'id_form', do podanego adresu 'url'.
// Otrzymana odpowiedź zamienia zawartość elementu na stronie o identyfikatorze 'id_to_reload'.
function ajaxPostForm(id_form,url,id_to_reload)
{
    var form = document.getElementById(id_form);
    var formData = new FormData(form); 
    var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				document.getElementById(id_to_reload).innerHTML = xmlHttp.responseText;
				document.getElementById("messages").style.display = "none"; // ukryj ewentualne stare komunikaty
			}else if(xmlHttp.status == 400) {
				document.getElementById("messages").innerHTML = xmlHttp.responseText;
				document.getElementById("messages").style.display = "block";
			}
			else{
				location.reload(); // jeśli wystąpi błąd, to przeładuj stronę
			}
		}
	}
    xmlHttp.open("POST", url, true); 
    xmlHttp.send(formData); 
}

// Funkcja wysyłająca dane formularza identyfkowanego przez 'id_form', do podanego adresu 'url'.
// Po otrzymaniu odpowiedzi wywoływana jest funkcja użytkownika podana jako 'user_function'.
function ajaxPostFormEx(id_form,url,user_function)
{
    var form = document.getElementById(id_form);
    var formData = new FormData(form); 
    var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			user_function();
		}
	}
    xmlHttp.open("POST", url, true); 
    xmlHttp.send(formData); 
}
 
// Funkcja odświeżająca zawartość elementu o identyfikatorze 'id_element'.
// Zawartość do odświeżenia jest otrzymana w odpowiedzi na żądanie wysłane do podanego adresu 'url'.
// Jeśli podano parametr 'interval' >0 (sekundy), to po otrzymaniu odpowiedzi po upływie podanego
// interwału odświeżanie zostanie automatycznie ponowione (tzw. AJAX pooling).
function ajaxReloadElement(id_element,url,interval=0) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(id_element).innerHTML = this.responseText;
			if (interval > 0) 
				setTimeout( function(){ ajaxReloadElement(id_element,url,interval) }, interval);
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}


/**
 * Funkcja zmieniająca stronę.
 * @param {number} pageNumber 
 * @param {string} id_form 
 * @param {string} url 
 * @param {string} id_to_reload 
 */
function changePage(pageNumber, id_form,url,id_to_reload) {
	clearDebounceTimeout(id_form); // wyczyść ewentualny timeout dla tego formularza
    document.getElementById(id_form).querySelector('#pageInput').value = pageNumber;
    ajaxPostForm(id_form, url, id_to_reload);
}

/**
 * Funkcja pomocnicza do filtrowania tabeli. Ustawia stronę na 1 i wywołuje AJAX'a.
 * @param {string} id_form 
 * @param {string} url 
 * @param {string} id_to_reload 
 */
function _executefilterTable(id_form,url,id_to_reload) {
	document.getElementById(id_form).querySelector('#pageInput').value = 1;
	ajaxPostForm(id_form, url, id_to_reload);
	
	
}

/**
 * Funkcja przeznaczona do wykonania w formalurzu/input'ach.
 * @param {string} id_form 
 * @param {string} url 
 * @param {string} id_to_reload 
 * @param {boolean} debounce 
 */
function filterTable(id_form,url,id_to_reload, debounce=false) {
	clearDebounceTimeout(id_form); // wyczyść ewentualny timeout dla tego formularza

	if(debounce) {
		globalDebounceTimeouts.set(id_form, setTimeout(() => {
			_executefilterTable(id_form, url, id_to_reload);
		}, 300)); // Opóźnienie 300 ms
	}else{
		_executefilterTable(id_form, url, id_to_reload);
	}	
}