const orderByDate = (data, type) => {
    //Ordem decrescente
    if(type)
        return data.sort(compareDate).reverse();
    //Ordem crescente
    else if(!type)
        return data.sort(compareDate);
    else
        throw "Invalid argument";
}

const orderByTime = (data, type) => {
    //Ordem decrescente
    if(type)
        return data.sort(compareTime).reverse();
    //Ordem crescente
    else if(!type)
        return data.sort(compareTime);
    else
        throw "Invalid argument";
}

const orderByBombs = (data, type) => {
    //Ordem decrescente
    if(type)
        return data.sort(compareBombs).reverse();
    //Ordem crescente
    else if(!type)
        return data.sort(compareBombs);
    else
        throw "Invalid argument";
}

const orderByWins = (data) => {
    return data.sort((d1) => {
        if(d1.resultado == "vitoria")
            return -1;
        else if(d1.resultado == "derrota")
            return 1;
        return 0;
    });
} 

const compareBombs = (d1, d2) => {
    if(parseInt(d1.bombas) < parseInt(d2.bombas))
        return -1;
    else if(parseInt(d1.bombas) > parseInt(d2.bombas))
        return 1;
    
    return 0;
}

const compareDate = (d1, d2) => {
    //Compara na ordem ano/mes/dia

    let d1Split = d1.data.split('/');
    let d2Split = d2.data.split('/');

    if(d1Split[2] < d2Split[2])
        return -1;
    else if(d1Split[2] > d2Split[2])
        return 1;

    if(d1Split[1] < d2Split[1])
        return -1;
    else if(d1Split[1] > d2Split[1])
        return 1;

    if(d1Split[0] < d2Split[0])
        return -1;
    else if(d1Split[0] > d2Split[0])
        return 1;
    
    return 0;  
}

const compareTime = (d1, d2) => {
    if(parseInt(d1.tempo) < parseInt(d2.tempo))
        return -1;
    else if(parseInt(d1.tempo) > parseInt(d2.tempo))
        return 1;
    
    return 0;
}

export {orderByDate, orderByTime, orderByBombs, orderByWins};