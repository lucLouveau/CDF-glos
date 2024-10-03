var selects=document.querySelector('#select_all').children;
var divButtons=document.querySelector('#boutonProduits').children;
var buttons=document.querySelectorAll("#boutonProduits>div>div");
var commande= document.querySelector('#commande>table>tbody');
var tot = document.querySelector("#resume").children[0];

initPage();

function initPage(){
    if(divButtons.length==selects.length){
        for(var i=0;i<divButtons.length;i++){
            if(i>0){ 
                divButtons[i].classList.add('d-none');
            }
            if(i==0){ 
                selects[i].classList.add("select_active");
            }
            selects[i].addEventListener('click', function(){
                var oldActive=document.querySelector('.select_active');
                var oldType=oldActive.innerHTML.replace(' ','_');
                if(this!==oldActive){
                    document.querySelector('#buttons_'+oldType).classList.add('d-none');
                    oldActive.classList.remove('select_active');
                    this.classList.add('select_active');
                    var type=this.innerHTML.replace(' ','_');
                    document.querySelector('#buttons_'+type).classList.remove('d-none');
                }
            })
        }
        for(var i=0;i<buttons.length;i++){
            buttons[i].addEventListener('click', function(){
                ajoutCommande(this);
            })
        }
    }
}

function ajoutCommande(ele){
    var produit = ele.id.split('button_')[1].replaceAll(' ','_').replaceAll('/','_');
    var tr=document.querySelector('#tr_'+produit);
    var elementPrix=parseFloat(ele.lastElementChild.innerHTML.split("€")[0]);
    if(tr==null){
        tr=document.createElement('tr');
        tr.id="tr_"+produit;
        tr.innerHTML=`<td>${produit.replaceAll('_',' ')}</td><td>1</td><td>${elementPrix}€</td>`;
        commande.appendChild(tr);
    }
    else{
        var quantite= tr.children[1];
        var total= tr.children[2];
        total.innerHTML=((parseFloat(total.innerHTML.split('€')[0])/parseFloat(quantite.innerHTML))*(parseFloat(quantite.innerHTML)+1))+"€";
        quantite.innerHTML = parseInt(quantite.innerHTML)+1;
    }
    var oldTot= parseFloat(tot.innerHTML.split(' ')[1].split("€")[0]);
    var newTot= oldTot+elementPrix;
    tot.innerHTML="Total: "+newTot+"€";
}