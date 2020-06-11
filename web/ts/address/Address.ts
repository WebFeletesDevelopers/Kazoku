export class Address {
    private _id: number;
    private _address: string;
    private _city: string;
    private _zipCode: number;

    constructor(id: number, address: string, city: string, zipCode: number) {
        this._id = id;
        this._address = address;
        this._city = city;
        this._zipCode = zipCode;
    }

    get id(): number {
        return this._id;
    }

    set id(value: number) {
        this._id = value;
    }

    get address(): string {
        return this._address;
    }

    set address(value: string) {
        this._address = value;
    }

    get city(): string {
        return this._city;
    }

    set city(value: string) {
        this._city = value;
    }

    get zipCode(): number {
        return this._zipCode;
    }

    set zipCode(value: number) {
        this._zipCode = value;
    }

    validate() {
        return !! this.address
            && !! this.id
            && !! this.city
            && !! this.zipCode;
    }
}
