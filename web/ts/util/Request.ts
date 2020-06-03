export class Request {
    static post(url: string, data: string): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);
            xhr.onload = function () {
                if (xhr.status >= 200 || xhr.status < 300) {
                    resolve(xhr.response);
                }
                reject(xhr.response);
            }
            xhr.onerror = function () {
                reject(xhr.response);
            }
        });
    }
}
