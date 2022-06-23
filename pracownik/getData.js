let selection = document.querySelector('select');
let result = document.querySelector('h2');
selection.addEventListener('change', () => {
    result.innerText = selection.options[selection.selectedIndex].value;
    console.log(selection.selectedIndex);
});