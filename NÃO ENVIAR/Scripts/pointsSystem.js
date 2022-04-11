const calcRate = (data) => {
    let dataSplit = data.grid.split('x');
    let dataRate = (parseInt(data.bombas)/(parseInt(dataSplit[0]) * parseInt(dataSplit[1]))) / parseInt(data.tempo);

    if(data.modalidade == "rivotril")
      dataRate += dataRate * 0.55;
  
    return Math.round(dataRate*100);
}