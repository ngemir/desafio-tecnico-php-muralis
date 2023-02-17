//pega o input CEP
let cep = document.getElementById('cepInput');
var CepMask = {
  mask: '00000-000',
  lazy: false,
  autofix: true,
  overwrite: true
};

cep.addEventListener('focus', (evento) => {
  var mask = IMask(cep, CepMask);
})