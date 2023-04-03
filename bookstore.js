document.addEventListener('click',function(l){
    let el_id=l.target.id;

    switch(el_id){
        case 'nav-button1':
            location.href='inventory.php';
            break;
        case 'nav-button2':
            location.href='#';
            break;
        case 'nav-button3':
            location.href='#';
            break;
        case 'nav-button4':
            location.href='#';
            break;
        case 'nav-button5':
            location.href="#";
            break;
        case 'nav-button6':
            location.href='#';
            break;
        case 'nav-button7':
            location.href='#';
            break;
        case 'nav-button8':
            location.href='entry_forms.php';
            break;
        case 'nav-button9':
            location.href='#';
            break;
        case 'nav-button1-1':
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="flex"; 
            document.querySelector(".nav-sec").style.display="none";  
            break;
    }
})
    