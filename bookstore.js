document.addEventListener('click',function(l){
    let el_id=l.target.id;
    
    
        if(el_id=='nav-button1') 
            location.href='inventory.php';
        if(el_id=='nav-button2')
            location.href='#';
        if(el_id=='nav-button3')
            location.href='#';
        if(el_id=='nav-button4')
            location.href='#';
        if(el_id=='nav-button5')
            location.href="#";
        if(el_id=='nav-button6')
            location.href='#';
        if(el_id=='nav-button7')
            location.href='#';
        if(el_id=='nav-button8')
            location.href='entry_forms.php';
        if(el_id=='nav-button9')
            location.href='#';
        if(el_id=='nav-button1-1'){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="flex"; 
            document.querySelector(".nav-sec").style.display="none";
        } 
        if(el_id=='nav-button2-2'){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="none"; 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".sup-form").style.display="flex";
        }
        if(el_id=="back-button"){
            document.querySelector(".nav-sec").style.display="flex";
            document.querySelector(".sup-form").style.display="none";
            document.querySelector(".sale-form").style.display="none";
            document.querySelector(".ord-form").style.display="none";
            document.querySelector(".clo-form").style.display="none";
            document.body.style.background="#f0cba9";
        }

        if(el_id=='nav-button3-3'){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="none"; 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".sup-form").style.display="none";
            document.querySelector(".sale-form").style.display="flex";
        }

        if(el_id=='nav-button4-4'){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="none"; 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".sup-form").style.display="none";
            document.querySelector(".sale-form").style.display="none";
            document.querySelector(".ord-form").style.display="flex";
        }

        if(el_id=='nav-button5-5'){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="805px" 
            document.querySelector(".nav-sec").style.display="none";
            
            document.querySelector(".clo-form").style.display="flex";
        }
    }
)

    