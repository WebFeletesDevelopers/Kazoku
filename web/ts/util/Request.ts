import { Response } from "./Response";

export class Request {
    static post(url: string, data: string): Promise<Response> {
        return new Promise<Response>((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);
            xhr.onload = function () {
                const response = new Response(xhr.status, JSON.parse(xhr.response));
                if (xhr.status >= 200 || xhr.status < 300) {
                    resolve(response);
                }
                reject(response);
            }
            xhr.onerror = function () {
                const response = new Response(xhr.status, xhr.response);
                reject(response);
            }
        });
    }

    static postFormData(url: string, data: FormData): Promise<Response> {
        return new Promise<Response>((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.send(data);
            xhr.onload = function () {
                const response = new Response(xhr.status, JSON.parse(xhr.response));
                if (xhr.status >= 200 || xhr.status < 300) {
                    resolve(response);
                }
                reject(response);
            }
            xhr.onerror = function () {
                const response = new Response(xhr.status, xhr.response);
                reject(response);
            }
        });
    }
}
