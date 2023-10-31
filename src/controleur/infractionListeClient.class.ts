// déclaration de l’ensemble des zones de saisie et d’affichage nécessaires à la gestion du formulaire type
type TInfraListeForm = {
    btnDeroulant : Array<HTMLInputElement>, 
    divLigne: Array<HTMLElement>
}

class VueInfraListe {
    private _form: TInfraListeForm;
    get form():TInfraListeForm {return this._form;}

    init(form: TInfraListeForm): void {
        const urlFlecheGauche = "../vue/css/flecheGauche.png";
        let urlFlecheBas = "../vue/css/flecheBas.png"

        this._form = form;
        // On initialise les lignes de délit en non visible
        this.form.divLigne.forEach(ligne => {
            ligne.hidden = true;
        });
        // On initialise les images des boutons avec les flechesGauches
        this.form.btnDeroulant.forEach(btn =>{
            btn.style.backgroundImage = 'url("'+urlFlecheGauche+'")';
            btn.style.backgroundSize = 'cover';
        })
        
        // Definition des evenement
        this.form.btnDeroulant.forEach(btn => {
            btn.addEventListener('click',() =>{
                btn.classList.toggle('rotated')
                this.btnClick(btn.id);
            });  
        });
    }

    btnClick(id : string):void{
        console.log(id);
        console.log(this.form.divLigne.filter(ligne => ligne.classList[1] === id));
        this.form.divLigne.filter(ligne => ligne.classList[1] === id).forEach(ligne =>{
            if(ligne.hidden)
                ligne.hidden = false;
            else 
                ligne.hidden = true;
        });
    }
}
let vueInfraListe = new VueInfraListe;
export { vueInfraListe }