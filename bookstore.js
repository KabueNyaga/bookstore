document.addEventListener('click',function(l){
    let el_id=l.target.id;
    
    
        if(el_id=='nav-button1' || document.querySelector(".d1")) 
            location.href='inventory.php';
        if(el_id=='nav-button2' || document.querySelector(".d2"))
            location.href='suppliers.php';
        if(el_id=='nav-button3' || document.querySelector(".d3"))
            location.href='sales.php';
        if(el_id=='nav-button4' || document.querySelector(".d4"))
            location.href='orders.pph';
        if(el_id=='nav-button5' || document.querySelector(".d5"))
            location.href="client_orders.php";
        if(el_id=='nav-button6' || document.querySelector(".d6"))
            location.href='deliveries.php';
        if(el_id=='nav-button7' || document.querySelector(".d7"))
            location.href='supplier_pay.php';
        if(el_id=='nav-button8' || document.querySelector(".d8"))
            location.href='entry_forms.php';
        if(el_id=='nav-button9' || document.querySelector(".d9"))
            location.href='#';
        if(el_id=='nav-button1-1' || el_id=="button-desc1"){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".inv-form").style.display="flex"; 
            document.querySelector(".nav-sec").style.display="none";
        } 
        if(el_id=='nav-button2-2'|| el_id=="button-desc2"){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".sup-form").style.display="flex";
        }
        if(el_id=="back-button"){
            document.body.style.background="#f0cba9";
            document.querySelector(".nav-sec").style.display="flex";
            document.querySelector(".inv-form").style.display="none"; 
            document.querySelector(".sup-form").style.display="none";
            document.querySelector(".sale-form").style.display="none";
            document.querySelector(".ord-form").style.display="none";
            document.querySelector(".clo-form").style.display="none";
            
        }

        if(el_id=='nav-button3-3' || el_id=="button-desc3"){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"; 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".sale-form").style.display="flex";
        }

        if(el_id=='nav-button4-4' || el_id=="button-desc4"){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="665px"; 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".ord-form").style.display="flex";
        }

        if(el_id=='nav-button5-5' || el_id=="button-desc5"){
            document.body.style.background="linear-gradient(55deg,#3c3c43,#d87821)"; 
            document.body.style.height="805px" 
            document.querySelector(".nav-sec").style.display="none";
            document.querySelector(".clo-form").style.display="flex";
        }
    }
)

    