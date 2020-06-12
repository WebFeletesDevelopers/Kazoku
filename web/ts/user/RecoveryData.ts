/**
 * Data class used to send a request to start an account password recovery.
 */
export class RecoveryData {
    private _email: string;

    /**
     * RecoveryData constructor.
     * @param email
     */
    constructor(email: string) {
        this._email = email;
    }

    /**
     * @return string
     */
    get email(): string {
        return this._email;
    }

    /**
     * @param value
     */
    set email(value: string) {
        this._email = value;
    }

    public validate(): boolean {
        return !! this.email;
    }
}
