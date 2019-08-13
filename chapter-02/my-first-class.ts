class MyBand {
    albums: Array<string>;
    members: number;
    
    constructor(albums_list: Array<string>, total_members: number) {
        this.albums = albums_list;
        this.members = total_members;
    }

    listAlbums(): void {
        console.log('My favorite albums:');
        for (let i = 0; i < this.albums.length; i++) {
            console.log(this.albums[i]);
        }
    }
}

let myFavoriteAlbums = new MyBand(['Ace of Spades', 'Rock and Roll', 'March or Die'], 3);
myFavoriteAlbums.listAlbums();

class MySinger extends MyBand {
    constructor(albums_list: Array<string>, total_members: number) {
        super(albums_list, total_members);
    }
    listAlbums(): void {
        console.log('Singer best albums:');
        for (let i = 0; i < this.albums.length; i++) {
            console.log(this.albums[i]);
        }
    }
}

let singerFavoriteAlbum = new MySinger(['At Folsom Prison', 'Out Among the Stars', 'Heroes'], 1);
singerFavoriteAlbum.listAlbums();
