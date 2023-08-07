var lati = '';
var long = '';
var estado = '';
var cidade = '';

navigator.geolocation.getCurrentPosition(function (posicao) {
var url = "https://nominatim.openstreetmap.org/reverse?lat=" + posicao.coords.latitude + "&lon=" + posicao.coords.longitude + "&format=json&json_callback=preencherDados";
var script = document.createElement('script');
script.src = url;
document.body.appendChild(script);
lati = posicao.coords.latitude;
long = posicao.coords.longitude;
});

function preencherDados(dados) {
estado = dados.address.state;
cidade = dados.address.city;

switch(estado) {
    case "São Paulo":
        estado = "SP";
        break;
    case "Bahia":
        estado = "BA";
        break;
    case "Minas Gerais":
        estado = "MG";
        break;
    case "Amazonas":
        estado = "AM";
        break;
    case "Paraná":
        estado = "PR";
        break;
    case "Santa Catarina":
        estado = "SC";
        break;
    case "Rio Grande do Sul":
        estado = "RS";
        break;
    case "Pará":
        estado = "PA";
        break;
    case "Goiás":
        estado = "GO";
        break;
    case "Espírito Santo":
        estado = "ES";
        break;
    case "Pernambuco":
        estado = "PE";
        break;
    case "Rio de Janeiro":
        estado = "RJ";
        break;
    case "Ceará":
        estado = "CE";
        break;
    case "Distrito Federal":
        estado = "DF";
        break;
    case "Mato Grosso":
        estado = "MT";
        break;
    case "Maranhão":
        estado = "MA";
        break;
    case "Mato Grosso do Sul":
        estado = "MS";
        break;
    case "Paraíba":
        estado = "PB";
        break;
    case "Sergípe":
        estado = "SE";
        break;
    case "Rio Grande do Norte":
        estado = "RN";
        break;
    case "Tocantins":
        estado = "TO";
        break;
    case "Alagoas":
        estado = "AL";
        break;
    case "Acre":
        estado = "AC";
        break;
    case "Piauí":
        estado = "PI";
        break;
    case "Rondônia":
        estado = "RO";
        break;
    case "Amapá":
        estado = "AP";
        break;
    case "Roraima":
        estado = "RR";
        break;
    default:
        estado = "RJ";
}

// Armazenar
localStorage.setItem("estadosave", estado);
localStorage.setItem("cidadesave", cidade);

};