"use strict";
exports.__esModule = true;
var MyBand = /** @class */ (function () {
    function MyBand(albums_list, total_members) {
        this.albums = albums_list;
        this.members = total_members;
    }
    MyBand.prototype.listAlbums = function () {
        var ret = 'My favorite albums:';
        for (var i = 0; i < this.albums.length; i++) {
            ret += "\n" + (i + 1) + ": " + this.albums[i];
        }
        return ret;
    };
    return MyBand;
}());
exports.MyBand = MyBand;
