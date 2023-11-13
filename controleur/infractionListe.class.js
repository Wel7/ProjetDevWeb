class VueInfraListe {
    get form() { return this._form; }
    init(form) {
        //const urlFlecheGauche = "../vue/css/flecheGauche.png";
        this._form = form;
        // On initialise les lignes de délit en non visible
        for (let i = 0; i < this.form.btnDeroulant.length; i++) {
            this.form.btnDeroulant[i].addEventListener("click", function () {
                console.log("bijour");
                this.closest("table").querySelector(".delit").classList.toggle("hidden");
                this.classList.toggle('rotated');
            });
        }
    }
}
let vueInfraListe = new VueInfraListe;
export { vueInfraListe };
//# sourceMappingURL=infractionListe.class.js.map