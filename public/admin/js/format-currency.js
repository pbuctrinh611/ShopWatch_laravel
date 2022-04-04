function formatCurrency(n) {
  n =  Math.floor(n);
  return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
}