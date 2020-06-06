/**
 * center data class.
 */
export class Center {
    private _name: string;
    private _direction: string;
    private _zip: number;
    private _phone: number;

    constructor(
        name: string,
        direction: string,
        zip: number,
        phone: number,
    ) {
        this._name = name;
        this._direction = direction;
        this._zip = zip;
        this._phone = phone;
    }


    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get direction(): string {
        return this._direction;
    }

    set direction(value: string) {
        this._direction = value;
    }

    get zip(): number {
        return this._zip;
    }

    set zip(value: number) {
        this._zip = value;
    }

    get phone(): number {
        return this._phone;
    }

    set phone(value: number) {
        this._phone = value;
    }

    /**
     * Check if the center has all the params
     */
    public validate(): boolean {
        return this._name !== ''
            && this._direction !== ''
            && this._zip > 0
            && this._phone > 0
            ;
    }
}
