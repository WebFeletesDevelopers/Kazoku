export class RecoveryUpdateData {
    private _hash: string;
    private _password: string;
    private _repeatPassword: string;

    constructor(
        hash: string,
        password: string,
        repeatPassword: string
    ) {
        this._hash = hash;
        this._password = password;
        this._repeatPassword = repeatPassword;
    }

    get hash(): string {
        return this._hash;
    }

    set hash(value: string) {
        this._hash = value;
    }

    get password(): string {
        return this._password;
    }

    set password(value: string) {
        this._password = value;
    }

    get repeatPassword(): string {
        return this._repeatPassword;
    }

    set repeatPassword(value: string) {
        this._repeatPassword = value;
    }

    public validate(): boolean {
        return !! this.hash
            && !! this.password
            && !! this.repeatPassword
            && this.password === this.repeatPassword;
    }
}
