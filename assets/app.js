const routes = require('../public/js/fos_js_routes.json');
import Routing from '../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
Routing.setRoutingData(routes);
import './styles/app.css';
import './bootstrap';
import $ from 'jquery';

$('html').on("click", 'button', function (event) {
    let id_livre = $(this).data().id_livre;
    const text_html = $(this).parent().html();
    let titreval = $(this).data().titre;
    let dateval = $(this).data().date;
    let auteurp = $(this).data().auteurp;
    let auteurn = $(this).data().auteurn;
    let id_auteur = $("#apspan"+id_livre).data().id_auteur;
    $("#Edit" + id_livre).parent().html(`<input value='${titreval}' class="titre`+id_livre+`" style='margin: 10px' class='col' style='padding: 0%'></input> 
        <input type="date" class="date`+id_livre+`" style='margin: 10px' class='col' style='padding: 0%'></input> 
        <input class="auteurp`+id_livre+`" style='margin: 10px' class='col' style='padding: 0%'></input> 
        <input class="auteurn`+id_livre+`" style='margin: 10px' class='col' style='padding: 0%'></input> 
        <button id='Valider${id_livre}'>Valider</button>
        <button id='Annuler${id_livre}'>Annuler</button>`);
    $('#Valider' + id_livre).on("click", function (event) {
        let button = $(this);
        let titre = $('.titre'+id_livre).val();
        let date = $('.date'+id_livre).val();
        let auteurp = $('.auteurp'+id_livre).val();
        let auteurn = $('.auteurn'+id_livre).val();
        $(this).parent().html(`<span class="col">${titre}</span>
                              <span class="col">${date}</span>
                              <span class="col">${auteurp}</span>
                              <span class="col">${auteurn}</span>
                              <button data-id_livre="${id_livre}" id="Edit${id_livre}" class="col" style="padding: 0%">Edit</button>`);

        $.post('/biblio/modify',
            {
                titre: titre,
                date: date,
                auteurp: auteurp,
                auteurn: auteurn,
                id_livre: id_livre,
                id_auteur: id_auteur
            },

        );
    });

    $('#Annuler' + id_livre).on("click", function (event) {
        $(this).parent().html(text_html);
    });
});









