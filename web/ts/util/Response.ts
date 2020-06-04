export class Response {
    private _statusCode: number;
    private _message?: object;

    constructor(
        statusCode: number,
        message: Object
    ) {
        this._statusCode = statusCode;
        this._message = message;
    }

    get statusCode(): number {
        return this._statusCode;
    }

    get message(): object {
        return this._message;
    }
}
