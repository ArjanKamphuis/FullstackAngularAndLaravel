export class MyBand {
    albums: Array<string>;
    members: number;

    constructor(albums_list: Array<string>, total_members: number) {
        this.albums = albums_list;
        this.members = total_members;
    }

    listAlbums(): string {
        let ret = 'My favorite albums:';
        for (let i = 0; i < this.albums.length; i++) {
            ret += `\n${i + 1}: ${this.albums[i]}`;
        }
        return ret;
    }
}
