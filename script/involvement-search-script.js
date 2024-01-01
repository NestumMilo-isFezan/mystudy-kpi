// Prepare Element
var keyword = document.getElementById('keyword');
var searching = document.getElementById('search-data');
var container = document.getElementById('container');

// Event when searchbar is typing
keyword.addEventListener('keyup', function(){
    // Create Ajax object
    var xhr = new XMLHttpRequest();

    // Ajax preparation
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status ==200){
            container.innerHTML = xhr.responseText;
        }
    }

    // Executing Ajax
    xhr.open('GET', 'ajax/involvement.php?keyword=' + keyword.value, true);
    xhr.send();
});