import { vueInfraListe } from "./infractionListe.class.js"
vueInfraListe.init({
    btnDeroulant: Array.from(document.querySelectorAll('.buttonDeroulant')) as HTMLInputElement[],
    divTab: document.getElementById('table_infraction') as HTMLTableElement
})