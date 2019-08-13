var bands;
(function (bands) {
    bands["Motorhead"] = "Motorhead";
    bands["Metallica"] = "Metallica";
    bands["Slayer"] = "Slayer";
})(bands || (bands = {}));
console.log(bands);
var myFavoriteBand = bands.Slayer;
console.log("My Favorite band is: " + bands.Slayer);
