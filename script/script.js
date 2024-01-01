/*function myFunction(){
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav"){
        x.className += " responsive";
    }
    else {
        x.className = "topnav";
    }
}*/

function showSidebar(){
    const sidebar = document.querySelector('.sidebar');

    sidebar.style.display = 'flex';
    setTimeout(() => {
        sidebar.style.transform ="translate(0, 0)";
    }, 200);
}

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')

    sidebar.style.transform ="translate(100%, 0)";
    setTimeout(() => {
        sidebar.style.display = 'none';
    }, 500);
}
/*
function LoadOnce() { 
window.location.reload(); 
} */