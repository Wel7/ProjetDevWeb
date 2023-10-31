import { vueInfraListe } from "./infractionListeClient.class.js"
vueInfraListe.init({
    btnDeroulant: Array.from(document.querySelectorAll('.buttonDeroulant')) as HTMLInputElement[],
    divLigne: Array.from(document.getElementsByClassName('tab_delits')) as HTMLDivElement[]
})