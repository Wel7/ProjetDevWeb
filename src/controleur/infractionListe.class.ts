// déclaration de l’ensemble des zones de saisie et d’affichage nécessaires à la gestion du formulaire type
type TInfraListeForm = {
    btnDeroulant : Array<HTMLInputElement>, 
    divTab: HTMLTableElement
}

class VueInfraListe {
    private _form: TInfraListeForm;
    get form():TInfraListeForm {return this._form;}

    init(form: TInfraListeForm): void {
        //const urlFlecheGauche = "../vue/css/flecheGauche.png";

        this._form = form;
        // On initialise les lignes de délit en non visible
        for(let i=0;i<this.form.btnDeroulant.length;i++){
            this.form.btnDeroulant[i].addEventListener("click", function() {
                this.closest("table").tBodies[1].classList.toggle('hidden');
                this.classList.toggle('rotated');
            })
        }
    }
}
let vueInfraListe = new VueInfraListe;
export { vueInfraListe }