const uidInput = document.getElementById('uid');
if (localStorage.getItem('uid') != null) {
    uidInput.value = localStorage.getItem('uid');
}