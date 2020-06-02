/**
 * News data class.
 */
export class News {
    private _title: string;
    private _body: string;
    private _public: boolean;

    constructor(
        title: string,
        body: string,
        isPublic: boolean
    ) {
        this._title = title;
        this._body = body;
        this._public = isPublic;
    }

    get title(): string {
        return this._title;
    }

    set title(value: string) {
        this._title = value;
    }

    get body(): string {
        return this._body;
    }

    set body(value: string) {
        this._body = value;
    }

    get public(): boolean {
        return this._public;
    }

    set public(value: boolean) {
        this._public = value;
    }
}
