export class Response {
    private _statusCode: number;
    private _message?: Array<any>;

    constructor(
        statusCode: number,
        message: Array<any>
    ) {
        this._statusCode = statusCode;
        this._message = message;
    }

    get statusCode(): number {
        return this._statusCode;
    }

    get message(): Array<any> {
        return this._message;
    }
}
