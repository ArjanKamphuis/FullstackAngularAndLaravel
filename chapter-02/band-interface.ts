interface Band {
    name: string,
    total_members: number
}

function unknownBand(band: Band): void {
    console.log(`This band: ${band.name}, has: ${band.total_members} members.`);
}

let newBand = {
    name: 'Black Sabbath',
    total_members: 4
}

unknownBand(newBand);
