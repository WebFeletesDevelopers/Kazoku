/**
 * Class to use cookies.
 */
export class Cookie {
    /**
     * Set a cookie.
     * @param name
     * @param value
     */
    public static set(name: string, value: string): void {
        document.cookie = `${name}=${value}; path=/`
    }

    /**
     * Get a cookie.
     * @param name
     */
    public static get(name: string): string {
        const cookies = document.cookie;
        const parsedCookies: Array<string> = [];
        cookies.split(';').map(fullVal => {
            const result: Array<string> = [];
            let count = 0
            fullVal.trim().split('=').map(val => {
                if (count === 0) {
                    result[0] = val;
                } else {
                    result[1] = val;
                }
                count++;
            });
            parsedCookies[result[0]] = result[1];
        });
        return parsedCookies[name];
    }

    /**
     * Delete a cookie.
     * @param name
     */
    public static delete(name: string): void {
        document.cookie = `${name}= ; expires = Thu, 01 Jan 1970 00:00:00 GMT`;
    }
}
